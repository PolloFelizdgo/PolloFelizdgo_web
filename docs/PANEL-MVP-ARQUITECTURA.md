# Diseno tecnico del panel interno (MVP)

Este documento define la arquitectura exacta para construir el panel interno en la siguiente iteracion.

## 1. Objetivo del MVP

Permitir al equipo editar contenido clave del sitio sin tocar codigo, con control minimo de seguridad y trazabilidad.

Alcance MVP:
- Edicion de contenido central (home/acerca/footer).
- Edicion de enlaces externos (redes, factura, WhatsApp, contacto).
- Publicacion segura con registro de cambios.
- Dashboard tecnico basico (healthcheck y estado de configuracion critica).
- Gestion de usuarios y roles para panel.

Fuera de alcance MVP (fase posterior):
- Editor visual drag-and-drop.
- Programacion avanzada por fecha/hora.
- Versionado completo por rama.

## 2. Arquitectura propuesta

Stack:
- Laravel + Blade.
- Middleware de autenticacion (`auth`).
- Middleware de autorizacion por rol (simple para MVP).
- Persistencia en base de datos para settings y bloques de contenido.

Decision tecnica:
- Mantener `config/site_content.php` y `config/external_links.php` como fallback inicial.
- El panel guarda en BD y la aplicacion prioriza BD sobre config.

## 3. Modelo de datos (tablas)

### 3.1 Tabla `panel_settings`
Uso: pares clave-valor para enlaces externos y parametros de operacion.

Campos:
- `id` (bigint, pk)
- `key` (string, unico) ejemplo: `external.billing.url`
- `value` (longText, JSON serializado o texto)
- `group` (string) ejemplo: `external_links`, `contact`, `whatsapp`
- `is_public` (boolean, default true)
- `updated_by` (foreignId nullable -> `users.id`)
- `created_at`, `updated_at`

Indices:
- unico en `key`
- indice en `group`

### 3.2 Tabla `content_blocks`
Uso: bloques editables por seccion.

Campos:
- `id` (bigint, pk)
- `section` (string) ejemplo: `home.hero`, `home.promotions`, `about.summary`, `footer.copy`
- `payload` (longText JSON)
- `status` (enum: `draft`, `published`)
- `version` (unsignedInteger)
- `published_at` (timestamp nullable)
- `updated_by` (foreignId nullable -> `users.id`)
- `created_at`, `updated_at`

Indices:
- indice en `section`
- indice compuesto `section + status`

### 3.3 Tabla `content_revisions`
Uso: historial de cambios por bloque.

Campos:
- `id` (bigint, pk)
- `content_block_id` (foreignId -> `content_blocks.id`)
- `previous_payload` (longText JSON nullable)
- `new_payload` (longText JSON)
- `change_note` (string nullable)
- `changed_by` (foreignId nullable -> `users.id`)
- `created_at`

Indices:
- indice en `content_block_id`
- indice en `created_at`

### 3.4 Tabla `activity_logs`
Uso: auditoria de acciones del panel.

Campos:
- `id` (bigint, pk)
- `actor_id` (foreignId nullable -> `users.id`)
- `action` (string) ejemplo: `content.publish`, `settings.update`
- `target_type` (string) ejemplo: `content_block`, `setting`
- `target_id` (string nullable)
- `meta` (longText JSON nullable)
- `ip_address` (string nullable)
- `user_agent` (string nullable)
- `created_at`

Indice:
- indice en `action`
- indice en `created_at`

### 3.5 Tabla `roles` (si no existe)
Uso: permisos simples MVP.

Campos:
- `id` (bigint, pk)
- `name` (string unico): `administrador`, `superusario`, `diseño`
- `created_at`, `updated_at`

### 3.6 Relacion `users.role_id`
Agregar columna:
- `role_id` (foreignId nullable -> `roles.id`)

## 4. Estructura de codigo propuesta

### 4.1 Modelos
- `app/Models/PanelSetting.php`
- `app/Models/ContentBlock.php`
- `app/Models/ContentRevision.php`
- `app/Models/ActivityLog.php`
- `app/Models/Role.php`

### 4.2 Controladores
- `app/Http/Controllers/Panel/DashboardController.php`
- `app/Http/Controllers/Panel/SettingsController.php`
- `app/Http/Controllers/Panel/ContentController.php`
- `app/Http/Controllers/Panel/UserManagementController.php`
- `app/Http/Controllers/Panel/RevisionController.php`

### 4.3 Servicios
- `app/Services/Panel/ContentRepository.php`
- `app/Services/Panel/SettingsRepository.php`
- `app/Services/Panel/PublicationService.php`
- `app/Services/Panel/AuditService.php`

### 4.4 Requests (validacion)
- `app/Http/Requests/Panel/UpdateExternalLinksRequest.php`
- `app/Http/Requests/Panel/UpdateHomeContentRequest.php`
- `app/Http/Requests/Panel/UpdateAboutContentRequest.php`
- `app/Http/Requests/Panel/UpdateFooterContentRequest.php`
- `app/Http/Requests/Panel/PublishContentRequest.php`

### 4.5 Middleware
- `app/Http/Middleware/EnsurePanelRole.php`

Registro en `bootstrap/app.php` o equivalente de Laravel 13 segun middleware setup.

## 5. Rutas del panel

Archivo: `routes/web.php` (grupo `prefix('panel')`).

Propuesta:
- `GET /panel` -> dashboard (`panel.dashboard`)
- `GET /panel/settings` -> formulario enlaces (`panel.settings.edit`)
- `PUT /panel/settings` -> guardar enlaces (`panel.settings.update`)
- `GET /panel/content/home` -> editar home (`panel.content.home.edit`)
- `PUT /panel/content/home` -> guardar home draft (`panel.content.home.update`)
- `POST /panel/content/home/publish` -> publicar (`panel.content.home.publish`)
- `GET /panel/content/about` -> editar about (`panel.content.about.edit`)
- `PUT /panel/content/about` -> guardar draft (`panel.content.about.update`)
- `POST /panel/content/about/publish` -> publicar (`panel.content.about.publish`)
- `GET /panel/content/footer` -> editar footer (`panel.content.footer.edit`)
- `PUT /panel/content/footer` -> guardar draft (`panel.content.footer.update`)
- `POST /panel/content/footer/publish` -> publicar (`panel.content.footer.publish`)
- `GET /panel/revisions/{section}` -> historial (`panel.revisions.index`)

Grupo sugerido:
- middleware: `auth`, `verified` (si aplica), `panel.role:administrador,superusario,diseño`
- para crear usuarios/roles: `panel.role:administrador`
- para publicar/configurar: `panel.role:administrador,superusario`

## 6. Vistas del panel (Blade)

- `resources/views/panel/layouts/app.blade.php`
- `resources/views/panel/dashboard.blade.php`
- `resources/views/panel/users/index.blade.php`
- `resources/views/panel/settings/edit.blade.php`
- `resources/views/panel/content/home/edit.blade.php`
- `resources/views/panel/content/about/edit.blade.php`
- `resources/views/panel/content/footer/edit.blade.php`
- `resources/views/panel/revisions/index.blade.php`

Componentes sugeridos:
- `resources/views/panel/components/status-badge.blade.php`
- `resources/views/panel/components/form-actions.blade.php`
- `resources/views/panel/components/field-help.blade.php`

## 7. Flujo de publicacion

1. Usuario edita seccion -> guarda en `draft`.
2. Sistema registra revision (`content_revisions`).
3. Usuario publica -> status `published`, `published_at`.
4. Se limpia cache relevante:
- `home.static_data.v1`
- `about.static_data.v1`
- `menu.items.v1` (solo si afecta menu)
5. Se registra en `activity_logs`.

## 8. Integracion con contenido actual

### 8.1 HomeController

Adaptar lectura de contenido:
1. Intentar leer bloque publicado de `content_blocks`.
2. Si no existe, usar `config/site_content.php`.

### 8.2 External links

Adaptar lectura de enlaces:
1. Intentar `panel_settings` por clave.
2. Si no existe, usar `config/external_links.php`.

### 8.3 Regla de fallback

Si hay error de BD o datos invalidos:
- usar configuracion de archivos para evitar caida del sitio.

## 9. Seguridad minima

- CSRF en todas las formas.
- Validaciones server-side fuertes (URLs, telefonos, longitud de textos).
- Sanitizacion de HTML (permitir solo texto plano en MVP).
- Limite de peticiones a rutas del panel (`throttle:60,1` por defecto).
- Registro de IP y user agent en acciones de publicacion.

## 10. Dashboard tecnico MVP

Widgets minimos:
- Estado `/health`.
- Estado de mail (variables `MAIL_*` completas).
- Estado reCAPTCHA (`RECAPTCHA_SITE_KEY`, `RECAPTCHA_SECRET_KEY`).
- Ultima publicacion por seccion.
- Ultimo deploy (manual, editable en setting `ops.last_deploy_at`).

## 10.1 Usuarios y roles

El panel ya incluye una pantalla administrativa para:
- crear usuarios del panel;
- asignar rol al crear;
- cambiar el rol de un usuario existente;
- crear roles nuevos.

Ruta actual:
- `GET /panel/users` -> pantalla de gestion de usuarios y roles.

Restriccion actual:
- solo `administrador` puede crear roles y usuarios.

## 11. Plan de implementacion por iteracion

### Iteracion 1 (base)
- Migraciones y modelos.
- Middleware de rol.
- Layout del panel + dashboard.

### Iteracion 2 (contenido)
- CRUD de bloques `home/about/footer`.
- Guardar draft y publicar.
- Integracion en HomeController con fallback.

### Iteracion 3 (settings y auditoria)
- Editor de enlaces externos.
- Bitacora de cambios.
- Limpieza de cache automatica post-publicacion.

### Iteracion 4 (hardening)
- Tests feature del panel.
- Politicas de permisos.
- Ajustes UX y mensajes de error.

### Iteracion 5 (usuarios y roles)
- Alta de usuarios desde el panel.
- Alta de roles desde el panel.
- Actualizacion de rol por usuario.
- Normalizacion de nombres de rol a `administrador`, `superusario`, `diseño`.

## 12. Pruebas recomendadas

Nuevos tests feature:
- Acceso denegado sin login a `/panel`.
- Rol diseño no publica.
- Rol superusario publica contenido valido.
- Guardado de draft crea revision.
- Publicacion limpia cache y se refleja en home.
- Actualizar enlace externo cambia render en footer.
- Crear usuario con rol desde `/panel/users`.

## 13. Criterios de aceptacion MVP

- Se puede editar home/acerca/footer sin tocar codigo.
- Se puede editar enlaces externos desde un solo formulario.
- Existe historial minimo de cambios.
- Publicar refleja cambios sin downtime.
- Si falla BD/config, el sitio sigue operando con fallback.
- Rutas del panel protegidas por auth + rol.
- CRUD basico de usuarios/roles disponible para administracion interna.

## 14. Notas para Hostinger

- Evitar dependencias pesadas de front para panel MVP.
- Mantener Blade + controllers para compatibilidad en hosting compartido.
- Confirmar permisos de `storage/` y `bootstrap/cache/`.
- Despues de despliegue, validar `/health` y formulario de contacto.

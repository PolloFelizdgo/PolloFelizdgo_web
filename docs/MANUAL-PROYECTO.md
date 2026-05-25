# Manual rapido del proyecto

Este manual indica donde editar cada parte principal del sitio y para que sirve cada bloque.

## 0. Mapa exacto de archivos

Raiz del proyecto en este entorno:
- `/home/joseph/PolloFelizdgo_web`

Archivos clave por modulo (ruta exacta dentro del proyecto):

1. Estructura de paginas
- `/home/joseph/PolloFelizdgo_web/resources/views/home.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/about.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/menu.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/privacy.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/vacancies/index.blade.php`

2. Parciales de home
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/navbar.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/hero.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/surcusales.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/menu.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/promociones.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/confianza.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/acerca.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/contacto.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/footer.blade.php`
- `/home/joseph/PolloFelizdgo_web/resources/views/partials/whatsapp-float.blade.php`

3. Controladores y rutas
- `/home/joseph/PolloFelizdgo_web/app/Http/Controllers/HomeController.php`
- `/home/joseph/PolloFelizdgo_web/app/Http/Controllers/ContactController.php`
- `/home/joseph/PolloFelizdgo_web/app/Http/Controllers/HealthController.php`
- `/home/joseph/PolloFelizdgo_web/app/Http/Controllers/VacancyController.php`
- `/home/joseph/PolloFelizdgo_web/routes/web.php`

4. Configuracion centralizada
- `/home/joseph/PolloFelizdgo_web/config/site_content.php`
- `/home/joseph/PolloFelizdgo_web/config/external_links.php`
- `/home/joseph/PolloFelizdgo_web/config/services.php`

5. Frontend y estilos
- `/home/joseph/PolloFelizdgo_web/resources/js/app.js`
- `/home/joseph/PolloFelizdgo_web/resources/css/app.css`

6. Pruebas
- `/home/joseph/PolloFelizdgo_web/tests/Feature/ContactFormTest.php`
- `/home/joseph/PolloFelizdgo_web/tests/Feature/PublicPagesTest.php`
- `/home/joseph/PolloFelizdgo_web/tests/Feature/VacancyBoardTest.php`
- `/home/joseph/PolloFelizdgo_web/tests/Feature/ExampleTest.php`
- `/home/joseph/PolloFelizdgo_web/tests/Feature/PanelUserManagementTest.php`

8. Deploy
- `/home/joseph/PolloFelizdgo_web/docs/DEPLOY-HOSTINGER.md`
- `/home/joseph/PolloFelizdgo_web/.env.example`

7. Assets
- `/home/joseph/PolloFelizdgo_web/public/images/brand`
- `/home/joseph/PolloFelizdgo_web/public/images/home`
- `/home/joseph/PolloFelizdgo_web/public/images/about`
- `/home/joseph/PolloFelizdgo_web/public/images/menu`
- `/home/joseph/PolloFelizdgo_web/public/favicon.ico`

## 1. Portada

Archivo: [resources/views/home.blade.php](../resources/views/home.blade.php)

Este archivo solo ensambla secciones (`@include`) y define metadatos SEO de la home.

Edita aqui si necesitas:
- agregar/quitar/mover secciones,
- cambiar metadatos (`title`, `description`, `og:*`) de inicio.

## 2. Datos base del sitio (home, menu, acerca)

Archivo: [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)

Contenido editable centralizado:
- [config/site_content.php](../config/site_content.php)

`index()`:
- sucursales (`$branches`), promociones (`$promotions`), hero (`$heroSlides`).
- cada sucursal trae `map` con URL `https://www.google.com/maps?q=...&output=embed`.

`menu()`:
- envia catalogo completo a `/menu`.

`about()`:
- imagenes corporativas, linea de tiempo y valores.

`site_content.php`:
- concentra textos de Home/Acerca/Footer y facilita cambios sin buscar en varias vistas.
- usa rutas de imagen relativas a `public/` (por ejemplo `images/home/banner.jpg`).

`getMenuItems()`:
- catalogo de productos para home y `/menu`.
- campo `category` controla filtros visuales de la pagina de menu.

## 3. Menu completo con filtros y buscador

Archivo: [resources/views/menu.blade.php](../resources/views/menu.blade.php)

Incluye:
- buscador por texto,
- filtros por categoria (pollos, combos, paquetes, complementos, bebidas),
- logica JS inline para combinar categoria + buscador,
- metadatos SEO/OG para compartir en redes.

Si agregas nueva categoria en `HomeController`, agrega su boton en este archivo.

## 4. Sucursales y mapas

Fuentes de edicion:
- datos: [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)
- render: [resources/views/partials/surcusales.blade.php](../resources/views/partials/surcusales.blade.php)

Para actualizar un mapa:
1. cambia `address` en `HomeController`.
2. actualiza `map` con URL embed por direccion.

## 5. WhatsApp flotante

Archivos:
- [resources/views/partials/whatsapp-float.blade.php](../resources/views/partials/whatsapp-float.blade.php)
- [resources/views/partials/footer.blade.php](../resources/views/partials/footer.blade.php)

El boton flotante esta centralizado en `whatsapp-float.blade.php`.
Para cambiar numero o mensaje prellenado, edita solo su `href` (`wa.me`).

### WhatsApp contextual por seccion

Archivos:
- [resources/views/partials/whatsapp-float.blade.php](../resources/views/partials/whatsapp-float.blade.php)
- [resources/js/app.js](../resources/js/app.js)

Ahora el boton cambia automaticamente su mensaje segun la seccion visible:
- `#menu` -> mensaje de menu/recomendacion
- `#promociones` -> mensaje de promociones
- `#sucursales` -> mensaje de sucursal cercana
- fuera de esas secciones -> mensaje general

Edita los `data-message-*` en `whatsapp-float.blade.php` para ajustar textos.

## 6. Formulario de contacto y cumplimiento legal

Archivos:
- vista: [resources/views/partials/contacto.blade.php](../resources/views/partials/contacto.blade.php)
- backend: [app/Http/Controllers/ContactController.php](../app/Http/Controllers/ContactController.php)

Incluye:
- envio AJAX con spinner y feedback inline,
- checkbox obligatorio de consentimiento,
- validacion backend de `privacy_consent`.

### Resiliencia ante caida de correo/API

Archivos:
- [resources/views/partials/contacto.blade.php](../resources/views/partials/contacto.blade.php)
- [app/Http/Controllers/ContactController.php](../app/Http/Controllers/ContactController.php)

Se agrego bloque de canales alternos (WhatsApp y llamada) visible en la seccion de contacto.
Ademas, cuando falla captcha o envio de correo, el backend responde con mensaje de contingencia para que el usuario no se quede sin accion.

## 6.1 Testimonios de clientes

Archivos:
- [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)
- [resources/views/partials/confianza.blade.php](../resources/views/partials/confianza.blade.php)

Los testimonios ahora vienen desde `HomeController` como modulo editable.
Cada registro usa:
- `name` (nombre corto),
- `zone` (zona/sucursal),
- `quote` (texto corto),
- `rating` (1 a 5).

Recomendacion: mantener formato breve y sin datos sensibles.

## 6.2 Cache de datos estaticos

Archivo: [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)

Se cachean por 60 minutos los bloques estaticos de:
- home (`branches`, `promotions`, `heroSlides`, `testimonials`),
- about (`aboutImages`, `timeline`, `values`),
- menu (`getMenuItems()`).

Claves usadas:
- `home.static_data.v1`
- `about.static_data.v1`
- `menu.items.v1`

Si cambias contenido y quieres reflejarlo de inmediato, ejecuta:
- `php artisan optimize:clear`

## 7. Aviso de privacidad

Archivos:
- ruta: [routes/web.php](../routes/web.php)
- pagina: [resources/views/privacy.blade.php](../resources/views/privacy.blade.php)
- enlace en footer: [resources/views/partials/footer.blade.php](../resources/views/partials/footer.blade.php)

En el CTA de facturacion del footer se muestra version corta legal con enlace al aviso.

## 8. SEO basico por pagina

Edita metadatos en `head` de cada vista principal:
- [resources/views/home.blade.php](../resources/views/home.blade.php)
- [resources/views/menu.blade.php](../resources/views/menu.blade.php)
- [resources/views/about.blade.php](../resources/views/about.blade.php)
- [resources/views/vacancies/index.blade.php](../resources/views/vacancies/index.blade.php)
- [resources/views/privacy.blade.php](../resources/views/privacy.blade.php)

Campos recomendados:
- `meta description`
- `og:title`
- `og:description`
- `og:image`
- `og:url`

## 9. Favicon y assets publicos

Archivos:
- [public/favicon.ico](../public/favicon.ico)
- [public/favicon-32x32.png](../public/favicon-32x32.png)
- [public/apple-touch-icon.png](../public/apple-touch-icon.png)

Imagenes del sitio:
- [public/images](../public/images)

Estructura oficial recomendada:
- [public/images/brand](../public/images/brand)
- [public/images/home](../public/images/home)
- [public/images/about](../public/images/about)
- [public/images/menu](../public/images/menu)

Regla practica:
- subir assets nuevos en su carpeta por modulo para evitar mezcla de archivos.

## 10. JavaScript global

Archivo: [resources/js/app.js](../resources/js/app.js)

Responsable de:
- tema claro/oscuro persistente,
- slider hero,
- modales de imagen,
- carrusel de testimonios,
- reveal on scroll,
- envio AJAX de contacto.

## 11. Rutas principales

Archivo: [routes/web.php](../routes/web.php)

Cada ruta tiene comentario explicando su uso.
Si agregas pagina nueva, define ruta y nombre (`->name(...)`) aqui.

Ruta tecnica para monitoreo:
- `/health` (nombre de ruta: `health`)

## 12. Panel interno actual

El panel interno ya esta implementado y se usa para editar contenido sin tocar codigo.

Archivos clave:
- [app/Http/Controllers/Panel/DashboardController.php](../app/Http/Controllers/Panel/DashboardController.php)
- [app/Http/Controllers/Panel/ContentController.php](../app/Http/Controllers/Panel/ContentController.php)
- [app/Http/Controllers/Panel/UserManagementController.php](../app/Http/Controllers/Panel/UserManagementController.php)
- [app/Services/Panel/PanelContentService.php](../app/Services/Panel/PanelContentService.php)
- [resources/views/panel/layouts/app.blade.php](../resources/views/panel/layouts/app.blade.php)
- [resources/views/panel/dashboard.blade.php](../resources/views/panel/dashboard.blade.php)
- [resources/views/panel/content/edit.blade.php](../resources/views/panel/content/edit.blade.php)
- [resources/views/panel/users/index.blade.php](../resources/views/panel/users/index.blade.php)
- [routes/web.php](../routes/web.php)

Lo que ya permite:
- editar Home, Acerca, Footer, Menu y Estilo desde formularios visuales;
- guardar borradores, publicar y revertir cambios por seccion;
- crear usuarios del panel y asignarles rol;
- crear roles nuevos desde el panel;
- programar la publicacion del estilo;
- guardar presets de estilo;
- ver estados de aplicacion, correo y reCAPTCHA desde el dashboard.

Roles base actuales:
- `administrador`
- `superusario`
- `diseño`

Nota importante:
- el sitio publico conserva sus colores originales;
- el editor de Estilo sigue disponible en el panel, pero no sobreescribe globalmente la apariencia publica.

## 13. Flujo recomendado para editar

1. Cambia datos fuente en controlador.
2. Ajusta vista Blade correspondiente.
3. Si hay interaccion, actualiza `resources/js/app.js`.
4. Revisa en navegador con Vite activo.
5. Ejecuta `php artisan test` antes de cerrar cambios.

## 14. Checklist de publicacion (5 minutos)

Usa esta lista antes de subir cambios a produccion:

1. Enlaces externos
- Facebook, Instagram, Factura y WhatsApp abren correctamente.
- Si cambiaste algun enlace, valida `config/external_links.php`.

2. Rutas clave
- Home (`/`), Acerca (`/acerca`) y Menu (`/menu`) cargan sin errores.

3. Formulario de contacto
- El boton enviar muestra estado de carga.
- Si falla API/correo, se ven canales alternos (WhatsApp/Llamada).

4. Vista y experiencia
- Revisar desktop + movil en home.
- Verificar modo oscuro/claro.
- Confirmar que WhatsApp flotante no tape contenido.

5. Pruebas y cache
- Ejecutar `php artisan test`.
- Si editaste contenido cacheado, correr `php artisan optimize:clear`.

## 15. Preparacion para Hostinger

Guia completa:
- [docs/DEPLOY-HOSTINGER.md](DEPLOY-HOSTINGER.md)

Archivo base de variables:
- [.env.example](../.env.example)

Script de despliegue disponible en Composer:
- `composer run deploy:hostinger`

## 16. Panel interno (diseno tecnico MVP)

Documento tecnico completo para construir el panel en la siguiente iteracion:
- [docs/PANEL-MVP-ARQUITECTURA.md](PANEL-MVP-ARQUITECTURA.md)

Incluye:
- modelo de datos (tablas),
- rutas, controladores y vistas,
- flujo draft/publicacion,
- seguridad minima,
- integracion con `config/site_content.php` y `config/external_links.php`,
- criterios de aceptacion para liberar MVP.

Estado actual:
- el panel ya cubre el MVP base y agrego usuarios/roles, editor visual y temas/presets;
- lo pendiente en este documento tecnico sirve como referencia para siguientes iteraciones.

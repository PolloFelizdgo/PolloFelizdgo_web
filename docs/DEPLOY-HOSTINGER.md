# Deploy en Hostinger (Laravel)

Guia practica para publicar este proyecto en Hostinger con menor riesgo.

## 1. Requisitos previos

- Hosting con PHP 8.3 o superior.
- Base de datos creada (MySQL/MariaDB).
- Acceso SSH en Hostinger (recomendado).
- Dominio o subdominio apuntando al proyecto.
- Rama estable para publicar: `master`.

## 2. Estructura recomendada en servidor

Directorio sugerido:
- `~/domains/TU-DOMINIO/public_html` (document root)
- Proyecto Laravel fuera de `public_html`, por ejemplo:
- `~/apps/pollofeliz`

Asegura que el document root apunte a:
- `~/apps/pollofeliz/public`

Si Hostinger te obliga a usar `public_html` como raiz:
- deja el proyecto Laravel completo fuera de `public_html`
- copia el contenido de `public/` dentro de `public_html/`
- conserva dentro de `public_html/` el `.htaccess` de Laravel
- ajusta `public_html/index.php` para que apunte a la ubicacion real del proyecto

Las dos rutas que normalmente debes corregir dentro de `index.php` son:
- `../vendor/autoload.php`
- `../bootstrap/app.php`

### 2.1 Modo public_html (caso tipico en Hostinger)

Usa esta estructura final:
- `~/domains/TU-DOMINIO/public_html` (solo archivos publicos)
- `~/apps/pollofeliz` (codigo Laravel completo)

Dentro de `public_html` debes tener:
- `index.php`
- `.htaccess`
- `build/` (si compilaste assets)
- `images/`, `favicon.ico`, y el resto de archivos estaticos de `public/`

Dentro de `~/apps/pollofeliz` deben existir:
- `app/`, `bootstrap/`, `config/`, `database/`, `resources/`, `routes/`, `storage/`, `vendor/`
- `.env`

Flujo recomendado en SSH:
1. Clona el repo en `~/apps/pollofeliz`.
2. Copia el contenido de `~/apps/pollofeliz/public/` hacia `~/domains/TU-DOMINIO/public_html/`.
3. Edita `~/domains/TU-DOMINIO/public_html/index.php` para apuntar al proyecto real.

Si tu carpeta real es `~/apps/pollofeliz`, el `index.php` de `public_html` debe apuntar a:
- `require '/home/TU_USUARIO/apps/pollofeliz/vendor/autoload.php';`
- `$app = require_once '/home/TU_USUARIO/apps/pollofeliz/bootstrap/app.php';`

No dejes rutas relativas ambiguas cuando uses `public_html`; usa rutas absolutas.

## 3. Subir codigo

Opciones:
- `git clone` en servidor.
- Deploy por CI/CD hacia servidor.
- SFTP (menos recomendado para cambios frecuentes).

## 4. Configurar entorno

1. Copia `.env.example` a `.env`.
2. Edita variables obligatorias:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://TU-DOMINIO`
- `DB_CONNECTION=mysql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=3306`
- `DB_DATABASE=...`
- `DB_USERNAME=...`
- `DB_PASSWORD=...`
- `MAIL_*`
- `RECAPTCHA_*`
- `BILLING_URL`, `SOCIAL_*`, `CONTACT_*`, `WHATSAPP_*`

3. Genera clave de app si no existe:

```bash
php artisan key:generate --force
```

## 5. Instalar dependencias y optimizar

Con SSH en la raiz del proyecto:

```bash
composer run deploy:hostinger
```

Ese comando ejecuta:
- install sin dev,
- migraciones forzadas,
- limpieza de caches,
- cache de config/rutas/vistas.

Si tu plan no tiene Node.js, genera el build en tu computadora con `npm run build` y sube tambien `public/build`.

Despues de copiar `public/` en `public_html`, vuelve a ejecutar:
- `php artisan optimize:clear`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`

## 6. Permisos importantes

Asegura permisos de escritura para:
- `storage/`
- `bootstrap/cache/`

Si usas Linux:

```bash
chmod -R 775 storage bootstrap/cache
```

Adicional para imagenes subidas desde panel:

```bash
php artisan storage:link
```

## 7. Cola y cron (si aplica)

Para este proyecto se usa por defecto:
- `QUEUE_CONNECTION=sync`

Si en el futuro cambias a cola real (`database`, `redis`), configura worker y cron en Hostinger.

Para tareas programadas de Laravel (recomendado):

```bash
* * * * * php /home/TU_USUARIO/apps/pollofeliz/artisan schedule:run >> /dev/null 2>&1
```

## 8. Verificacion post-deploy

Checklist rapido:

1. Home carga bien: `/`
2. Acerca y Menu: `/acerca`, `/menu`
3. Endpoint de salud:
- `/health` debe responder JSON con `status: up`
4. Formulario de contacto:
- envio correcto
- fallback visible si falla API/correo
5. WhatsApp, redes y factura funcionan
6. reCAPTCHA valida correctamente en dominio final
7. Si aparece 404 de Hostinger, revisa el document root y `public_html/index.php`.
8. Si no cargan assets, confirma que `public/build` subio completo y que `APP_URL` coincide con el dominio final.
9. Si no cargan imagenes del panel, valida el enlace simbolico con `php artisan storage:link`.

## 9. Comandos utiles de mantenimiento

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan test
```

## 10. Problemas comunes en Hostinger

1. Error 500 al cargar:
- revisar `APP_DEBUG`, permisos y ruta de `public`.

2. No carga assets:
- revisar `APP_URL` y build de frontend.

3. Contacto no envia:
- validar `MAIL_*` y buzones.
- confirmar `RECAPTCHA_*` con dominio autorizado.

4. Cambios no se reflejan:
- ejecutar `php artisan optimize:clear`.

5. Error 404 directo de Hostinger:
- `public_html` no tiene el `index.php` de Laravel, o rutas de `index.php` apuntan mal a `vendor` y `bootstrap`.

6. Error SQLSTATE[HY000] [1045] o [2002]:
- revisar `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` en `.env` y permisos del usuario MySQL.

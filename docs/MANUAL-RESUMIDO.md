# Manual resumido del proyecto

Guia corta para ubicar rapido las partes mas importantes del sitio.

## Sitio publico

- [resources/views/home.blade.php](../resources/views/home.blade.php)
- [resources/views/menu.blade.php](../resources/views/menu.blade.php)
- [resources/views/about.blade.php](../resources/views/about.blade.php)
- [resources/views/privacy.blade.php](../resources/views/privacy.blade.php)
- [resources/views/vacancies/index.blade.php](../resources/views/vacancies/index.blade.php)

## Contenido principal

- [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)
- [config/site_content.php](../config/site_content.php)
- [config/external_links.php](../config/external_links.php)

## Parciales que mas se editan

- [resources/views/partials/hero.blade.php](../resources/views/partials/hero.blade.php)
- [resources/views/partials/surcusales.blade.php](../resources/views/partials/surcusales.blade.php)
- [resources/views/partials/menu.blade.php](../resources/views/partials/menu.blade.php)
- [resources/views/partials/promociones.blade.php](../resources/views/partials/promociones.blade.php)
- [resources/views/partials/acerca.blade.php](../resources/views/partials/acerca.blade.php)
- [resources/views/partials/contacto.blade.php](../resources/views/partials/contacto.blade.php)
- [resources/views/partials/footer.blade.php](../resources/views/partials/footer.blade.php)

## Panel interno

- [routes/web.php](../routes/web.php)
- [app/Http/Controllers/Panel/DashboardController.php](../app/Http/Controllers/Panel/DashboardController.php)
- [app/Http/Controllers/Panel/ContentController.php](../app/Http/Controllers/Panel/ContentController.php)
- [app/Http/Controllers/Panel/UserManagementController.php](../app/Http/Controllers/Panel/UserManagementController.php)
- [resources/views/panel/layouts/app.blade.php](../resources/views/panel/layouts/app.blade.php)
- [resources/views/panel/dashboard.blade.php](../resources/views/panel/dashboard.blade.php)
- [resources/views/panel/content/edit.blade.php](../resources/views/panel/content/edit.blade.php)
- [resources/views/panel/users/index.blade.php](../resources/views/panel/users/index.blade.php)

## Roles del panel

- `administrador`
- `superusario`
- `diseño`

## Comandos utiles

```bash
php artisan test
php artisan optimize:clear
php artisan migrate --seed
npm run dev
```

## Regla rapida

- Si vas a cambiar contenido, primero revisa el controller, luego la vista.
- Si vas a cambiar panel, revisa primero `routes/web.php` y el controlador del modulo.
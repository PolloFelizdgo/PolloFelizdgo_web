# Pollo Feliz Durango

Sitio web corporativo y panel interno para editar contenido sin tocar codigo.

## Documentacion clave

- [Manual del proyecto](docs/MANUAL-PROYECTO.md)
- [Manual tecnico del panel](docs/PANEL-MVP-ARQUITECTURA.md)
- [Manual corto de referencia](docs/MANUAL-RESUMIDO.md)
- [Guia de despliegue en Hostinger](docs/DEPLOY-HOSTINGER.md)

## Funciones actuales

- Home, Acerca, Menu, Bolsa de trabajo, Contacto y aviso de privacidad.
- Panel visual para editar Home, Acerca, Footer, Menu y Estilo.
- Creacion de usuarios y roles desde `/panel/users`.
- Roles base: `administrador`, `superusario`, `diseño`.
- Presets y publicacion programada para el estilo.
- Pruebas feature ya incluidas para contacto, vacantes y panel.

## Rutas utiles

- `/` inicio
- `/menu` menu completo
- `/acerca` pagina institucional
- `/bolsa-de-trabajo` vacantes
- `/panel` dashboard interno
- `/panel/users` usuarios y roles

## Desarrollo local

```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run dev
```

## Pruebas

```bash
php artisan test
```

## Despliegue

Consulta la guia de Hostinger antes de subir cambios a produccion.

Si usas `public_html`, toma como base `docs/hostinger-public_html-index.php.example` para el `index.php` publico.

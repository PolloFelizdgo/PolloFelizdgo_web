# Manual rapido del proyecto

Este manual indica donde editar cada parte principal del sitio.

## 1. Portada

Archivo: [resources/views/home.blade.php](../resources/views/home.blade.php)

Aqui solo se ensamblan las secciones de la pagina principal.
Edita este archivo si quieres:
- quitar o agregar secciones completas,
- mover el orden de los bloques,
- cambiar que vista se incluye en la portada.

## 2. Datos de la pagina principal y seccion Acerca

Archivo: [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)

Aqui esta la informacion que alimenta la home, el menu y la pagina de acerca.

Edita:
- `index()` para sucursales, promociones, hero y vacantes recientes.
- `menu()` para el catalogo completo.
- `about()` para historia, mision, vision, linea de tiempo y valores.
- `getMenuItems()` si quieres cambiar productos del menu.

## 3. Bolsa de trabajo publica

Archivo: [app/Http/Controllers/VacancyController.php](../app/Http/Controllers/VacancyController.php)

Edita este archivo si quieres cambiar:
- como se listan las vacantes publicas,
- la validacion del alta de vacantes,
- donde se guardan las imagenes de vacantes.

## 4. Rutas del sitio

Archivo: [routes/web.php](../routes/web.php)

Aqui se define a que controlador va cada enlace.

Edita este archivo si quieres:
- cambiar una URL,
- renombrar una ruta,
- quitar o agregar paginas.

## 5. Vistas principales

Archivos:
- [resources/views/about.blade.php](../resources/views/about.blade.php)
- [resources/views/menu.blade.php](../resources/views/menu.blade.php)
- [resources/views/vacancies/index.blade.php](../resources/views/vacancies/index.blade.php)

Edita estas vistas si quieres cambiar el diseño o los textos fijos de cada pagina.

## 6. Secciones de la home

Archivos:
- [resources/views/partials/hero.blade.php](../resources/views/partials/hero.blade.php)
- [resources/views/partials/surcusales.blade.php](../resources/views/partials/surcusales.blade.php)
- [resources/views/partials/menu.blade.php](../resources/views/partials/menu.blade.php)
- [resources/views/partials/promociones.blade.php](../resources/views/partials/promociones.blade.php)
- [resources/views/partials/confianza.blade.php](../resources/views/partials/confianza.blade.php)
- [resources/views/partials/acerca.blade.php](../resources/views/partials/acerca.blade.php)
- [resources/views/partials/contacto.blade.php](../resources/views/partials/contacto.blade.php)
- [resources/views/partials/footer.blade.php](../resources/views/partials/footer.blade.php)

Cada parcial es una seccion de la portada.

## 7. Estilos globales

Archivo: [resources/css/app.css](../resources/css/app.css)

Aqui puedes cambiar:
- tipografia base,
- clases globales como `section-title`, `section-subtitle`, `card-soft`,
- estilo del logo en modo oscuro.

## 8. JavaScript global

Archivo: [resources/js/app.js](../resources/js/app.js)

Aqui vive la logica de:
- cambio de tema,
- slider principal,
- modal del hero,
- carrusel de testimonios,
- modal de historia en la pagina Acerca.

## 9. Imagenes y archivos publicos

Carpeta: [public/images](../public/images)

Usa esta carpeta para cambiar imagenes del sitio.

Si agregas una imagen nueva, normalmente solo necesitas:
- copiarla a `public/images`,
- actualizar la ruta en `HomeController.php` o en la vista que la usa.

## 10. Flujo recomendado para editar contenido

1. Cambia los datos en el controlador que corresponda.
2. Ajusta la vista si necesitas modificar el formato.
3. Verifica la pagina en el navegador.
4. Si tocas JS o CSS, revisa el resultado con Vite activo.

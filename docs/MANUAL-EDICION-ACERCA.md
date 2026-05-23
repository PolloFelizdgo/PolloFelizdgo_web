# Manual de edicion de la pagina Acerca

Este archivo explica donde editar cada texto e imagen de la pagina `Acerca de nosotros`.

## 1. Imagen principal y tarjetas superiores

Archivo: [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)

Edita el arreglo `$aboutImages` dentro del metodo `about()`.

Campos:
- `hero`: imagen principal grande de la pagina.
- `history`: imagen usada en la tarjeta de Historia.
- `mission`: imagen usada en la tarjeta de Mision.
- `vision`: imagen usada en la tarjeta de Vision.

## 2. Linea de tiempo

Archivo: [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)

Edita el arreglo `$timeline` dentro del metodo `about()`.

Cada bloque contiene:
- `year`: ano que se muestra.
- `title`: titulo del hito.
- `description`: texto explicativo del hito.
- `image`: imagen mostrada en la tarjeta.

## 3. Valores institucionales

Archivo: [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)

Edita el arreglo `$values` dentro del metodo `about()`.

Cada tarjeta usa:
- `icon`: emoji o simbolo.
- `title`: nombre del valor.
- `description`: texto descriptivo.

## 4. Texto visible en pantalla

Archivo: [resources/views/about.blade.php](../resources/views/about.blade.php)

La vista solo muestra la informacion que llega desde el controller.
Si quieres cambiar frases como "Nuestra historia, mision y vision", el texto de introduccion o los encabezados, edita este archivo.

## 5. Recomendacion de trabajo

Si vas a cambiar contenido frecuentemente:
- primero actualiza `HomeController.php` para datos e imagenes,
- luego ajusta `about.blade.php` si quieres cambiar el formato o los textos fijos,
- usa archivos dentro de `public/images` para nuevas imagenes.

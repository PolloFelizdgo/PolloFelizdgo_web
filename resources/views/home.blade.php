<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Pollo Feliz Durango</title>
    <meta name="description" content="Pollo Feliz Durango: sucursales, menú, promociones y contacto para ordenar pollo asado con sabor tradicional.">
    <meta property="og:title" content="Inicio | Pollo Feliz Durango">
    <meta property="og:description" content="Conoce sucursales, promociones y menú de Pollo Feliz Durango.">
    <meta property="og:image" content="{{ url('/images/portada.jpg') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (() => {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="bg-[#fffaf5] text-gray-800 dark:bg-gray-950 dark:text-gray-100 transition-colors duration-300">
    @include('partials.navbar')
    @include('partials.hero')
    @include('partials.surcusales')
    @include('partials.menu')
    @include('partials.promociones')
    @include('partials.confianza')
    @include('partials.acerca')
    @include('partials.contacto')
    @include('partials.footer')
</body>
</html>








































































 


























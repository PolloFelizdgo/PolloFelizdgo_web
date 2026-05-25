<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada | Pollo Feliz</title>
    <meta name="description" content="La página solicitada no fue encontrada. Regresa al inicio de Pollo Feliz Durango.">
    <meta name="robots" content="noindex, nofollow">
    <meta property="og:title" content="Página no encontrada | Pollo Feliz Durango">
    <meta property="og:description" content="La ruta que intentas abrir no está disponible. Regresa al inicio.">
    <meta property="og:image" content="{{ url('/images/portada.jpg') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    @vite(['resources/css/app.css'])

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
<body class="min-h-screen bg-[#fffaf5] text-gray-800 dark:bg-gray-950 dark:text-gray-100 transition-colors duration-300">
    <main class="min-h-screen flex items-center justify-center px-4 py-12">
        <section class="w-full max-w-3xl bg-white/95 dark:bg-gray-900/95 rounded-[2rem] shadow-2xl border border-yellow-100 dark:border-gray-800 p-8 md:p-12 text-center">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logotipo oficial de Pollo Feliz"
                class="w-20 h-20 object-contain mx-auto"
            >

            <p class="mt-6 text-sm uppercase tracking-[0.28em] text-red-600 dark:text-yellow-400 font-semibold">Error 404</p>
            <h1 class="mt-3 text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white">Página no encontrada</h1>
            <p class="mt-5 text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                La ruta que intentas abrir no está disponible. Puedes volver al inicio para continuar navegando por nuestro sitio.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-7 py-3 rounded-full font-semibold shadow-lg transition"
                >
                    Ir al inicio
                </a>
                <a
                    href="{{ route('menu.full') }}"
                    class="inline-flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-7 py-3 rounded-full font-semibold shadow-lg transition"
                >
                    Ver menú completo
                </a>
            </div>
        </section>
    </main>
</body>
</html>
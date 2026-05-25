<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso de Privacidad | Pollo Feliz Durango</title>
    <meta name="description" content="Consulta el aviso de privacidad de Pollo Feliz Durango y el tratamiento de datos personales conforme a la LFPDPPP.">
    <meta property="og:title" content="Aviso de Privacidad | Pollo Feliz Durango">
    <meta property="og:description" content="Información legal sobre tratamiento de datos personales en Pollo Feliz Durango.">
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
<body class="min-h-screen bg-[#fffaf5] text-gray-800 dark:bg-gray-950 dark:text-gray-100 transition-colors duration-300">
    <header class="sticky top-0 z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-md transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logotipo oficial de Pollo Feliz" class="brand-logo w-12 h-12 sm:w-14 sm:h-14 object-contain">
                <span class="text-lg sm:text-2xl font-extrabold text-red-600 dark:text-yellow-400">PolloFeliz</span>
            </a>

            <a href="{{ route('home') }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2.5 rounded-full font-semibold shadow-md transition">
                Volver al inicio
            </a>
        </div>
    </header>

    <main class="py-16">
        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-[2rem] bg-white dark:bg-gray-900 border border-yellow-100 dark:border-gray-800 shadow-xl p-8 md:p-10">
                <p class="text-sm uppercase tracking-[0.2em] text-red-600 dark:text-yellow-400 font-semibold">Marco legal</p>
                <h1 class="mt-2 text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white">Aviso de Privacidad</h1>
                <p class="mt-5 text-gray-600 dark:text-gray-300 leading-relaxed">
                    En cumplimiento con la Ley Federal de Proteccion de Datos Personales en Posesion de los Particulares (LFPDPPP), Pollo Feliz Durango informa el tratamiento que da a los datos personales recabados a traves de este sitio.
                </p>

                <div class="mt-8 space-y-6 text-gray-700 dark:text-gray-200 leading-relaxed">
                    <section>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">1. Responsable del tratamiento</h2>
                        <p class="mt-2">Pollo Feliz Durango es responsable del uso y proteccion de los datos personales recabados mediante formularios, correo electronico y canales oficiales de contacto.</p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">2. Datos que se recaban</h2>
                        <p class="mt-2">Nombre, apellidos, correo electronico, telefono y el contenido del mensaje enviado por el usuario.</p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">3. Finalidades del tratamiento</h2>
                        <ul class="mt-2 list-disc list-inside space-y-1">
                            <li>Dar respuesta a solicitudes enviadas por formulario de contacto.</li>
                            <li>Atender solicitudes relacionadas con facturacion y soporte.</li>
                            <li>Mantener comunicacion operativa con clientes y prospectos.</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">4. Transferencias de datos</h2>
                        <p class="mt-2">Pollo Feliz Durango no comercializa datos personales. Solo podran compartirse cuando exista obligacion legal o requerimiento de autoridad competente.</p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">5. Derechos ARCO</h2>
                        <p class="mt-2">El titular puede solicitar acceso, rectificacion, cancelacion u oposicion al tratamiento de sus datos mediante solicitud escrita al correo <a class="text-red-600 dark:text-yellow-400 hover:underline" href="mailto:contacto@pollofeliz.com">contacto@pollofeliz.com</a>.</p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">6. Cambios al aviso</h2>
                        <p class="mt-2">Cualquier actualizacion se publicara en esta misma pagina con fecha de vigencia.</p>
                    </section>

                    <p class="text-sm text-gray-500 dark:text-gray-400">Ultima actualizacion: {{ now()->format('d/m/Y') }}</p>
                </div>
            </div>
        </section>
    </main>

    @include('partials.footer')
</body>
</html>
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolsa de Trabajo | Pollo Feliz Durango</title>
    <meta name="description" content="Consulta vacantes activas en Pollo Feliz Durango y postúlate para formar parte de nuestro equipo.">
    <meta property="og:title" content="Bolsa de Trabajo | Pollo Feliz Durango">
    <meta property="og:description" content="Oportunidades laborales en operaciones, cocina, caja y áreas administrativas.">
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
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Logotipo oficial de Pollo Feliz"
                    class="brand-logo w-12 h-12 sm:w-14 sm:h-14 object-contain"
                >
                <span class="text-lg sm:text-2xl font-extrabold text-red-600 dark:text-yellow-400">
                    PolloFeliz
                </span>
            </a>

            <div class="flex items-center gap-3">
                <button
                    type="button"
                    id="menuThemeToggle"
                    class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-white dark:bg-gray-800 text-xl shadow-md border border-gray-100 dark:border-gray-700 hover:scale-105 transition"
                    aria-label="Cambiar tema"
                >
                    <span id="menuThemeIcon">🌙</span>
                </button>

                <a
                    href="{{ route('home') }}#vacantes"
                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2.5 rounded-full font-semibold shadow-md transition"
                >
                    Volver al inicio
                </a>
            </div>
        </div>
    </header>

    <main class="py-16">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-[2rem] bg-gradient-to-br from-red-700 via-red-600 to-yellow-500 text-white p-8 shadow-2xl">
                <p class="uppercase tracking-[0.24em] text-sm text-white/80">Bolsa de trabajo</p>
                <h1 class="text-4xl md:text-5xl font-extrabold mt-3">Vacantes disponibles en Pollo Feliz</h1>
                <p class="mt-4 text-white/85 max-w-3xl">
                    Consulta las oportunidades activas de RH, operaciones, caja, cocina o facturacion y postulate por nuestros canales de contacto.
                </p>
            </div>

            <div class="mt-10">
                <div class="flex items-center justify-between gap-4 mb-6">
                    <div>
                        <h2 class="section-title !text-3xl md:!text-4xl">Vacantes publicadas</h2>
                        <p class="section-subtitle !mx-0">Muestra las oportunidades disponibles para tu equipo.</p>
                    </div>
                    <span class="text-sm font-semibold text-red-600 dark:text-yellow-400 bg-red-50 dark:bg-gray-900 border border-red-100 dark:border-gray-800 px-4 py-2 rounded-full">
                        {{ $vacancies->count() }} activas
                    </span>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    @forelse($vacancies as $vacancy)
                        <article class="card-soft border border-yellow-100 dark:border-gray-800 overflow-hidden">
                            @if($vacancy->image_path)
                                <img
                                    src="{{ asset($vacancy->image_path) }}"
                                    alt="Vacante de {{ $vacancy->title }} en Pollo Feliz"
                                    class="w-full h-52 object-cover"
                                    loading="lazy"
                                    decoding="async"
                                >
                            @endif

                            <div class="p-6">
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-red-600 dark:text-yellow-400 bg-red-50 dark:bg-gray-950 px-3 py-2 rounded-full">{{ $vacancy->department }}</span>
                                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 px-3 py-2 rounded-full">{{ $vacancy->employment_type }}</span>
                                </div>

                                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $vacancy->title }}</h3>
                                <p class="mt-3 text-gray-600 dark:text-gray-300">{{ $vacancy->summary }}</p>

                                <div class="mt-5 grid sm:grid-cols-2 gap-3 text-sm font-medium text-gray-600 dark:text-gray-300">
                                    <p><span class="font-bold text-gray-900 dark:text-white">Ubicacion:</span> {{ $vacancy->location }}</p>
                                    @if($vacancy->schedule)
                                        <p><span class="font-bold text-gray-900 dark:text-white">Horario:</span> {{ $vacancy->schedule }}</p>
                                    @endif
                                    @if($vacancy->salary)
                                        <p><span class="font-bold text-gray-900 dark:text-white">Sueldo:</span> {{ $vacancy->salary }}</p>
                                    @endif
                                    @if($vacancy->published_at)
                                        <p><span class="font-bold text-gray-900 dark:text-white">Publicada:</span> {{ $vacancy->published_at->format('d/m/Y') }}</p>
                                    @endif
                                </div>

                                @if($vacancy->requirements)
                                    <div class="mt-5">
                                        <h4 class="font-bold text-gray-900 dark:text-white mb-3">Requisitos</h4>
                                        <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                            @foreach(preg_split('/\r\n|\r|\n/', $vacancy->requirements) as $requirement)
                                                @if(trim($requirement) !== '')
                                                    <li class="flex items-start gap-2">
                                                        <span class="text-red-600 dark:text-yellow-400 mt-0.5">•</span>
                                                        <span>{{ trim($requirement) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="md:col-span-2 rounded-[2rem] bg-white dark:bg-gray-900 border border-dashed border-yellow-200 dark:border-gray-700 p-10 text-center shadow-md">
                            <h3 class="text-2xl font-extrabold text-red-600 dark:text-yellow-400">Aun no hay vacantes publicadas</h3>
                            <p class="mt-3 text-gray-600 dark:text-gray-300">Por el momento no hay posiciones activas. Vuelve pronto para revisar nuevas oportunidades.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    @include('partials.footer')
</body>
</html>
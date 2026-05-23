<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de Nosotros | Pollo Feliz</title>
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
                    alt="Pollo Feliz"
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
                    href="{{ route('home') }}#acerca"
                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2.5 rounded-full font-semibold shadow-md transition"
                >
                    Volver al inicio
                </a>
            </div>
        </div>
    </header>

    <main class="py-16">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="text-red-500 dark:text-yellow-400 font-semibold uppercase tracking-[0.25em] text-sm">Acerca de nosotros</p>
                    <h1 class="mt-3 text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white leading-tight">Nuestra historia, mision y vision</h1>
                    <p class="mt-5 text-lg text-gray-600 dark:text-gray-300 max-w-2xl">
                        Conoce el camino que nos ha convertido en una marca cercana a las familias mexicanas y el compromiso que guia cada decision en Pollo Feliz.
                    </p>

                    <div class="mt-8 grid grid-cols-3 gap-3 max-w-md">
                        <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-md text-center">
                            <p class="text-2xl font-extrabold text-red-600 dark:text-yellow-400">8+</p>
                            <p class="text-xs text-gray-600 dark:text-gray-300">Sucursales</p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-md text-center">
                            <p class="text-2xl font-extrabold text-red-600 dark:text-yellow-400">20+</p>
                            <p class="text-xs text-gray-600 dark:text-gray-300">Anos de experiencia</p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-md text-center">
                            <p class="text-2xl font-extrabold text-red-600 dark:text-yellow-400">100%</p>
                            <p class="text-xs text-gray-600 dark:text-gray-300">Sabor tradicional</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    {{-- Cambia la imagen principal corporativa desde HomeController->about() en la llave hero --}}
                    <img
                        src="{{ $aboutImages['hero'] }}"
                        alt="Portada corporativa Pollo Feliz"
                        class="w-full h-[320px] md:h-[420px] object-cover rounded-3xl shadow-2xl"
                    >
                    <div class="absolute inset-x-4 bottom-4 bg-black/65 backdrop-blur-sm rounded-2xl p-4">
                        <p class="text-white text-sm md:text-base">
                            Pollo Feliz: sabor, servicio y confianza para miles de familias en Durango.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-12 grid md:grid-cols-3 gap-6">
                <article class="card-soft border border-yellow-100 dark:border-gray-800 overflow-hidden">
                    {{-- Cambia la imagen de historia desde HomeController->about() en la llave history --}}
                    <img src="{{ $aboutImages['history'] }}" alt="Historia Pollo Feliz" class="w-full h-44 object-cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-extrabold text-red-600 dark:text-yellow-400">Historia</h2>
                        <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                            Pollo Feliz nacio con la idea de ofrecer pollo asado de gran sabor, preparado con recetas tradicionales y atencion cercana.
                        </p>
                    </div>
                </article>

                <article class="card-soft border border-yellow-100 dark:border-gray-800 overflow-hidden">
                    {{-- Cambia la imagen de mision desde HomeController->about() en la llave mission --}}
                    <img src="{{ $aboutImages['mission'] }}" alt="Mision Pollo Feliz" class="w-full h-44 object-cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-extrabold text-red-600 dark:text-yellow-400">Mision</h2>
                        <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                            Brindar alimentos de calidad, con sabor autentico y servicio excepcional, para crear momentos memorables alrededor de la mesa.
                        </p>
                    </div>
                </article>

                <article class="card-soft border border-yellow-100 dark:border-gray-800 overflow-hidden">
                    {{-- Cambia la imagen de vision desde HomeController->about() en la llave vision --}}
                    <img src="{{ $aboutImages['vision'] }}" alt="Vision Pollo Feliz" class="w-full h-44 object-cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-extrabold text-red-600 dark:text-yellow-400">Vision</h2>
                        <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                            Ser la opcion favorita de pollo asado en la region, reconocida por su sabor, cercania con la comunidad e innovacion constante.
                        </p>
                    </div>
                </article>
            </div>

            <section class="mt-14">
                <div class="text-center mb-8">
                    <p class="text-red-500 dark:text-yellow-400 font-semibold uppercase tracking-[0.2em] text-xs">Linea de tiempo</p>
                    <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white">Hitos corporativos</h2>
                </div>

                <div class="relative max-w-6xl mx-auto">
                    <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-1 -translate-x-1/2 bg-yellow-300/70 dark:bg-yellow-500/30 rounded-full"></div>

                    <div class="space-y-8">
                        @foreach($timeline as $milestone)
                            <article class="reveal-on-scroll opacity-100 translate-y-0 transition-all duration-700 grid md:grid-cols-2 gap-6 md:gap-10 items-center">
                                @if($loop->odd)
                                    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-yellow-100 dark:border-gray-800 shadow-xl overflow-hidden">
                                        <img src="{{ $milestone['image'] }}" alt="{{ $milestone['title'] }}" class="w-full h-48 object-cover">
                                        <div class="p-6">
                                            <div class="flex items-center gap-3">
                                                <span class="inline-flex items-center justify-center min-w-16 h-9 px-3 rounded-full bg-red-600 text-white font-bold text-sm">{{ $milestone['year'] }}</span>
                                                <h3 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $milestone['title'] }}</h3>
                                            </div>
                                            <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">{{ $milestone['description'] }}</p>
                                        </div>
                                    </div>

                                    <div class="relative hidden md:block">
                                        <span class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-6 h-6 rounded-full border-4 border-white dark:border-gray-900 bg-red-600 dark:bg-yellow-400 shadow-md"></span>
                                    </div>
                                @else
                                    <div class="relative hidden md:block">
                                        <span class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-6 h-6 rounded-full border-4 border-white dark:border-gray-900 bg-red-600 dark:bg-yellow-400 shadow-md"></span>
                                    </div>

                                    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-yellow-100 dark:border-gray-800 shadow-xl overflow-hidden">
                                        <img src="{{ $milestone['image'] }}" alt="{{ $milestone['title'] }}" class="w-full h-48 object-cover">
                                        <div class="p-6">
                                            <div class="flex items-center gap-3">
                                                <span class="inline-flex items-center justify-center min-w-16 h-9 px-3 rounded-full bg-red-600 text-white font-bold text-sm">{{ $milestone['year'] }}</span>
                                                <h3 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $milestone['title'] }}</h3>
                                            </div>
                                            <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">{{ $milestone['description'] }}</p>
                                        </div>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="mt-14">
                <div class="text-center mb-8">
                    <p class="text-red-500 dark:text-yellow-400 font-semibold uppercase tracking-[0.2em] text-xs">Valores institucionales</p>
                    <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white">Lo que nos define</h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($values as $value)
                        <article class="card-soft border border-yellow-100 dark:border-gray-800 p-6 text-center">
                            <div class="w-14 h-14 mx-auto rounded-2xl bg-yellow-300/40 dark:bg-yellow-500/20 flex items-center justify-center text-2xl">
                                {{ $value['icon'] }}
                            </div>
                            <h3 class="mt-4 text-xl font-extrabold text-gray-900 dark:text-white">{{ $value['title'] }}</h3>
                            <p class="mt-3 text-gray-600 dark:text-gray-300 leading-relaxed text-sm">
                                {{ $value['description'] }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </section>

            <div class="mt-12 bg-white dark:bg-gray-900 rounded-3xl shadow-xl p-8 border border-yellow-100 dark:border-gray-800">
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">Compromiso corporativo</h3>
                <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                    Nuestro enfoque corporativo combina estandares operativos, capacitacion continua y una cultura de servicio al cliente. Cada sucursal trabaja con procesos definidos para mantener calidad constante en producto, atencion y experiencia.
                </p>
                <ul class="mt-6 grid md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-200">
                    <li class="bg-[#fff7eb] dark:bg-gray-800 rounded-2xl p-4">Control de calidad en cocina y servicio.</li>
                    <li class="bg-[#fff7eb] dark:bg-gray-800 rounded-2xl p-4">Capacitacion continua para todo el equipo.</li>
                    <li class="bg-[#fff7eb] dark:bg-gray-800 rounded-2xl p-4">Innovacion en menu y promociones estrategicas.</li>
                    <li class="bg-[#fff7eb] dark:bg-gray-800 rounded-2xl p-4">Compromiso con clientes, comunidad y crecimiento responsable.</li>
                </ul>
            </div>
        </section>
    </main>

    @include('partials.footer')
</body>
</html>

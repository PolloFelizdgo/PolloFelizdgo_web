<section id="inicio" class="relative overflow-hidden bg-gradient-to-r from-yellow-100 via-white to-red-50 dark:from-gray-950 dark:via-gray-900 dark:to-gray-950 pt-28 pb-16 sm:pt-32 sm:pb-20 lg:min-h-screen lg:flex lg:items-center transition-colors duration-300">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-8 left-4 sm:top-10 sm:left-10 w-28 h-28 sm:w-40 sm:h-40 bg-yellow-300/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-8 right-4 sm:bottom-10 sm:right-10 w-36 h-36 sm:w-56 sm:h-56 bg-red-300/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-10 lg:gap-12 items-center z-10">
        <div class="order-2 lg:order-1 text-center lg:text-left">
            <p class="text-red-500 dark:text-yellow-400 font-semibold uppercase tracking-[0.22em] sm:tracking-[0.3em] mb-3 text-xs sm:text-sm transition-colors duration-300">
                Tradición y sabor
            </p>

            <h1 id="heroTitle" class="text-3xl sm:text-4xl md:text-5xl xl:text-7xl font-extrabold leading-tight text-gray-900 dark:text-white transition-colors duration-300">
                {{ $heroSlides[0]['title'] ?? 'El sabor que une a la familia' }}
            </h1>

            <p id="heroDescription" class="mt-5 sm:mt-6 text-base sm:text-lg md:text-xl text-gray-600 dark:text-gray-300 leading-relaxed max-w-xl mx-auto lg:mx-0 transition-colors duration-300">
                {{ $heroSlides[0]['text'] ?? 'Disfruta del auténtico sabor de Pollo Feliz con la mejor calidad y tradición.' }}
            </p>

            <div class="mt-8 flex flex-col sm:flex-row sm:flex-wrap gap-4 justify-center lg:justify-start">
                <a href="#contacto" class="bg-red-600 hover:bg-red-700 text-white px-6 sm:px-7 py-3.5 rounded-full shadow-lg transition duration-300 text-sm sm:text-base">
                    Ordena ahora
                </a>
                <a href="#sucursales" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-6 sm:px-7 py-3.5 rounded-full shadow-lg transition duration-300 text-sm sm:text-base">
                    Ver sucursales
                </a>
            </div>

            <div class="mt-8 sm:mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-xl mx-auto lg:mx-0">
                <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm rounded-2xl shadow-md p-4 text-center transition-colors duration-300">
                    <p class="text-2xl font-extrabold text-red-600">8+</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Sucursales</p>
                </div>
                <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm rounded-2xl shadow-md p-4 text-center transition-colors duration-300">
                    <p class="text-2xl font-extrabold text-red-600">100%</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Sabor tradicional</p>
                </div>
                <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm rounded-2xl shadow-md p-4 text-center transition-colors duration-300">
                    <p class="text-2xl font-extrabold text-red-600">+Familia</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Momentos felices</p>
                </div>
            </div>
        </div>

        <div class="order-1 lg:order-2 relative">
            <div class="relative bg-white/70 dark:bg-gray-900/70 backdrop-blur-md p-2 sm:p-3 rounded-[1.75rem] sm:rounded-[2rem] shadow-2xl transition-colors duration-300">
                <div class="relative overflow-hidden rounded-[1.25rem] sm:rounded-[1.5rem]">
                    @foreach($heroSlides as $index => $slide)
                        <div
                            class="hero-slide {{ $index === 0 ? 'block' : 'hidden' }}"
                            data-slide-index="{{ $index }}"
                            data-title="{{ $slide['title'] }}"
                            data-text="{{ $slide['text'] }}"
                        >
                            <button
                                type="button"
                                class="hero-preview-trigger block w-full"
                                data-image="{{ $slide['image'] }}"
                                data-title="{{ $slide['title'] }}"
                            >
                                <img
                                    src="{{ $slide['image'] }}"
                                    alt="{{ $slide['title'] }} en Pollo Feliz"
                                    class="w-full h-[260px] sm:h-[340px] md:h-[420px] lg:h-[500px] object-cover cursor-pointer hover:scale-105 transition duration-500"
                                >
                            </button>
                        </div>
                    @endforeach

                    <button
                        type="button"
                        id="heroPrev"
                        class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-700 text-gray-900 dark:text-white w-9 h-9 sm:w-11 sm:h-11 rounded-full shadow-lg text-lg sm:text-xl font-bold transition flex items-center justify-center"
                    >
                        ‹
                    </button>

                    <button
                        type="button"
                        id="heroNext"
                        class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-700 text-gray-900 dark:text-white w-9 h-9 sm:w-11 sm:h-11 rounded-full shadow-lg text-lg sm:text-xl font-bold transition flex items-center justify-center"
                    >
                        ›
                    </button>
                </div>

                <div class="flex justify-center gap-2 sm:gap-3 mt-4 sm:mt-5">
                    @foreach($heroSlides as $index => $slide)
                        <button
                            type="button"
                            class="hero-dot w-3 h-3 sm:w-3.5 sm:h-3.5 rounded-full {{ $index === 0 ? 'bg-red-600' : 'bg-gray-300 dark:bg-gray-600' }}"
                            data-dot-index="{{ $index }}"
                        ></button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div
        id="heroImageModal"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/80 px-3 sm:px-4 py-6 sm:py-8"
    >
        <div class="relative max-w-5xl w-full">
            <button
                type="button"
                id="closeHeroImageModal"
                class="absolute -top-3 right-0 sm:-top-5 sm:-right-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-full w-9 h-9 sm:w-10 sm:h-10 shadow-lg text-xl sm:text-2xl font-bold hover:bg-gray-100 dark:hover:bg-gray-700 transition"
            >
                ×
            </button>

            <div class="bg-white dark:bg-gray-900 rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl transition-colors duration-300">
                <img
                    id="heroModalImage"
                    src=""
                    alt=""
                    class="w-full max-h-[75vh] sm:max-h-[80vh] object-cover"
                >
                <div class="p-4 sm:p-6">
                    <h3 id="heroModalTitle" class="text-xl sm:text-2xl font-extrabold text-red-600 dark:text-yellow-400"></h3>
                </div>
            </div>
        </div>
    </div>
</section>
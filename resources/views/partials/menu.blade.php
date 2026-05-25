<section id="menu" class="py-20 bg-gradient-to-b from-yellow-50 to-white dark:from-gray-950 dark:to-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="section-title">Menú</h2>
            <p class="section-subtitle">Descubre nuestra selección de platillos, combos y complementos.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredMenuItems as $item)
                <div class="reveal-on-scroll transition-all duration-700 card-soft border border-yellow-100 dark:border-gray-700 overflow-hidden">
                    <button
                        type="button"
                        class="menu-image-trigger block w-full text-left"
                        data-image="{{ $item['image'] }}"
                        data-title="{{ $item['name'] }}"
                    >
                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['name'] }} de Pollo Feliz"
                            class="w-full h-56 object-cover cursor-pointer hover:scale-105 transition duration-500"
                            loading="lazy"
                            decoding="async"
                        >
                    </button>

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $item['name'] }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-3">{{ $item['description'] }}</p>
                        <p class="mt-4 text-2xl font-extrabold text-red-600 dark:text-yellow-400">{{ $item['price'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a
                href="{{ route('menu.full') }}"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-full shadow-lg transition duration-300"
            >
                Ver más
                <span>→</span>
            </a>
        </div>
    </div>

    <!-- Modal preview menú -->
    <div
        id="menuImageModal"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/80 px-4 py-8"
    >
        <div class="relative max-w-4xl w-full">
            <button
                type="button"
                id="closeMenuImageModal"
                class="absolute -top-4 -right-2 md:-top-5 md:-right-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-full w-10 h-10 shadow-lg text-2xl font-bold hover:bg-gray-100 dark:hover:bg-gray-700 transition"
            >
                ×
            </button>

            <div class="bg-white dark:bg-gray-900 rounded-3xl overflow-hidden shadow-2xl transition-colors duration-300">
                <img
                    id="menuModalImage"
                    src=""
                    alt=""
                    class="w-full max-h-[80vh] object-cover"
                >
                <div class="p-4 md:p-6">
                    <h3 id="menuModalTitle" class="text-2xl font-extrabold text-red-600 dark:text-yellow-400"></h3>
                </div>
            </div>
        </div>
    </div>
</section>
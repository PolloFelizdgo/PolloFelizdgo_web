<section id="sucursales" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <h2 class="section-title">Nuestras Sucursales</h2>
            <p class="section-subtitle">
                Encuentra tu sucursal más cercana y disfruta del auténtico sabor de Pollo Feliz.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($branches as $branch)
                <div class="bg-[#fff8f0] dark:bg-gray-800 rounded-3xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">
                    <button
                        type="button"
                        class="branch-image-trigger block w-full text-left"
                        data-image="{{ $branch['image'] }}"
                        data-title="{{ $branch['name'] }}"
                    >
                        <img
                            src="{{ $branch['image'] }}"
                            alt="Fachada de la {{ $branch['name'] }} de Pollo Feliz"
                            class="h-48 w-full object-cover cursor-pointer hover:scale-105 transition duration-300"
                            loading="lazy"
                            decoding="async"
                        >
                    </button>

                    <div class="p-5">
                        <h3 class="text-xl font-bold text-red-600 dark:text-yellow-400">{{ $branch['name'] }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ $branch['address'] }}</p>
                        <p class="text-sm text-gray-700 dark:text-gray-200 mt-2"><strong>Tel:</strong> {{ $branch['phone'] }}</p>
                        <p class="text-sm text-gray-700 dark:text-gray-200"><strong>Horario:</strong> {{ $branch['hours'] }}</p>

                        <a
                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($branch['address']) }}"
                            target="_blank"
                            class="inline-block mt-4 bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-4 py-2 rounded-full font-semibold transition">
                            Cómo llegar
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal de imagen -->
    <div
        id="branchImageModal"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/80 px-4 py-8"
    >
        <div class="relative max-w-4xl w-full">
            <button
                type="button"
                id="closeBranchImageModal"
                class="absolute -top-4 -right-2 md:-top-5 md:-right-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-full w-10 h-10 shadow-lg text-2xl font-bold hover:bg-gray-100 dark:hover:bg-gray-700 transition"
            >
                ×
            </button>

            <div class="bg-white dark:bg-gray-900 rounded-3xl overflow-hidden shadow-2xl transition-colors duration-300">
                <img
                    id="branchModalImage"
                    src=""
                    alt=""
                    class="w-full max-h-[80vh] object-cover"
                >
                <div class="p-4 md:p-6">
                    <h3 id="branchModalTitle" class="text-2xl font-extrabold text-red-600 dark:text-yellow-400"></h3>
                </div>
            </div>
        </div>
    </div>
</section>
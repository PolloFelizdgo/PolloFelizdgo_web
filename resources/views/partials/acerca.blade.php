<section id="acerca" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <img
                src="https://images.unsplash.com/photo-1559847844-5315695dadae?auto=format&fit=crop&w=1200&q=80"
                alt="Historia de Pollo Feliz"
                class="rounded-3xl shadow-2xl w-full object-cover"
            >
        </div>

        <div>
            <p class="text-red-500 dark:text-yellow-400 font-semibold uppercase tracking-wider mb-2">Acerca de nosotros</p>
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white">Tradición que se disfruta en familia</h2>

            <p class="mt-6 text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                Pollo Feliz nació con la misión de ofrecer el mejor pollo asado con recetas tradicionales y un sabor único que ha acompañado a miles de familias mexicanas durante generaciones.
            </p>

            <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                Nuestro compromiso es brindar calidad, sabor y excelente servicio en cada visita, creando momentos memorables alrededor de la mesa.
            </p>

            <div class="mt-8">
                <a
                    href="{{ route('about') }}"
                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-7 py-3 rounded-full shadow-lg transition duration-300"
                >
                    Saber mas
                    <span>→</span>
                </a>
            </div>
        </div>
    </div>
</section>
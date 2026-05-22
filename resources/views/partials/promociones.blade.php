<section id="promociones" class="py-20 bg-red-50 dark:bg-gray-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <h2 class="section-title">Promociones</h2>
            <p class="section-subtitle">Aprovecha nuestras promociones especiales para compartir.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($promotions as $promo)
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 border-l-8 border-yellow-400 hover:-translate-y-1 transition duration-300">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $promo['title'] }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-3">{{ $promo['description'] }}</p>
                    <p class="mt-5 text-3xl font-extrabold text-red-600 dark:text-yellow-400">{{ $promo['price'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section id="menu" class="py-20 bg-gradient-to-b from-yellow-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <h2 class="section-title">Menú</h2>
            <p class="section-subtitle">Descubre nuestros productos y combos favoritos.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($menuItems as $item)
                <div class="card-soft p-6 border border-yellow-100">
                    <h3 class="text-xl font-bold text-gray-900">{{ $item['name'] }}</h3>
                    <p class="text-gray-600 mt-3">{{ $item['description'] }}</p>
                    <p class="mt-4 text-2xl font-extrabold text-red-600">{{ $item['price'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
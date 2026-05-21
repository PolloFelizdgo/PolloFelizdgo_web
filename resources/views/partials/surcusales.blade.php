<section id="sucursales" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <h2 class="section-title">Nuestras Sucursales</h2>
            <p class="section-subtitle">
                Encuentra tu sucursal más cercana y disfruta del auténtico sabor de Pollo Feliz.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($branches as $branch)
                <div class="bg-[#fff8f0] rounded-3xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">
                    <img src="{{ $branch['image'] }}" alt="{{ $branch['name'] }}" class="h-48 w-full object-cover">

                    <div class="p-5">
                        <h3 class="text-xl font-bold text-red-600">{{ $branch['name'] }}</h3>
                        <p class="text-sm text-gray-600 mt-2">{{ $branch['address'] }}</p>
                        <p class="text-sm text-gray-700 mt-2"><strong>Tel:</strong> {{ $branch['phone'] }}</p>
                        <p class="text-sm text-gray-700"><strong>Horario:</strong> {{ $branch['hours'] }}</p>

                        <div class="mt-4 rounded-xl overflow-hidden">
                            <iframe
                                src="{{ $branch['map'] }}"
                                width="100%"
                                height="180"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy">
                            </iframe>
                        </div>

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
</section>
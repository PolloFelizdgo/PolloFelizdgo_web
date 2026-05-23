<section id="vacantes" class="py-20 bg-gradient-to-b from-white to-[#fff6ea] dark:from-gray-950 dark:to-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="reveal-on-scroll opacity-100 translate-y-0 transition duration-700 ease-out text-center max-w-3xl mx-auto mb-8">
            <p class="text-red-500 dark:text-yellow-400 font-semibold uppercase tracking-[0.24em] text-sm">Bolsa de trabajo</p>
            <h2 class="section-title mt-3">Bolsa de trabajo</h2>
            <p class="section-subtitle !mx-0">
                Centraliza vacantes de RH, facturacion, cocina, caja u operaciones en un apartado dedicado para Pollo Feliz.
            </p>
        </div>

        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($latestVacancies as $vacancy)
                    <article class="reveal-on-scroll opacity-100 translate-y-0 transition duration-700 ease-out card-soft border border-yellow-100 dark:border-gray-800 overflow-hidden" style="transition-delay: {{ $loop->index * 120 }}ms;">
                        @if($vacancy->image_path)
                            <img src="{{ asset($vacancy->image_path) }}" alt="{{ $vacancy->title }}" class="w-full h-44 object-cover">
                        @endif
                        <div class="p-5">
                            <p class="text-xs uppercase tracking-[0.22em] font-bold text-red-600 dark:text-yellow-400">{{ $vacancy->department }}</p>
                            <h3 class="text-xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $vacancy->title }}</h3>
                            <p class="mt-3 text-gray-600 dark:text-gray-300 text-sm">{{ $vacancy->summary }}</p>
                            <p class="mt-4 text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $vacancy->location }} · {{ $vacancy->employment_type }}</p>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 rounded-[2rem] bg-white dark:bg-gray-900 border border-dashed border-yellow-200 dark:border-gray-700 p-8 text-center shadow-md">
                        <h3 class="text-2xl font-extrabold text-red-600 dark:text-yellow-400">Sin vacantes publicadas</h3>
                        <p class="mt-3 text-gray-600 dark:text-gray-300">Entra al apartado y sube el primer post de vacante para que aparezca aqui.</p>
                    </div>
                @endforelse
            </div>
    </div>
</section>
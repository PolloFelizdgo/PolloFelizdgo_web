<section id="confianza" class="py-20 bg-gradient-to-b from-white to-red-50 dark:from-gray-900 dark:to-gray-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14 reveal-on-scroll opacity-100 translate-y-0 transition duration-700 ease-out">
            <p class="text-red-500 dark:text-yellow-400 font-semibold uppercase tracking-[0.22em] text-sm">Confianza de marca</p>
            <h2 class="section-title mt-2">¿Por qué elegirnos?</h2>
            <p class="section-subtitle">Calidad, higiene y rapidez en cada pedido para que disfrutes con tranquilidad.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-7 mb-12">
            <article class="card-soft border border-yellow-100 dark:border-gray-800 p-7 reveal-on-scroll opacity-100 translate-y-0 transition duration-700 ease-out">
                <div class="w-12 h-12 rounded-2xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-2xl mb-4">⭐</div>
                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">Calidad constante</h3>
                <p class="mt-3 text-gray-600 dark:text-gray-300">Ingredientes frescos, sabor tradicional y procesos estandarizados para mantener el mismo nivel en cada sucursal.</p>
            </article>

            <article class="card-soft border border-yellow-100 dark:border-gray-800 p-7 reveal-on-scroll opacity-100 translate-y-0 transition duration-700 ease-out" style="transition-delay: 120ms;">
                <div class="w-12 h-12 rounded-2xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-2xl mb-4">🛡️</div>
                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">Higiene y seguridad</h3>
                <p class="mt-3 text-gray-600 dark:text-gray-300">Cuidamos preparación y manejo de alimentos con limpieza diaria, control de temperatura y protocolos operativos.</p>
            </article>

            <article class="card-soft border border-yellow-100 dark:border-gray-800 p-7 reveal-on-scroll opacity-100 translate-y-0 transition duration-700 ease-out" style="transition-delay: 240ms;">
                <div class="w-12 h-12 rounded-2xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-2xl mb-4">⚡</div>
                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">Rapidez de servicio</h3>
                <p class="mt-3 text-gray-600 dark:text-gray-300">Atención ágil en mostrador y tiempos de entrega optimizados para que recibas tu pedido sin esperas largas.</p>
            </article>
        </div>

        <div class="reveal-on-scroll opacity-100 translate-y-0 transition duration-700 ease-out mx-auto w-full max-w-5xl" style="transition-delay: 120ms;">
                <div class="flex flex-col items-center text-center gap-4 mb-5">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">Testimonios de clientes</h3>
                        <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Una composición más visual, inspirada en las reseñas que compartiste.</p>
                    </div>
                    <div class="hidden md:flex flex-wrap gap-2 justify-center">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/90 dark:bg-gray-900 border border-yellow-100 dark:border-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm">🚚 Entrega rápida</span>
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/90 dark:bg-gray-900 border border-yellow-100 dark:border-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm">🥗 Fresco</span>
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/90 dark:bg-gray-900 border border-yellow-100 dark:border-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm">🤝 Atención</span>
                    </div>
                </div>

                <div class="testimonial-carousel relative overflow-hidden rounded-[2rem] bg-sky-50/80 dark:bg-sky-950/25 border border-sky-100 dark:border-sky-800 shadow-xl p-3 sm:p-6 mx-auto">
                    <div class="testimonial-track flex transition-transform duration-500 ease-out">
                        @foreach(($testimonials ?? []) as $testimonial)
                            @php
                                $rating = max(1, min(5, (int) ($testimonial['rating'] ?? 5)));
                                $name = (string) ($testimonial['name'] ?? 'Cliente');
                                $initials = collect(explode(' ', $name))
                                    ->filter()
                                    ->map(fn ($part) => mb_substr($part, 0, 1))
                                    ->take(2)
                                    ->join('');
                            @endphp
                            <article class="testimonial-slide min-w-full px-0 sm:px-4">
                                <div class="rounded-[1.9rem] bg-sky-50 dark:bg-sky-950/30 border border-sky-100 dark:border-sky-800 shadow-lg p-5 sm:p-7">
                                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 text-center sm:text-left">
                                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white dark:bg-gray-900 border border-sky-200 dark:border-sky-800 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br from-red-500 to-yellow-500 flex items-center justify-center text-white font-black text-lg sm:text-xl">{{ $initials ?: 'PF' }}</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-center gap-1 text-yellow-500 text-xl sm:text-2xl leading-none">
                                                @for($star = 1; $star <= 5; $star++)
                                                    <span class="{{ $star <= $rating ? '' : 'text-yellow-300 dark:text-yellow-200' }}">★</span>
                                                @endfor
                                            </div>
                                            <p class="mt-4 text-gray-700 dark:text-gray-200 text-sm sm:text-base leading-relaxed text-center">
                                                "{{ $testimonial['quote'] ?? '' }}"
                                            </p>
                                            <div class="mt-5 text-center">
                                                <p class="text-gray-700 dark:text-gray-200 font-semibold">{{ $name }}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $testimonial['zone'] ?? 'Durango' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-5 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <button type="button" class="testimonial-prev inline-flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white dark:bg-gray-900 border border-sky-100 dark:border-gray-800 shadow-md text-gray-700 dark:text-gray-200 hover:bg-sky-100 dark:hover:bg-gray-800 transition" aria-label="Testimonio anterior">‹</button>
                        <div class="testimonial-dots flex items-center justify-center flex-wrap gap-2"></div>
                        <button type="button" class="testimonial-next inline-flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white dark:bg-gray-900 border border-sky-100 dark:border-gray-800 shadow-md text-gray-700 dark:text-gray-200 hover:bg-sky-100 dark:hover:bg-gray-800 transition" aria-label="Siguiente testimonio">›</button>
                    </div>
                </div>
        </div>

        <div class="mt-8 flex flex-wrap justify-center gap-3 reveal-on-scroll opacity-100 translate-y-0 transition duration-700 ease-out">
            <span class="inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-900 border border-yellow-100 dark:border-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm">🚚 Entrega rápida</span>
            <span class="inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-900 border border-yellow-100 dark:border-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm">🥗 Ingredientes frescos</span>
            <span class="inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-900 border border-yellow-100 dark:border-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm">🤝 Atención cercana</span>
        </div>
    </div>
</section>
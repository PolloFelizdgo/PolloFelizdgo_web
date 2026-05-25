<section id="acerca" class="py-20 bg-white dark:bg-gray-900 transition-colors duration-300">
    @php
        $summary = $aboutSummary ?? [];
        $summaryParagraphs = is_array($summary['paragraphs'] ?? null) ? $summary['paragraphs'] : [];
    @endphp

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <img
                src="{{ $summary['image'] ?? 'https://images.unsplash.com/photo-1559847844-5315695dadae?auto=format&fit=crop&w=1200&q=80' }}"
                alt="Historia de Pollo Feliz"
                class="rounded-3xl shadow-2xl w-full object-cover"
                loading="lazy"
                decoding="async"
            >
        </div>

        <div>
            <p class="text-red-500 dark:text-yellow-400 font-semibold uppercase tracking-wider mb-2">{{ $summary['label'] ?? 'Acerca de nosotros' }}</p>
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $summary['title'] ?? 'Tradicion que se disfruta en familia' }}</h2>

            @foreach($summaryParagraphs as $index => $paragraph)
                <p class="{{ $index === 0 ? 'mt-6' : 'mt-4' }} text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                    {{ $paragraph }}
                </p>
            @endforeach

            @if(empty($summaryParagraphs))
                <p class="mt-6 text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                    Pollo Feliz nacio con la mision de ofrecer el mejor pollo asado con recetas tradicionales y un sabor unico para toda la familia.
                </p>
            @endif

            <div class="mt-8">
                <a
                    href="{{ route('about') }}"
                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-7 py-3 rounded-full shadow-lg transition duration-300"
                >
                    {{ $summary['button'] ?? 'Conocer mas' }}
                    <span>→</span>
                </a>
            </div>
        </div>
    </div>
</section>
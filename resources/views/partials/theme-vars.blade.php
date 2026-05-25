@php
    $themeDefaults = config('site_content.theme', []);
    $themeContent = app(\App\Services\Panel\PanelContentService::class)
        ->getPublishedPayload('theme.settings', $themeDefaults);

    $sanitizeHex = static function (mixed $value, string $fallback): string {
        $color = strtoupper(trim((string) $value));
        return preg_match('/^#[0-9A-F]{6}$/', $color) ? $color : $fallback;
    };

    $fontMap = [
        'Poppins' => "'Poppins', sans-serif",
        'Montserrat' => "'Montserrat', sans-serif",
        'Playfair Display' => "'Playfair Display', serif",
        'Merriweather' => "'Merriweather', serif",
        'Oswald' => "'Oswald', sans-serif",
        'Nunito Sans' => "'Nunito Sans', sans-serif",
        'Inter' => "'Inter', sans-serif",
        'Lato' => "'Lato', sans-serif",
        'Source Sans 3' => "'Source Sans 3', sans-serif",
        'Open Sans' => "'Open Sans', sans-serif",
    ];

    $primaryColor = $sanitizeHex($themeContent['primary_color'] ?? null, '#DC2626');
    $accentColor = $sanitizeHex($themeContent['accent_color'] ?? null, '#FACC15');
    $backgroundColor = $sanitizeHex($themeContent['background_color'] ?? $themeContent['surface_color'] ?? null, '#FFFAF5');
    $cardColor = $sanitizeHex($themeContent['card_color'] ?? null, '#FFF7EC');
    $textColor = $sanitizeHex($themeContent['text_color'] ?? null, '#1F2937');
    $mutedTextColor = $sanitizeHex($themeContent['muted_text_color'] ?? null, '#4B5563');

    $headingFontName = trim((string) ($themeContent['heading_font'] ?? 'Poppins'));
    $bodyFontName = trim((string) ($themeContent['body_font'] ?? 'Nunito Sans'));

    $headingFont = $fontMap[$headingFontName] ?? $fontMap['Poppins'];
    $bodyFont = $fontMap[$bodyFontName] ?? $fontMap['Nunito Sans'];

    $googleFonts = collect([$headingFontName, $bodyFontName])
        ->unique()
        ->filter(fn (string $font): bool => isset($fontMap[$font]))
        ->map(fn (string $font): string => str_replace(' ', '+', $font));
@endphp

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
@foreach($googleFonts as $googleFont)
    <link href="https://fonts.googleapis.com/css2?family={{ $googleFont }}:wght@400;600;700;800&display=swap" rel="stylesheet">
@endforeach

<style>
    :root {
        --pf-primary: {{ $primaryColor }};
        --pf-accent: {{ $accentColor }};
        --pf-background: {{ $backgroundColor }};
        --pf-surface: {{ $backgroundColor }};
        --pf-text: {{ $textColor }};
        --pf-card: {{ $cardColor }};
        --pf-border: color-mix(in srgb, var(--pf-primary) 20%, #d1d5db 80%);
        --pf-muted-text: {{ $mutedTextColor }};
        --pf-heading-font: {!! $headingFont !!};
        --pf-body-font: {!! $bodyFont !!};
    }

    body {
        font-family: var(--pf-body-font) !important;
        background-color: var(--pf-background) !important;
        color: var(--pf-text) !important;
    }

    h1, h2, h3, h4, h5, h6, .section-title {
        font-family: var(--pf-heading-font) !important;
    }

    .text-red-500,
    .text-red-600,
    .hover\:text-red-600:hover,
    .hover\:text-red-700:hover,
    .dark .dark\:text-red-500,
    .dark .text-red-600,
    .dark .dark\:text-red-600 {
        color: var(--pf-primary) !important;
    }

    .border-red-50,
    .border-red-100,
    .border-red-200,
    .border-red-600,
    .dark .border-red-600,
    .dark .dark\:border-red-600,
    .dark .dark\:border-red-800 {
        border-color: color-mix(in srgb, var(--pf-primary) 42%, #ffffff 58%) !important;
    }

    .bg-red-600,
    .bg-red-50,
    .bg-red-100,
    .hover\:bg-red-700:hover,
    .hover\:bg-red-600:hover,
    .dark .dark\:bg-red-600,
    .from-red-700,
    .via-red-600,
    .to-red-600,
    .to-red-700 {
        background-color: var(--pf-primary) !important;
    }

    .text-yellow-400,
    .text-yellow-300,
    .dark .text-yellow-400,
    .dark .dark\:text-yellow-300,
    .dark .dark\:text-yellow-400 {
        color: var(--pf-accent) !important;
    }

    .bg-yellow-400,
    .bg-yellow-100,
    .bg-yellow-50,
    .hover\:bg-yellow-500:hover,
    .dark .dark\:bg-yellow-400,
    .from-yellow-100,
    .to-yellow-500 {
        background-color: var(--pf-accent) !important;
    }

    .border-yellow-50,
    .border-yellow-100,
    .border-yellow-200,
    .border-yellow-300 {
        border-color: color-mix(in srgb, var(--pf-accent) 35%, #ffffff 65%) !important;
    }

    .text-gray-500,
    .text-gray-600,
    .dark .dark\:text-gray-400,
    .dark .dark\:text-gray-500,
    .dark .dark\:text-gray-600,
    .dark .dark\:text-gray-300 {
        color: var(--pf-muted-text) !important;
    }

    .text-gray-700,
    .text-gray-800,
    .text-gray-900,
    .dark .dark\:text-gray-200,
    .dark .text-gray-100,
    .dark .text-white {
        color: var(--pf-text) !important;
    }

    .border-gray-100,
    .border-gray-200,
    .border-gray-300,
    .border-gray-700,
    .dark .dark\:border-gray-700,
    .dark .dark\:border-gray-800 {
        border-color: var(--pf-border) !important;
    }

    .bg-\[\#fffaf5\],
    .bg-white,
    .bg-white\/90,
    .bg-white\/95,
    .dark .dark\:bg-gray-800,
    .dark .dark\:bg-gray-800\/90,
    .dark .dark\:bg-gray-900,
    .dark .dark\:bg-gray-900\/90,
    .dark .dark\:bg-gray-900\/95,
    .dark .dark\:bg-gray-950 {
        background-color: var(--pf-card) !important;
    }

    .focus\:ring-red-400:focus,
    .focus\:ring-red-500:focus {
        --tw-ring-color: color-mix(in srgb, var(--pf-primary) 55%, #ffffff 45%) !important;
    }

    .bg-gradient-to-r,
    .bg-gradient-to-br,
    .bg-gradient-to-b {
        --tw-gradient-from: color-mix(in srgb, var(--pf-primary) 88%, #ffffff 12%) var(--tw-gradient-from-position) !important;
        --tw-gradient-to: color-mix(in srgb, var(--pf-accent) 88%, #ffffff 12%) var(--tw-gradient-to-position) !important;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important;
    }

    p, li, span, label, small {
        font-family: var(--pf-body-font);
    }
</style>

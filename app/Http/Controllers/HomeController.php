<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Services\Panel\PanelContentService;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly PanelContentService $panelContent)
    {
    }

    public function index(): View
    {
        $this->panelContent->processDueScheduledPublishes();

        $homeContent = $this->panelContent->getPublishedPayload('home.content', config('site_content.home', []));
        $aboutContent = $this->panelContent->getPublishedPayload('about.content', config('site_content.about', []));

        $staticData = Cache::remember('home.static_data.v1', now()->addMinutes(60), function (): array {
            $homeContent = $this->panelContent->getPublishedPayload('home.content', config('site_content.home', []));

            // Datos de sucursales para seccion de ubicaciones en home.
            // Si necesitas actualizar mapas, edita la direccion y la URL embed en cada elemento.
            $branches = [
            [
                'name' => 'Suc.Jardines',
                'address' => 'Blvd. Francisco Villa 103, Jardines de Durango, 34200 Durango, Dgo.',
                'phone' => '(618) 129 3730',
                'hours' => '9:00 AM - 6:00 PM',
                'image' => asset('images/jardines.jpeg'),
                'map' => 'https://www.google.com/maps?q=Blvd.%20Francisco%20Villa%20103%2C%20Jardines%20de%20Durango%2C%2034200%20Durango%2C%20Dgo.&output=embed',
            ],
            [
                'name' => 'Suc.Fidel Velázquez',
                'address' => 'Av Fidel Velázquez Sánchez 114, Fidel Velázquez, 34229 Durango, Dgo.',
                'phone' => '(618) 814 1166',
                'hours' => '10:00 AM - 6:00 PM',
                'image' => asset('images/fidel.jpeg'),
                'map' => 'https://www.google.com/maps?q=Av%20Fidel%20Vel%C3%A1zquez%20S%C3%A1nchez%20114%2C%20Fidel%20Vel%C3%A1zquez%2C%2034229%20Durango%2C%20Dgo.&output=embed',
            ],
            [
                'name' => 'Suc. Pino Suarez',
                'address' => 'Prol. Pino Suárez 3922, Industrial Ladrillera, 34280 Durango, Dgo.',
                'phone' => '(618) 810 8948',
                'hours' => '9:00 AM - 6:00 PM',
                'image' => asset('images/pino.jpg'),
                'map' => 'https://www.google.com/maps?q=Prol.%20Pino%20Su%C3%A1rez%203922%2C%20Industrial%20Ladrillera%2C%2034280%20Durango%2C%20Dgo.&output=embed',
            ],
            [
                'name' => 'Suc. Lomas',
                'address' => 'Loma Dorada, 34100 Durango, Dgo.',
                'phone' => '(618) 130 3197',
                'hours' => '9:00 AM - 6:30 PM',
                'image' => asset('images/lomas.jpg'),
                'map' => 'https://www.google.com/maps?q=Loma%20Dorada%2C%2034100%20Durango%2C%20Dgo.&output=embed',
            ],
            [
                'name' => 'Suc.Domingo Arrieta',
                'address' => 'Blvd. Domingo Arrieta 506, Villa Alegre, 34139 Durango, Dgo.',
                'phone' => '(618) 111 2237',
                'hours' => '9:00 AM - 9:00 PM',
                'image' => asset('images/adomingo.jpg'),
                'map' => 'https://www.google.com/maps?q=Blvd.%20Domingo%20Arrieta%20506%2C%20Villa%20Alegre%2C%2034139%20Durango%2C%20Dgo.&output=embed',
            ],
            [
                'name' => 'Suc. Primo de Verdad',
                'address' => 'Primo de Verdad 1000, Valle del Sur, 34120 Durango, Dgo.',
                'phone' => '(618) 111 2238',
                'hours' => '9:30 AM - 6:30 PM',
                'image' => asset('images/primo.jpg'),
                'map' => 'https://www.google.com/maps?q=Primo%20de%20Verdad%201000%2C%20Valle%20del%20Sur%2C%2034120%20Durango%2C%20Dgo.&output=embed',
            ],
            [
                'name' => 'Suc.Sep',
                'address' => 'Av. División Durango 302, Gral Domingo Arrieta, 34180 Durango, Dgo.',
                'phone' => '(618) 111 2239',
                'hours' => '8:30 AM - 6:30 PM',
                'image' => asset('images/sep.jpg'),
                'map' => 'https://www.google.com/maps?q=Av.%20Divisi%C3%B3n%20Durango%20302%2C%20Gral%20Domingo%20Arrieta%2C%2034180%20Durango%2C%20Dgo.&output=embed',
            ],
            [
                'name' => 'Suc.Santiago Papasquiaro',
                'address' => 'Ramiro, Ramiro Rodríguez Palafox 1604 Int, Silvestres Revueltas, 34630 Santiago Papasquiaro, Dgo.',
                'phone' => '6748626339',
                'hours' => '10:00 AM - 6:00 PM',
                'image' => asset('images/santiago.jpg'),
                'map' => 'https://www.google.com/maps?q=Ramiro%20Rodr%C3%ADguez%20Palafox%201604%2C%20Silvestres%20Revueltas%2C%2034630%20Santiago%20Papasquiaro%2C%20Dgo.&output=embed',
            ],
            ];

            // Promociones, hero y testimonios centralizados en config/site_content.php.
            $promotions = $homeContent['promotions'] ?? [];

            $heroSlides = array_map(function (array $slide): array {
                return [
                    'image' => $this->resolveImagePath((string) ($slide['image'] ?? ''), 'images/portada.jpg'),
                    'title' => (string) ($slide['title'] ?? ''),
                    'text' => (string) ($slide['text'] ?? ''),
                ];
            }, $homeContent['hero_slides'] ?? []);

            $testimonials = $homeContent['testimonials'] ?? [];

            return [
                'branches' => $branches,
                'promotions' => $promotions,
                'heroSlides' => $heroSlides,
                'testimonials' => $testimonials,
            ];
        });

        $branches = $staticData['branches'];
        $promotions = $staticData['promotions'];
        $heroSlides = $staticData['heroSlides'];
        $testimonials = $staticData['testimonials'];

        $aboutSummaryConfig = $aboutContent['summary'] ?? config('site_content.about.summary', []);
        $aboutSummary = [
            'label' => (string) ($aboutSummaryConfig['label'] ?? 'Acerca de nosotros'),
            'title' => (string) ($aboutSummaryConfig['title'] ?? 'Tradicion que se disfruta en familia'),
            'paragraphs' => (array) ($aboutSummaryConfig['paragraphs'] ?? []),
            'button' => (string) ($aboutSummaryConfig['button'] ?? 'Conocer mas'),
            'image' => $this->resolveImagePath((string) ($aboutSummaryConfig['image'] ?? ''), 'images/portada.jpg'),
            'fallback_image' => (string) ($aboutSummaryConfig['fallback_image'] ?? ''),
        ];

        // Catalogo completo y version resumida para cards destacadas en home.
        $menuItems = $this->getMenuItems();
        $featuredMenuItems = array_slice($menuItems, 0, 6);

        $latestVacancies = Vacancy::query()
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('home', compact('branches', 'featuredMenuItems', 'promotions', 'heroSlides', 'testimonials', 'aboutSummary', 'latestVacancies'));
    }

    public function menu(): View
    {
        $this->panelContent->processDueScheduledPublishes();

        // Vista de menu completo con todo el catalogo.
        $menuItems = $this->getMenuItems();

        return view('menu', compact('menuItems'));
    }

    public function about(): View
    {
        $this->panelContent->processDueScheduledPublishes();

        $aboutContent = $this->panelContent->getPublishedPayload('about.content', config('site_content.about', []));

        [$aboutImages, $timeline, $values] = Cache::remember('about.static_data.v1', now()->addMinutes(60), function (): array {
            $aboutContent = $this->panelContent->getPublishedPayload('about.content', config('site_content.about', []));

            // Edita esta seccion si quieres cambiar el contenido de la pagina /acerca.
            // Cada imagen apunta a un archivo dentro de public/images.
            $aboutImages = array_map(fn (string $path): string => $this->resolveImagePath($path, 'images/portada.jpg'), $aboutContent['images'] ?? []);

            // Linea de tiempo corporativa.
            // Edita year, title, description e image para actualizar los hitos.
            $timeline = array_map(function (array $item): array {
                $item['image'] = $this->resolveImagePath((string) ($item['image'] ?? ''), 'images/portada.jpg');

                return $item;
            }, $aboutContent['timeline'] ?? []);

            // Tarjetas de valores institucionales.
            // Cambia title y description para reflejar otro mensaje de marca.
            $values = $aboutContent['values'] ?? [];

            return [$aboutImages, $timeline, $values];
        });

        return view('about', compact('aboutImages', 'timeline', 'values'));
    }

    private function getMenuItems(): array
    {
        return Cache::remember('menu.items.v1', now()->addMinutes(60), function (): array {
            $defaultItems = $this->defaultMenuItems();
            $menuContent = $this->panelContent->getPublishedPayload('menu.items', ['items' => []]);
            $overrides = is_array($menuContent['items'] ?? null) ? $menuContent['items'] : [];

            return $this->applyMenuEditorOverrides($defaultItems, $overrides);
        });
    }

    private function defaultMenuItems(): array
    {
        // Fuente central de productos para home y pagina de menu.
        // category se usa en filtros de /menu. Valores: pollos, combos, paquetes, complementos, bebidas.
        return [
            [
                'name' => 'Pollo Asado Entero',
                'description' => 'Pollo entero sazonado con receta tradicional.',
                'price' => '$199',
                'image' => $this->menuImage('platillo1.jpeg'),
                'category' => 'pollos',
            ],
            [
                'name' => 'Medio Pollo',
                'description' => 'Ideal para compartir con tortillas y salsa.',
                'price' => '$109',
                'image' => $this->menuImage('platillo2.jpeg'),
                'category' => 'pollos',
            ],
            [
                'name' => 'Combo Familiar',
                'description' => 'Pollo, tortillas, salsa, papas y refresco.',
                'price' => '$289',
                'image' => $this->menuImage('combo-familiar.jpg'),
                'category' => 'combos',
            ],
            [
                'name' => 'Complementos',
                'description' => 'Papas, ensalada, arroz y frijoles.',
                'price' => 'Desde $45',
                'image' => $this->menuImage('complementos.jpg'),
                'category' => 'complementos',
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Refrescos y aguas frescas para acompañar.',
                'price' => 'Desde $25',
                'image' => $this->menuImage('bebidas.jpg'),
                'category' => 'bebidas',
            ],
            [
                'name' => 'Paquete Ejecutivo',
                'description' => 'Ideal para una comida rápida y completa.',
                'price' => '$149',
                'image' => $this->menuImage('paquete-ejecutivo.jpg'),
                'category' => 'paquetes',
            ],
            [
                'name' => 'Combo Infantil',
                'description' => 'Porción ideal para los pequeños con bebida incluida.',
                'price' => '$99',
                'image' => $this->menuImage('combo-infantil.jpg'),
                'category' => 'combos',
            ],
            [
                'name' => 'Papas Especiales',
                'description' => 'Papas sazonadas crujientes y deliciosas.',
                'price' => '$59',
                'image' => $this->menuImage('papas-especiales.jpg'),
                'category' => 'complementos',
            ],
            [
                'name' => 'Complementos',
                'description' => 'Papas, ensalada, arroz y frijoles.',
                'price' => 'Desde $45',
                'image' => $this->menuImage('complementos.jpg'),
                'category' => 'complementos',
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Refrescos y aguas frescas para acompañar.',
                'price' => 'Desde $25',
                'image' => $this->menuImage('bebidas.jpg'),
                'category' => 'bebidas',
            ],
            [
                'name' => 'Paquete Ejecutivo',
                'description' => 'Ideal para una comida rápida y completa.',
                'price' => '$149',
                'image' => $this->menuImage('paquete-ejecutivo.jpg'),
                'category' => 'paquetes',
            ],
            [
                'name' => 'Combo Infantil',
                'description' => 'Porción ideal para los pequeños con bebida incluida.',
                'price' => '$99',
                'image' => $this->menuImage('combo-infantil.jpg'),
                'category' => 'combos',
            ],
            [
                'name' => 'Papas Especiales',
                'description' => 'Papas sazonadas crujientes y deliciosas.',
                'price' => '$59',
                'image' => $this->menuImage('papas-especiales.jpg'),
                'category' => 'complementos',
            ],
            [
                'name' => 'Complementos',
                'description' => 'Papas, ensalada, arroz y frijoles.',
                'price' => 'Desde $45',
                'image' => $this->menuImage('complementos.jpg'),
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Refrescos y aguas frescas para acompañar.',
                'price' => 'Desde $25',
                'image' => $this->menuImage('bebidas.jpg'),
            ],
            [
                'name' => 'Paquete Ejecutivo',
                'description' => 'Ideal para una comida rápida y completa.',
                'price' => '$149',
                'image' => $this->menuImage('paquete-ejecutivo.jpg'),
            ],
            [
                'name' => 'Combo Infantil',
                'description' => 'Porción ideal para los pequeños con bebida incluida.',
                'price' => '$99',
                'image' => $this->menuImage('combo-infantil.jpg'),
            ],
            [
                'name' => 'Papas Especiales',
                'description' => 'Papas sazonadas crujientes y deliciosas.',
                'price' => '$59',
                'image' => $this->menuImage('papas-especiales.jpg'),
            ],
            ];
    }

    private function applyMenuEditorOverrides(array $defaultItems, array $overrides): array
    {
        foreach ($defaultItems as $index => $item) {
            $override = $overrides[$index] ?? null;

            if (! is_array($override)) {
                continue;
            }

            $name = trim((string) ($override['name'] ?? ''));
            $price = trim((string) ($override['price'] ?? ''));

            if ($name !== '') {
                $defaultItems[$index]['name'] = $name;
            }

            if ($price !== '') {
                $defaultItems[$index]['price'] = $price;
            }
        }

        return $defaultItems;
    }

    private function menuImage(string $filename): string
    {
        $safeFilename = trim($filename);
        $relativePath = 'images/menu/'.$safeFilename;

        if (file_exists(public_path($relativePath))) {
            return asset($relativePath);
        }

        return asset('images/menu/platillo1.jpeg');
    }

    private function resolveImagePath(string $path, string $fallback): string
    {
        $trimmedPath = trim($path);

        if ($trimmedPath !== '' && preg_match('/^https?:\/\//i', $trimmedPath)) {
            return $trimmedPath;
        }

        $normalizedPath = ltrim($trimmedPath, '/');

        if ($normalizedPath !== '' && file_exists(public_path($normalizedPath))) {
            return asset($normalizedPath);
        }

        return asset($fallback);
    }
}
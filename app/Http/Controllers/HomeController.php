<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Datos de sucursales para seccion de ubicaciones en home.
        $branches = [
            [
                'name' => 'Suc.Jardines',
                'address' => 'Blvd. Francisco Villa 103, Jardines de Durango, 34200 Durango, Dgo.',
                'phone' => '(618) 129 3730',
                'hours' => '9:00 AM - 6:00 PM',
                'image' => asset('images/jardines.jpeg'),
                'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.7851234567890!2d-104.65234567890!3d24.026789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bb7b87724a77f%3A0x5b4f0c0e90e9cf25!2sPollo%20Feliz%20Jardines!5e0!3m2!1ses!2smx!4v1234567890',
            ],
            [
                'name' => 'Suc.Fidel Velázquez',
                'address' => 'Av Fidel Velázquez Sánchez 114, Fidel Velázquez, 34229 Durango, Dgo.',
                'phone' => '(618) 814 1166',
                'hours' => '10:00 AM - 6:00 PM',
                'image' => asset('images/fidel.jpeg'),
                'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3643.108702096669!2d-104.6035692!3d24.0624763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bb6fbaa9e74af%3A0x1d25abde1bd0cef6!2sPollo%20Feliz!5e0!3m2!1sen!2smx!4v1779463362021!5m2!1sen!2smx',
            ],
            [
                'name' => 'Suc. Pino Suarez',
                'address' => 'Prol. Pino Suárez 3922, Industrial Ladrillera, 34280 Durango, Dgo.',
                'phone' => '(618) 810 8948',
                'hours' => '9:00 AM - 6:00 PM',
                'image' => asset('images/pino.jpg'),
                'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.078188352233!2d-104.6237019!3d24.028307800000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bb79800293c6b%3A0xaa07afcdb79e3758!2sPollo%20Feliz!5e0!3m2!1sen!2smx!4v1779464019606!5m2!1sen!2smx',
            ],
            [
                'name' => 'Suc. Lomas',
                'address' => 'Loma Dorada, 34100 Durango, Dgo.',
                'phone' => '(618) 130 3197',
                'hours' => '9:00 AM - 6:30 PM',
                'image' => asset('images/lomas.jpg'),
                'map' => 'https://www.google.com/maps/embed?pb=!3m2!1sen!2smx!4v1779466189040!5m2!1sen!2smx!6m8!1m7!1speL5yLTxD23Rm3PaYSjhNw!2m2!1d24.01472528595662!2d-104.6904498944229!3f198.11976574334292!4f-0.12387153436095844!5f0.7820865974627469',
            ],
            [
                'name' => 'Suc.Domingo Arrieta',
                'address' => 'Blvd. Domingo Arrieta 506, Villa Alegre, 34139 Durango, Dgo.',
                'phone' => '(618) 111 2237',
                'hours' => '9:00 AM - 9:00 PM',
                'image' => asset('images/adomingo.jpg'),
                'map' => 'https://www.google.com/maps/embed?pb=!3m2!1sen!2smx!4v1779466627263!5m2!1sen!2smx!6m8!1m7!1smqbgrWzA-TnemUxxat2ebg!2m2!1d24.01141894183079!2d-104.6628684411756!3f271.03501446378095!4f-3.971255865307228!5f0.7820865974627469',
            ],
            [
                'name' => 'Suc. Primo de Verdad',
                'address' => 'Primo de Verdad 1000, Valle del Sur, 34120 Durango, Dgo.',
                'phone' => '(618) 111 2238',
                'hours' => '9:30 AM - 6:30 PM',
                'image' => asset('images/primo.jpg'),
                'map' => 'https://www.google.com/maps/embed?pb=!3m2!1sen!2smx!4v1779467009783!5m2!1sen!2smx!6m8!1m7!1szOhoqhseNtP22xdto_4k1w!2m2!1d24.00906026195925!2d-104.6793672480862!3f202.369393333996!4f-0.9696255643325316!5f0.4000000000000002',
            ],
            [
                'name' => 'Suc.Sep',
                'address' => 'Av. División Durango 302, Gral Domingo Arrieta, 34180 Durango, Dgo.',
                'phone' => '(618) 111 2239',
                'hours' => '8:30 AM - 6:30 PM',
                'image' => asset('images/sep.jpg'),
                'map' => 'https://www.google.com/maps/embed?pb=!3m2!1sen!2smx!4v1779467615446!5m2!1sen!2smx!6m8!1m7!1shP5A2au84F716QXQxsvciA!2m2!1d23.99586969232776!2d-104.6651152540984!3f207.52790312749258!4f2.4213789199875038!5f0.7820865974627469',
            ],
            [
                'name' => 'Suc.Santiago Papasquiaro',
                'address' => 'Ramiro, Ramiro Rodríguez Palafox 1604 Int, Silvestres Revueltas, 34630 Santiago Papasquiaro, Dgo.',
                'phone' => '6748626339',
                'hours' => '10:00 AM - 6:00 PM',
                'image' => asset('images/santiago.jpg'),
                'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3614.647166732933!2d-105.41329050393314!3d25.046045336318727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8697680f500ac5c5%3A0x38aff5033e5d8a70!2sEl%20Pollo%20Feliz!5e0!3m2!1sen!2smx!4v1779467850663!5m2!1sen!2smx',
            ],
        ];

        // Catalogo completo y version resumida para cards destacadas en home.
        $menuItems = $this->getMenuItems();
        $featuredMenuItems = array_slice($menuItems, 0, 6);

        // Promociones destacadas de la landing.
        $promotions = [
            [
                'title' => 'Lunes de oficina',
                'description' => 'Combo individual con bebida a precio especial para iniciar la semana.',
                'price' => '$129',
            ],
            [
                'title' => 'Promoción Miércoles',
                'description' => '2x1 en complementos seleccionados: papas, ensalada o arroz.',
                'price' => '2x1',
            ],
            [
                'title' => 'Jueves estudiantil',
                'description' => 'Descuento especial en combo individual mostrando credencial vigente.',
                'price' => '10% OFF',
            ],
            [
                'title' => 'Viernes de combo familiar',
                'description' => 'Pollo, complementos y refresco grande en paquete con precio cerrado.',
                'price' => '$299',
            ],
            [
                'title' => 'Sábado de sucursal',
                'description' => 'Promoción especial exclusiva por ubicación, válida solo en sucursal participante.',
                'price' => 'Desde $99',
            ],
        ];

        // Slides para hero principal (imagen, titulo y descripcion).
        $heroSlides = [
            [
                'image' => asset('images/portada.jpg'),
                'title' => 'El sabor que une a la familia',
                'text' => 'Disfruta del auténtico sabor de Pollo Feliz con la mejor calidad, recetas tradicionales y una experiencia deliciosa para toda la familia.',
            ],
            [
                'image' => asset('images/fidel.jpeg'),
                'title' => 'Tradición en cada bocado',
                'text' => 'Recetas únicas, pollo asado de calidad y el mejor servicio para compartir grandes momentos.',
            ],
            [
                'image' => asset('images/fidel.jpeg'),
                'title' => 'Promociones y sabor todos los días',
                'text' => 'Encuentra tus sucursales favoritas y disfruta promociones especiales para toda la familia.',
            ],
        ];

        $latestVacancies = Vacancy::query()
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('home', compact('branches', 'featuredMenuItems', 'promotions', 'heroSlides', 'latestVacancies'));
    }

    public function menu(): View
    {
        // Vista de menu completo con todo el catalogo.
        $menuItems = $this->getMenuItems();

        return view('menu', compact('menuItems'));
    }

    public function about(): View
    {
        // Vista dedicada a la historia, vision y mision de la empresa.
        // Puedes reemplazar estas rutas por imagenes corporativas nuevas.
        $aboutImages = [
            'hero' => asset('images/portada.jpg'),
            'history' => asset('images/jardines.jpeg'),
            'mission' => asset('images/fidel.jpeg'),
            'vision' => asset('images/santiago.jpg'),
        ];

        // Linea de tiempo corporativa: puedes cambiar anio, titulo y descripcion.
        $timeline = [
            [
                'year' => '2004',
                'title' => 'Inicio de operaciones',
                'description' => 'Nace Pollo Feliz en Durango con una propuesta centrada en sabor tradicional y atencion cercana.',
                'image' => asset('images/jardines.jpeg'),
            ],
            [
                'year' => '2010',
                'title' => 'Expansion regional',
                'description' => 'Se consolida la apertura de nuevas sucursales para atender mas zonas de la ciudad.',
                'image' => asset('images/fidel.jpeg'),
            ],
            [
                'year' => '2018',
                'title' => 'Estandarizacion operativa',
                'description' => 'Se fortalecen procesos de calidad, servicio y capacitacion para todo el equipo.',
                'image' => asset('images/sep.jpg'),
            ],
            [
                'year' => '2026',
                'title' => 'Innovacion continua',
                'description' => 'Se integran mejoras en experiencia digital, comunicacion de marca y servicio al cliente.',
                'image' => asset('images/portada.jpg'),
            ],
        ];

        // Valores institucionales: icon puede ser emoji o texto corto.
        $values = [
            [
                'icon' => '🤝',
                'title' => 'Servicio cercano',
                'description' => 'Atendemos a cada cliente con respeto, rapidez y calidez.',
            ],
            [
                'icon' => '⭐',
                'title' => 'Calidad constante',
                'description' => 'Cuidamos ingredientes, preparacion y presentacion en cada pedido.',
            ],
            [
                'icon' => '🔥',
                'title' => 'Pasion por el sabor',
                'description' => 'Mantenemos el sazón tradicional que distingue a la marca.',
            ],
            [
                'icon' => '📈',
                'title' => 'Mejora continua',
                'description' => 'Evolucionamos procesos y experiencia para superar expectativas.',
            ],
        ];

        return view('about', compact('aboutImages', 'timeline', 'values'));
    }

    private function getMenuItems(): array
    {
        // Fuente central de productos para home y pagina de menu.
        return [
            [
                'name' => 'Pollo Asado Entero',
                'description' => 'Pollo entero sazonado con receta tradicional.',
                'price' => '$199',
                'image' => $this->menuImage('platillo1.jpeg'),
            ],
            [
                'name' => 'Medio Pollo',
                'description' => 'Ideal para compartir con tortillas y salsa.',
                'price' => '$109',
                'image' => $this->menuImage('platillo2.jpeg'),
            ],
            [
                'name' => 'Combo Familiar',
                'description' => 'Pollo, tortillas, salsa, papas y refresco.',
                'price' => '$289',
                'image' => $this->menuImage('combo-familiar.jpg'),
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

    private function menuImage(string $filename): string
    {
        $safeFilename = trim($filename);
        $relativePath = 'images/menu/'.$safeFilename;

        if (file_exists(public_path($relativePath))) {
            return asset($relativePath);
        }

        return asset('images/menu/platillo1.jpeg');
    }
}
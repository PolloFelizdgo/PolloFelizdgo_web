<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
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

        $menuItems = $this->getMenuItems();
        $featuredMenuItems = array_slice($menuItems, 0, 6);

        $promotions = [
            [
                'title' => 'Martes Familiar',
                'description' => '2 pollos enteros con complemento especial para compartir.',
                'price' => '$349',
            ],
            [
                'title' => 'Combo de la Casa',
                'description' => '1 pollo + papas grandes + refresco familiar.',
                'price' => '$249',
            ],
            [
                'title' => 'Promo Fin de Semana',
                'description' => 'Descuento especial en combos familiares seleccionados.',
                'price' => '15% OFF',
            ],
        ];

        $heroSlides = [
            [
                'image' => asset('images/portada.jpg'),
                'title' => 'El sabor que une a la familia',
                'text' => 'Disfruta del auténtico sabor de Pollo Feliz con la mejor calidad, recetas tradicionales y una experiencia deliciosa para toda la familia.',
            ],
            [
                'image' => asset('images/jardines.jpeg'),
                'title' => 'Tradición en cada bocado',
                'text' => 'Recetas únicas, pollo asado de calidad y el mejor servicio para compartir grandes momentos.',
            ],
            [
                'image' => asset('images/fidel.jpeg'),
                'title' => 'Promociones y sabor todos los días',
                'text' => 'Encuentra tus sucursales favoritas y disfruta promociones especiales para toda la familia.',
            ],
        ];

        return view('home', compact('branches', 'featuredMenuItems', 'promotions', 'heroSlides'));
    }

    public function menu(): View
    {
        $menuItems = $this->getMenuItems();

        return view('menu', compact('menuItems'));
    }

    private function getMenuItems(): array
    {
        return [
            [
                'name' => 'Pollo Asado Entero',
                'description' => 'Pollo entero sazonado con receta tradicional.',
                'price' => '$199',
                'image' => asset('images/menu/pollo-entero.jpg'),
            ],
            [
                'name' => 'Medio Pollo',
                'description' => 'Ideal para compartir con tortillas y salsa.',
                'price' => '$109',
                'image' => asset('images/menu/medio-pollo.jpg'),
            ],
            [
                'name' => 'Combo Familiar',
                'description' => 'Pollo, tortillas, salsa, papas y refresco.',
                'price' => '$289',
                'image' => asset('images/menu/combo-familiar.jpg'),
            ],
            [
                'name' => 'Complementos',
                'description' => 'Papas, ensalada, arroz y frijoles.',
                'price' => 'Desde $45',
                'image' => asset('images/menu/complementos.jpg'),
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Refrescos y aguas frescas para acompañar.',
                'price' => 'Desde $25',
                'image' => asset('images/menu/bebidas.jpg'),
            ],
            [
                'name' => 'Paquete Ejecutivo',
                'description' => 'Ideal para una comida rápida y completa.',
                'price' => '$149',
                'image' => asset('images/menu/paquete-ejecutivo.jpg'),
            ],
            [
                'name' => 'Combo Infantil',
                'description' => 'Porción ideal para los pequeños con bebida incluida.',
                'price' => '$99',
                'image' => asset('images/menu/combo-infantil.jpg'),
            ],
            [
                'name' => 'Papas Especiales',
                'description' => 'Papas sazonadas crujientes y deliciosas.',
                'price' => '$59',
                'image' => asset('images/menu/papas-especiales.jpg'),
            ],
            [
                'name' => 'Complementos',
                'description' => 'Papas, ensalada, arroz y frijoles.',
                'price' => 'Desde $45',
                'image' => asset('images/menu/complementos.jpg'),
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Refrescos y aguas frescas para acompañar.',
                'price' => 'Desde $25',
                'image' => asset('images/menu/bebidas.jpg'),
            ],
            [
                'name' => 'Paquete Ejecutivo',
                'description' => 'Ideal para una comida rápida y completa.',
                'price' => '$149',
                'image' => asset('images/menu/paquete-ejecutivo.jpg'),
            ],
            [
                'name' => 'Combo Infantil',
                'description' => 'Porción ideal para los pequeños con bebida incluida.',
                'price' => '$99',
                'image' => asset('images/menu/combo-infantil.jpg'),
            ],
            [
                'name' => 'Papas Especiales',
                'description' => 'Papas sazonadas crujientes y deliciosas.',
                'price' => '$59',
                'image' => asset('images/menu/papas-especiales.jpg'),
            ],
            [
                'name' => 'Complementos',
                'description' => 'Papas, ensalada, arroz y frijoles.',
                'price' => 'Desde $45',
                'image' => asset('images/menu/complementos.jpg'),
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Refrescos y aguas frescas para acompañar.',
                'price' => 'Desde $25',
                'image' => asset('images/menu/bebidas.jpg'),
            ],
            [
                'name' => 'Paquete Ejecutivo',
                'description' => 'Ideal para una comida rápida y completa.',
                'price' => '$149',
                'image' => asset('images/menu/paquete-ejecutivo.jpg'),
            ],
            [
                'name' => 'Combo Infantil',
                'description' => 'Porción ideal para los pequeños con bebida incluida.',
                'price' => '$99',
                'image' => asset('images/menu/combo-infantil.jpg'),
            ],
            [
                'name' => 'Papas Especiales',
                'description' => 'Papas sazonadas crujientes y deliciosas.',
                'price' => '$59',
                'image' => asset('images/menu/papas-especiales.jpg'),
            ],
        ];
    }
}
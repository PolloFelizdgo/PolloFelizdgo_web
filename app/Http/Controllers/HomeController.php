<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $branches = [
            [
                'name' => 'Centro',
                'address' => 'Av. 20 de Noviembre 123, Durango, Dgo.',
                'phone' => '(618) 111 2233',
                'hours' => '9:00 AM - 9:00 PM',
                'image' => 'https://images.unsplash.com/photo-1513639776629-7b61b0ac49cb?auto=format&fit=crop&w=900&q=80',
                'map' => 'https://www.google.com/maps?q=Durango+Centro&output=embed',
            ],
            [
                'name' => 'Paseo Durango',
                'address' => 'Blvd. Felipe Pescador 1401, Durango, Dgo.',
                'phone' => '(618) 111 2234',
                'hours' => '10:00 AM - 10:00 PM',
                'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=900&q=80',
                'map' => 'https://www.google.com/maps?q=Paseo+Durango&output=embed',
            ],
            [
                'name' => 'Francisco Villa',
                'address' => 'Blvd. Francisco Villa 450, Durango, Dgo.',
                'phone' => '(618) 111 2235',
                'hours' => '9:00 AM - 9:00 PM',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
                'map' => 'https://www.google.com/maps?q=Francisco+Villa+Durango&output=embed',
            ],
            [
                'name' => 'Jardines',
                'address' => 'Calle Jardines 88, Durango, Dgo.',
                'phone' => '(618) 111 2236',
                'hours' => '9:00 AM - 8:30 PM',
                'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=900&q=80',
                'map' => 'https://www.google.com/maps?q=Jardines+Durango&output=embed',
            ],
            [
                'name' => 'Domingo Arrieta',
                'address' => 'Av. Domingo Arrieta 550, Durango, Dgo.',
                'phone' => '(618) 111 2237',
                'hours' => '9:00 AM - 9:00 PM',
                'image' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?auto=format&fit=crop&w=900&q=80',
                'map' => 'https://www.google.com/maps?q=Domingo+Arrieta+Durango&output=embed',
            ],
            [
                'name' => 'Guadalupe Victoria',
                'address' => 'Av. Guadalupe Victoria 310, Durango, Dgo.',
                'phone' => '(618) 111 2238',
                'hours' => '9:30 AM - 9:30 PM',
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=900&q=80',
                'map' => 'https://www.google.com/maps?q=Guadalupe+Victoria+Durango&output=embed',
            ],
            [
                'name' => 'El Refugio',
                'address' => 'Col. El Refugio 75, Durango, Dgo.',
                'phone' => '(618) 111 2239',
                'hours' => '8:30 AM - 8:30 PM',
                'image' => 'https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?auto=format&fit=crop&w=900&q=80',
                'map' => 'https://www.google.com/maps?q=El+Refugio+Durango&output=embed',
            ],
            [
                'name' => 'Plaza Norte',
                'address' => 'Plaza Norte Local 12, Durango, Dgo.',
                'phone' => '(618) 111 2240',
                'hours' => '10:00 AM - 10:00 PM',
                'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=900&q=80',
                'map' => 'https://www.google.com/maps?q=Plaza+Norte+Durango&output=embed',
            ],
        ];

        $menuItems = [
            [
                'name' => 'Pollo Asado Entero',
                'description' => 'Pollo entero sazonado con receta tradicional.',
                'price' => '$199',
            ],
            [
                'name' => 'Medio Pollo',
                'description' => 'Ideal para compartir con tortillas y salsa.',
                'price' => '$109',
            ],
            [
                'name' => 'Combo Familiar',
                'description' => 'Pollo, tortillas, salsa, papas y refresco.',
                'price' => '$289',
            ],
            [
                'name' => 'Complementos',
                'description' => 'Papas, ensalada, arroz y frijoles.',
                'price' => 'Desde $45',
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Refrescos y aguas frescas para acompañar.',
                'price' => 'Desde $25',
            ],
            [
                'name' => 'Paquete Ejecutivo',
                'description' => 'Ideal para una comida rápida y completa.',
                'price' => '$149',
            ],
        ];

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

        return view('home', compact('branches', 'menuItems', 'promotions'));
    }
}

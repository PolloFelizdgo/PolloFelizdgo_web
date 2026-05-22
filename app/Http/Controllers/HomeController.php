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
                'address' => 'Blvd. Francisco Villa 103, Jardines de Durango,34200 Durango, Dgo.',
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
                'address' => 'Loma Dorada, 34100 Durango, Durango, Dgo.',
                'phone' => '(618) 130 3197',
                'hours' => '9:00 AM - 6:30 PM',
                'image' => asset('images/lomas.jpg'),
                'map' => 'https://www.google.com/maps/embed?pb=!3m2!1sen!2smx!4v1779466189040!5m2!1sen!2smx!6m8!1m7!1speL5yLTxD23Rm3PaYSjhNw!2m2!1d24.01472528595662!2d-104.6904498944229!3f198.11976574334292!4f-0.12387153436095844!5f0.7820865974627469',

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

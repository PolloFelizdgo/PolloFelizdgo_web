<?php

return [
    'theme' => [
        'primary_color' => '#dc2626',
        'accent_color' => '#facc15',
        'background_color' => '#fffaf5',
        'card_color' => '#fff7ec',
        'surface_color' => '#fffaf5',
        'text_color' => '#1f2937',
        'muted_text_color' => '#4b5563',
        'heading_font' => 'Poppins',
        'body_font' => 'Nunito Sans',
    ],

    'home' => [
        'hero_slides' => [
            [
                'image' => 'images/portada.jpg',
                'title' => 'El sabor que une a la familia',
                'text' => 'Disfruta del autentico sabor de Pollo Feliz con calidad consistente y una experiencia deliciosa para toda la familia.',
            ],
            [
                'image' => 'images/fidel.jpeg',
                'title' => 'Tradicion en cada bocado',
                'text' => 'Recetas de casa, pollo asado de calidad y servicio cercano para compartir grandes momentos.',
            ],
            [
                'image' => 'images/fidel.jpeg',
                'title' => 'Promociones todos los dias',
                'text' => 'Encuentra tu sucursal favorita y aprovecha promociones pensadas para cada ocasion.',
            ],
        ],
        'promotions' => [
            [
                'title' => 'Lunes de oficina',
                'description' => 'Combo individual con bebida a precio especial para iniciar la semana.',
                'price' => '$129',
            ],
            [
                'title' => 'Miercoles de complementos',
                'description' => '2x1 en complementos seleccionados: papas, ensalada o arroz.',
                'price' => '2x1',
            ],
            [
                'title' => 'Jueves estudiantil',
                'description' => 'Descuento especial en combo individual mostrando credencial vigente.',
                'price' => '10% OFF',
            ],
            [
                'title' => 'Viernes familiar',
                'description' => 'Pollo, complementos y refresco grande en paquete con precio cerrado.',
                'price' => '$299',
            ],
            [
                'title' => 'Sabado por sucursal',
                'description' => 'Promocion exclusiva por ubicacion, valida solo en sucursal participante.',
                'price' => 'Desde $99',
            ],
        ],
        'testimonials' => [
            [
                'name' => 'Mariana G.',
                'zone' => 'Zona Jardines',
                'quote' => 'Siempre pedimos el combo familiar del viernes. Llega caliente y bien servido.',
                'rating' => 5,
            ],
            [
                'name' => 'Carlos R.',
                'zone' => 'Zona Fidel Velazquez',
                'quote' => 'Resuelven rapido en hora de comida y la atencion siempre es amable.',
                'rating' => 5,
            ],
            [
                'name' => 'Patricia L.',
                'zone' => 'Zona Domingo Arrieta',
                'quote' => 'Buen sabor, porciones completas y excelente opcion para reuniones familiares.',
                'rating' => 4,
            ],
            [
                'name' => 'Jorge A.',
                'zone' => 'Zona Lomas',
                'quote' => 'Pedido confiable para llevar, llega completo y en buen tiempo.',
                'rating' => 4,
            ],
        ],
    ],

    'about' => [
        'summary' => [
            'label' => 'Acerca de nosotros',
            'title' => 'Tradicion que se disfruta en familia',
            'paragraphs' => [
                'Pollo Feliz nacio con la mision de ofrecer pollo asado con receta tradicional, calidad y servicio consistente.',
                'Nuestro compromiso es crear experiencias memorables en cada visita, con calidez, sabor y atencion profesional.',
            ],
            'button' => 'Conocer mas',
            'image' => 'images/about/about-home.jpg',
            'fallback_image' => 'https://images.unsplash.com/photo-1559847844-5315695dadae?auto=format&fit=crop&w=1200&q=80',
        ],
        'images' => [
            'hero' => 'images/portada.jpg',
            'history' => 'images/jardines.jpeg',
            'mission' => 'images/fidel.jpeg',
            'vision' => 'images/santiago.jpg',
        ],
        'timeline' => [
            [
                'year' => '2004',
                'title' => 'Inicio de operaciones',
                'description' => 'Nace Pollo Feliz en Durango con una propuesta centrada en sabor tradicional y atencion cercana.',
                'image' => 'images/jardines.jpeg',
            ],
            [
                'year' => '2010',
                'title' => 'Expansion regional',
                'description' => 'Se consolida la apertura de nuevas sucursales para atender mas zonas de la ciudad.',
                'image' => 'images/fidel.jpeg',
            ],
            [
                'year' => '2018',
                'title' => 'Estandarizacion operativa',
                'description' => 'Se fortalecen procesos de calidad, servicio y capacitacion para todo el equipo.',
                'image' => 'images/sep.jpg',
            ],
            [
                'year' => '2026',
                'title' => 'Innovacion continua',
                'description' => 'Impulsamos mejoras en experiencia digital, comunicacion de marca y servicio al cliente.',
                'image' => 'images/portada.jpg',
            ],
        ],
        'values' => [
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
                'description' => 'Mantenemos el sazon tradicional que distingue a la marca.',
            ],
            [
                'icon' => '📈',
                'title' => 'Mejora continua',
                'description' => 'Evolucionamos procesos y experiencia para superar expectativas.',
            ],
        ],
    ],

    'footer' => [
        'cta_label' => 'Atencion corporativa',
        'cta_title' => 'Hablemos de tu sucursal o facturacion',
        'brand_description' => 'Sabor, tradicion y calidad para toda la familia. Comprometidos con un servicio cercano en cada sucursal.',
    ],
];

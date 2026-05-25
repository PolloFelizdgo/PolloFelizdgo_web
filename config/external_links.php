<?php

return [
    'billing' => [
        'url' => env('BILLING_URL', 'https://facturacion.galasistemas.com/'),
    ],

    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK_URL', 'https://www.facebook.com/pollofelizdurango/?locale=es_LA'),
        'instagram' => env('SOCIAL_INSTAGRAM_URL', 'https://www.instagram.com/pollofeliz.durango/'),
    ],

    'contact' => [
        'phone_e164' => env('CONTACT_PHONE_E164', '+526181293730'),
        'phone_digits' => env('CONTACT_PHONE_DIGITS', '526181293730'),
        'phone_display' => env('CONTACT_PHONE_DISPLAY', '(618) 129 3730'),
        'email' => env('CONTACT_EMAIL', 'contacto@pollofeliz.com'),
    ],

    'whatsapp' => [
        'default_message' => env('WHATSAPP_MESSAGE_DEFAULT', 'Hola, quiero hacer un pedido en Pollo Feliz.'),
        'menu_message' => env('WHATSAPP_MESSAGE_MENU', 'Hola, estoy viendo el menu y quiero pedir una recomendacion.'),
        'promotions_message' => env('WHATSAPP_MESSAGE_PROMOTIONS', 'Hola, vi sus promociones y quiero mas informacion para ordenar.'),
        'branches_message' => env('WHATSAPP_MESSAGE_BRANCHES', 'Hola, necesito apoyo para elegir mi sucursal mas cercana.'),
        'fallback_message' => env('WHATSAPP_MESSAGE_FALLBACK', 'Hola, tengo problemas con el formulario web y quiero contactarlos.'),
    ],
];

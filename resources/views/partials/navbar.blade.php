
<header class="fixed top-0 left-0 w-full bg-white/90 backdrop-blur-md shadow-md z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <a href="#inicio" class="flex items-center gap-3">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Pollo Feliz logo - red branding emblem for the restaurant chain, displayed in the top navigation bar"
                class="w-12 h-12 sm:w-14 sm:h-14 object-contain"
            >
            <span class="text-lg sm:text-2xl font-extrabold text-red-600">PolloFeliz</span>
        </a>

        <nav class="hidden md:flex gap-6 font-medium items-center">
            <a href="#inicio" class="hover:text-yellow-500 transition">Inicio</a>
            <a href="#sucursales" class="hover:text-yellow-500 transition">Sucursales</a>
            <a href="#menu" class="hover:text-yellow-500 transition">Menú</a>
            <a href="#promociones" class="hover:text-yellow-500 transition">Promociones</a>
            <a href="#acerca" class="hover:text-yellow-500 transition">Acerca de</a>
            <a href="#contacto" class="hover:text-yellow-500 transition">Contáctanos</a>
        </nav>

        <button
            type="button"
            id="mobileMenuButton"
            class="md:hidden inline-flex items-center justify-center w-11 h-11 rounded-xl bg-red-600 text-white shadow-lg hover:bg-red-700 transition"
            aria-label="Abrir menú"
            aria-expanded="false"
            aria-controls="mobileMenu"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div id="mobileMenu" class="hidden md:hidden px-4 sm:px-6 pb-4">
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col gap-4 text-gray-800 font-medium">
            <a href="#inicio" class="mobile-menu-link hover:text-yellow-500 transition">Inicio</a>
            <a href="#sucursales" class="mobile-menu-link hover:text-yellow-500 transition">Sucursales</a>
            <a href="#menu" class="mobile-menu-link hover:text-yellow-500 transition">Menú</a>
            <a href="#promociones" class="mobile-menu-link hover:text-yellow-500 transition">Promociones</a>
            <a href="#acerca" class="mobile-menu-link hover:text-yellow-500 transition">Acerca de</a>
            <a href="#contacto" class="mobile-menu-link hover:text-yellow-500 transition">Contáctanos</a>
        </div>
    </div>
</header>
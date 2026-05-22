<footer class="bg-gray-900 dark:bg-black text-white py-12 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Pollo Feliz" class="w-20 mb-4">
            <p class="text-gray-300 dark:text-gray-400">
                Sabor, tradición y calidad para toda la familia.
            </p>
        </div>

        <div>
            <h4 class="font-bold text-lg mb-4 text-yellow-400">Links rápidos</h4>
            <ul class="space-y-2 text-gray-300 dark:text-gray-400">
                <li><a href="{{ route('home') }}#inicio" class="hover:text-yellow-400">Inicio</a></li>
                <li><a href="{{ route('home') }}#sucursales" class="hover:text-yellow-400">Sucursales</a></li>
                <li><a href="{{ route('home') }}#menu" class="hover:text-yellow-400">Menú</a></li>
                <li><a href="{{ route('home') }}#promociones" class="hover:text-yellow-400">Promociones</a></li>
                <li><a href="{{ route('home') }}#acerca" class="hover:text-yellow-400">Acerca de</a></li>
                <li><a href="{{ route('home') }}#contacto" class="hover:text-yellow-400">Contáctanos</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold text-lg mb-4 text-yellow-400">Contacto</h4>
            <p class="text-gray-300 dark:text-gray-400">Durango, México</p>
            <p class="text-gray-300 dark:text-gray-400">(618) 000 0000</p>
            <p class="text-gray-300 dark:text-gray-400">contacto@pollofeliz.com</p>
        </div>

        <div>
            <h4 class="font-bold text-lg mb-4 text-yellow-400">Síguenos</h4>
            <div class="flex flex-col gap-2 text-gray-300 dark:text-gray-400">
                <a href="#" class="hover:text-yellow-400">Facebook</a>
                <a href="#" class="hover:text-yellow-400">Instagram</a>
                <a href="#" class="hover:text-yellow-400">WhatsApp</a>
            </div>
        </div>
    </div>

    <div class="text-center text-gray-400 dark:text-gray-500 mt-10 border-t border-gray-700 pt-6">
        © {{ date('Y') }} Pollo Feliz. Todos los derechos reservados.
    </div>
</footer>
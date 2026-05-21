<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8">
        <div>
            <img src="{{ asset('images/logo.png') }}" 
     alt="Pollo Feliz logo - red branding emblem for the restaurant chain, displayed in the top navigation bar"
     class="w-14 h-14 object-contain">
     <span> </span>
        


            <span class="text-2xl font-extrabold text-red-600">PolloFeliz</span>
                Sabor, tradición y calidad para toda la familia.
            </p>
        </div>

        <div>
            <h4 class="font-bold text-lg mb-4 text-yellow-400">Links rápidos</h4>
            <ul class="space-y-2 text-gray-300">
                <li><a href="#inicio" class="hover:text-yellow-400">Inicio</a></li>
                <li><a href="#sucursales" class="hover:text-yellow-400">Sucursales</a></li>
                <li><a href="#menu" class="hover:text-yellow-400">Menú</a></li>
                <li><a href="#promociones" class="hover:text-yellow-400">Promociones</a></li>
                <li><a href="#acerca" class="hover:text-yellow-400">Acerca de</a></li>
                <li><a href="#contacto" class="hover:text-yellow-400">Contáctanos</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold text-lg mb-4 text-yellow-400">Contacto</h4>
            <p class="text-gray-300">Durango, México</p>
            <p class="text-gray-300">(618) 000 0000</p>
            <p class="text-gray-300">contacto@pollofeliz.com</p>
        </div>

        <div>
            <h4 class="font-bold text-lg mb-4 text-yellow-400">Síguenos</h4>
            <div class="flex flex-col gap-2 text-gray-300">
                <a href="#" class="hover:text-yellow-400">Facebook</a>
                <a href="#" class="hover:text-yellow-400">Instagram</a>
                <a href="#" class="hover:text-yellow-400">WhatsApp</a>
            </div>
        </div>
    </div>

    <div class="text-center text-gray-400 mt-10 border-t border-gray-700 pt-6">
        © {{ date('Y') }} Pollo Feliz. Todos los derechos reservados.
    </div>
</footer>
<footer class="bg-gray-900 dark:bg-black text-white pt-12 pb-8 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <div class="rounded-3xl bg-gradient-to-r from-red-700 via-red-600 to-yellow-500 p-6 md:p-8 mb-10 shadow-2xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <p class="text-white/85 text-sm uppercase tracking-[0.18em]">Atencion corporativa</p>
                    <h3 class="text-2xl md:text-3xl font-extrabold mt-1">Hablemos de tu sucursal o facturacion</h3>
                </div>
                <a
                    href="{{ route('home') }}#contacto"
                    class="inline-flex items-center justify-center bg-white text-gray-900 font-bold px-6 py-3 rounded-full shadow-lg hover:bg-yellow-100 transition"
                >
                    Contactar ahora
                </a>
            </div>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="Pollo Feliz" class="brand-logo w-20 mb-4">
                <p class="text-gray-300 dark:text-gray-400 leading-relaxed">
                    Sabor, tradición y calidad para toda la familia. Comprometidos con un servicio cálido en cada sucursal.
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
                    <li><a href="{{ route('vacancies.index') }}" class="hover:text-yellow-400">Bolsa de trabajo</a></li>
                    <li><a href="{{ route('home') }}#contacto" class="hover:text-yellow-400">Contáctanos</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-4 text-yellow-400">Contacto</h4>
                <div class="space-y-2 text-gray-300 dark:text-gray-400">
                    <p>Durango, México</p>
                    <p>
                        Tel:
                        <a href="tel:+526181293730" class="hover:text-yellow-400">(618) 129 3730</a>
                    </p>
                    <p>Ext. RH: 2001</p>
                    <p>Ext. Facturación: 2002</p>
                    <p>
                        Email:
                        <a href="mailto:contacto@pollofeliz.com" class="hover:text-yellow-400">contacto@pollofeliz.com</a>
                    </p>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-4 text-yellow-400">Síguenos</h4>
                <div class="flex flex-col gap-2 text-gray-300 dark:text-gray-400">
                    <a href="https://www.facebook.com/pollofelizdurango/?locale=es_LA" target="_blank" rel="noopener noreferrer" class="hover:text-yellow-400">Facebook</a>
                    <a href="https://www.instagram.com/pollofeliz.durango/" target="_blank" rel="noopener noreferrer" class="hover:text-yellow-400">Instagram</a>
                    <a href="#" class="hover:text-yellow-400">WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="text-center text-gray-400 dark:text-gray-500 mt-10 border-t border-gray-700 pt-6">
            © {{ date('Y') }} Pollo Feliz. Todos los derechos reservados.
        </div>
    </div>
</footer>
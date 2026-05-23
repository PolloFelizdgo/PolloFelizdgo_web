<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Completo | Pollo Feliz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (() => {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="min-h-screen bg-[#fffaf5] text-gray-800 dark:bg-gray-950 dark:text-gray-100 transition-colors duration-300">
    <header class="sticky top-0 z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-md transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Pollo Feliz"
                    class="brand-logo w-12 h-12 sm:w-14 sm:h-14 object-contain"
                >
                <span class="text-lg sm:text-2xl font-extrabold text-red-600 dark:text-yellow-400">
                    PolloFeliz
                </span>
            </a>

            <div class="flex items-center gap-3">
                <button
                    type="button"
                    id="menuThemeToggle"
                    class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-white dark:bg-gray-800 text-xl shadow-md border border-gray-100 dark:border-gray-700 hover:scale-105 transition"
                    aria-label="Cambiar tema"
                >
                    <span id="menuThemeIcon">🌙</span>
                </button>

                <a
                    href="{{ route('home') }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2.5 rounded-full font-semibold shadow-md transition"
                >
                    Volver al inicio
                </a>
            </div>
        </div>
    </header>

    <main class="py-16">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h1 class="section-title">Menú Completo</h1>
                <p class="section-subtitle">
                    Explora todos nuestros productos, combos y complementos.
                </p>
            </div>

            <div class="max-w-2xl mx-auto mb-12">
                <div class="relative">
                    <input
                        type="text"
                        id="menuSearchInput"
                        placeholder="Buscar platillo, combo, bebida o complemento..."
                        class="w-full rounded-full border border-yellow-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 px-5 py-4 pr-12 shadow-md focus:outline-none focus:ring-2 focus:ring-red-400 transition-colors duration-300"
                    >
                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-300 text-xl">
                        🔍
                    </span>
                </div>
            </div>

            <div id="menuGrid" class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($menuItems as $item)
                    <div
                        class="menu-card card-soft border border-yellow-100 dark:border-gray-800 overflow-hidden transition-colors duration-300"
                        data-menu-name="{{ strtolower($item['name']) }}"
                        data-menu-description="{{ strtolower($item['description']) }}"
                        data-menu-price="{{ strtolower($item['price']) }}"
                    >
                        <button
                            type="button"
                            class="menu-image-trigger block w-full text-left"
                            data-image="{{ $item['image'] }}"
                            data-title="{{ $item['name'] }}"
                        >
                            <img
                                src="{{ $item['image'] }}"
                                alt="{{ $item['name'] }}"
                                class="w-full h-56 object-cover cursor-pointer hover:scale-105 transition duration-500"
                            >
                        </button>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ $item['name'] }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mt-3">
                                {{ $item['description'] }}
                            </p>
                            <p class="mt-4 text-2xl font-extrabold text-red-600 dark:text-yellow-400">
                                {{ $item['price'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div
                id="menuNoResults"
                class="hidden text-center mt-12 bg-white dark:bg-gray-900 rounded-3xl shadow-md px-6 py-10 transition-colors duration-300"
            >
                <p class="text-2xl font-bold text-red-600 dark:text-yellow-400">
                    No se encontraron resultados
                </p>
                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    Prueba con otro nombre o palabra clave.
                </p>
            </div>
        </section>

        <div
            id="menuImageModal"
            class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/80 px-4 py-8 opacity-0 transition-opacity duration-300"
        >
            <div id="menuModalPanel" class="relative max-w-4xl w-full scale-95 opacity-0 transition duration-300 ease-out">
                <button
                    type="button"
                    id="closeMenuImageModal"
                    class="absolute -top-4 -right-2 md:-top-5 md:-right-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-full w-10 h-10 shadow-lg text-2xl font-bold hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                >
                    ×
                </button>

                <div class="bg-white dark:bg-gray-900 rounded-3xl overflow-hidden shadow-2xl transition-colors duration-300">
                    <img
                        id="menuModalImage"
                        src=""
                        alt=""
                        class="w-full max-h-[80vh] object-cover"
                    >
                    <div class="p-4 md:p-6">
                        <h3 id="menuModalTitle" class="text-2xl font-extrabold text-red-600 dark:text-yellow-400"></h3>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('menuSearchInput');
            const menuCards = document.querySelectorAll('.menu-card');
            const noResults = document.getElementById('menuNoResults');

            if (searchInput && menuCards.length && noResults) {
                searchInput.addEventListener('input', () => {
                    const query = searchInput.value.toLowerCase().trim();
                    let visibleCount = 0;

                    menuCards.forEach((card) => {
                        const name = card.dataset.menuName || '';
                        const description = card.dataset.menuDescription || '';
                        const price = card.dataset.menuPrice || '';

                        const matches =
                            name.includes(query) ||
                            description.includes(query) ||
                            price.includes(query);

                        if (matches) {
                            card.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            card.classList.add('hidden');
                        }
                    });

                    if (visibleCount === 0) {
                        noResults.classList.remove('hidden');
                    } else {
                        noResults.classList.add('hidden');
                    }
                });
            }

            const menuImageTriggers = document.querySelectorAll('.menu-image-trigger');
            const menuImageModal = document.getElementById('menuImageModal');
            const menuModalImage = document.getElementById('menuModalImage');
            const menuModalTitle = document.getElementById('menuModalTitle');
            const menuModalPanel = document.getElementById('menuModalPanel');
            const closeMenuImageModal = document.getElementById('closeMenuImageModal');
            let closeModalTimeoutId;

            const closeModal = () => {
                if (!menuImageModal) {
                    return;
                }

                window.clearTimeout(closeModalTimeoutId);
                menuImageModal.classList.add('opacity-0');

                if (menuModalPanel) {
                    menuModalPanel.classList.add('scale-95', 'opacity-0');
                    menuModalPanel.classList.remove('scale-100', 'opacity-100');
                }

                closeModalTimeoutId = window.setTimeout(() => {
                    menuImageModal.classList.add('hidden');
                    menuImageModal.classList.remove('flex');
                }, 300);

                document.body.classList.remove('overflow-hidden');
            };

            const openModal = (imageSrc, title) => {
                if (!menuImageModal || !menuModalImage || !menuModalTitle || !imageSrc) {
                    return;
                }

                menuModalImage.src = imageSrc;
                menuModalImage.alt = title || 'Imagen de menu';
                menuModalTitle.textContent = title || 'Vista previa';
                window.clearTimeout(closeModalTimeoutId);
                menuImageModal.classList.remove('hidden');
                menuImageModal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                window.setTimeout(() => {
                    menuImageModal.classList.remove('opacity-0');

                    if (menuModalPanel) {
                        menuModalPanel.classList.remove('scale-95', 'opacity-0');
                        menuModalPanel.classList.add('scale-100', 'opacity-100');
                    }
                }, 10);
            };

            menuImageTriggers.forEach((trigger) => {
                trigger.addEventListener('click', () => {
                    openModal(trigger.dataset.image || '', trigger.dataset.title || '');
                });
            });

            if (closeMenuImageModal) {
                closeMenuImageModal.addEventListener('click', closeModal);
            }

            if (menuImageModal) {
                menuImageModal.addEventListener('click', (event) => {
                    if (event.target === menuImageModal) {
                        closeModal();
                    }
                });
            }

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>
</body>
</html>
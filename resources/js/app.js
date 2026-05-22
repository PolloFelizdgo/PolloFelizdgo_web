const themeToggle = document.getElementById('themeToggle');
const themeToggleMobile = document.getElementById('themeToggleMobile');
const themeIcon = document.getElementById('themeIcon');
const themeIconMobile = document.getElementById('themeIconMobile');
const menuThemeToggle = document.getElementById('menuThemeToggle');
const menuThemeIcon = document.getElementById('menuThemeIcon');

// Sincroniza iconos de tema en desktop, mobile y pagina de menu.
const updateThemeIcons = () => {
    const isDark = document.documentElement.classList.contains('dark');
    const icon = isDark ? '☀️' : '🌙';

    if (themeIcon) themeIcon.textContent = icon;
    if (themeIconMobile) themeIconMobile.textContent = icon;
    if (menuThemeIcon) menuThemeIcon.textContent = icon;
};

// Alterna modo oscuro/claro y guarda preferencia local.
const toggleTheme = () => {
    const isDark = document.documentElement.classList.contains('dark');

    if (isDark) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }

    updateThemeIcons();
};

if (themeToggle) {
    themeToggle.addEventListener('click', toggleTheme);
}

if (themeToggleMobile) {
    themeToggleMobile.addEventListener('click', toggleTheme);
}

if (menuThemeToggle) {
    menuThemeToggle.addEventListener('click', toggleTheme);
}

updateThemeIcons();

// Inicializa carrusel principal del hero (navegacion, autoplay y modal).
const initHeroSlider = () => {
    const slides = Array.from(document.querySelectorAll('.hero-slide'));
    const dots = Array.from(document.querySelectorAll('.hero-dot'));
    const prevButton = document.getElementById('heroPrev');
    const nextButton = document.getElementById('heroNext');
    const heroTitle = document.getElementById('heroTitle');
    const heroDescription = document.getElementById('heroDescription');

    if (!slides.length) {
        return;
    }

    let currentIndex = slides.findIndex((slide) => !slide.classList.contains('hidden'));

    if (currentIndex < 0) {
        currentIndex = 0;
    }

    const showSlide = (index) => {
        const total = slides.length;
        currentIndex = (index + total) % total;
        const activeSlide = slides[currentIndex];

        // Cambia texto del hero en sincronía con la imagen activa.
        const updateText = (element, newText) => {
            if (!element || typeof newText !== 'string') {
                return;
            }

            element.classList.add('opacity-0');

            window.setTimeout(() => {
                element.textContent = newText;
                element.classList.remove('opacity-0');
            }, 150);
        };

        if (heroTitle && heroDescription) {
            heroTitle.classList.add('transition-opacity', 'duration-300');
            heroDescription.classList.add('transition-opacity', 'duration-300');

            updateText(heroTitle, activeSlide.dataset.title || '');
            updateText(heroDescription, activeSlide.dataset.text || '');
        }

        slides.forEach((slide, slideIndex) => {
            const isActive = slideIndex === currentIndex;
            slide.classList.toggle('hidden', !isActive);
            slide.classList.toggle('block', isActive);
        });

        dots.forEach((dot, dotIndex) => {
            const isActive = dotIndex === currentIndex;
            dot.classList.toggle('bg-red-600', isActive);
            dot.classList.toggle('bg-gray-300', !isActive);
            dot.classList.toggle('dark:bg-gray-600', !isActive);
        });
    };

    const nextSlide = () => showSlide(currentIndex + 1);
    const prevSlide = () => showSlide(currentIndex - 1);

    if (nextButton) {
        nextButton.addEventListener('click', nextSlide);
    }

    if (prevButton) {
        prevButton.addEventListener('click', prevSlide);
    }

    dots.forEach((dot, dotIndex) => {
        dot.addEventListener('click', () => showSlide(dotIndex));
    });

    // Autoplay cada 5 segundos con reinicio cuando hay interaccion manual.
    let autoPlayId = window.setInterval(nextSlide, 5000);

    const restartAutoPlay = () => {
        window.clearInterval(autoPlayId);
        autoPlayId = window.setInterval(nextSlide, 5000);
    };

    [prevButton, nextButton, ...dots].forEach((element) => {
        if (element) {
            element.addEventListener('click', restartAutoPlay);
        }
    });

    // Modal de imagen ampliada para cada slide del hero.
    const modal = document.getElementById('heroImageModal');
    const modalImage = document.getElementById('heroModalImage');
    const modalTitle = document.getElementById('heroModalTitle');
    const closeModalButton = document.getElementById('closeHeroImageModal');
    const previewButtons = Array.from(document.querySelectorAll('.hero-preview-trigger'));

    const closeModal = () => {
        if (!modal) {
            return;
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    const openModal = (imageSrc, title) => {
        if (!modal || !modalImage || !modalTitle) {
            return;
        }

        modalImage.src = imageSrc;
        modalImage.alt = title;
        modalTitle.textContent = title;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    previewButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const imageSrc = button.dataset.image || '';
            const title = button.dataset.title || '';

            if (imageSrc) {
                openModal(imageSrc, title);
            }
        });
    });

    if (closeModalButton) {
        closeModalButton.addEventListener('click', closeModal);
    }

    if (modal) {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeModal();
        }
    });

    showSlide(currentIndex);
};

initHeroSlider();
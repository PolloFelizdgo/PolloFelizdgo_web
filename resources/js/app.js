import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // =========================
    // Menú móvil navbar
    // =========================
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';

            mobileMenu.classList.toggle('hidden');
            mobileMenuButton.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
        });

        mobileMenuLinks.forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // =========================
    // Helpers modales
    // =========================
    const openGenericModal = (modal, imageEl, titleEl, imageSrc, title) => {
        if (!modal || !imageEl || !titleEl) return;

        imageEl.src = imageSrc;
        imageEl.alt = title;
        titleEl.textContent = title;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    const closeGenericModal = (modal, imageEl, titleEl) => {
        if (!modal || !imageEl || !titleEl) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        imageEl.src = '';
        imageEl.alt = '';
        titleEl.textContent = '';
        document.body.classList.remove('overflow-hidden');
    };

    // =========================
    // Modal sucursales
    // =========================
    const branchModal = document.getElementById('branchImageModal');
    const branchModalImage = document.getElementById('branchModalImage');
    const branchModalTitle = document.getElementById('branchModalTitle');
    const closeBranchButton = document.getElementById('closeBranchImageModal');
    const branchTriggers = document.querySelectorAll('.branch-image-trigger');

    branchTriggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            openGenericModal(
                branchModal,
                branchModalImage,
                branchModalTitle,
                trigger.dataset.image,
                trigger.dataset.title
            );
        });
    });

    if (closeBranchButton) {
        closeBranchButton.addEventListener('click', () => {
            closeGenericModal(branchModal, branchModalImage, branchModalTitle);
        });
    }

    if (branchModal) {
        branchModal.addEventListener('click', (event) => {
            if (event.target === branchModal) {
                closeGenericModal(branchModal, branchModalImage, branchModalTitle);
            }
        });
    }

    // =========================
    // Modal menú
    // =========================
    const menuModal = document.getElementById('menuImageModal');
    const menuModalImage = document.getElementById('menuModalImage');
    const menuModalTitle = document.getElementById('menuModalTitle');
    const closeMenuButton = document.getElementById('closeMenuImageModal');
    const menuTriggers = document.querySelectorAll('.menu-image-trigger');

    menuTriggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            openGenericModal(
                menuModal,
                menuModalImage,
                menuModalTitle,
                trigger.dataset.image,
                trigger.dataset.title
            );
        });
    });

    if (closeMenuButton) {
        closeMenuButton.addEventListener('click', () => {
            closeGenericModal(menuModal, menuModalImage, menuModalTitle);
        });
    }

    if (menuModal) {
        menuModal.addEventListener('click', (event) => {
            if (event.target === menuModal) {
                closeGenericModal(menuModal, menuModalImage, menuModalTitle);
            }
        });
    }

    // =========================
    // Slider + modal hero
    // =========================
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-dot');
    const heroPrev = document.getElementById('heroPrev');
    const heroNext = document.getElementById('heroNext');
    const heroPreviewTriggers = document.querySelectorAll('.hero-preview-trigger');

    const heroModal = document.getElementById('heroImageModal');
    const heroModalImage = document.getElementById('heroModalImage');
    const heroModalTitle = document.getElementById('heroModalTitle');
    const closeHeroButton = document.getElementById('closeHeroImageModal');

    let currentHeroSlide = 0;
    let heroInterval = null;

    const showHeroSlide = (index) => {
        if (!heroSlides.length) return;

        if (index < 0) index = heroSlides.length - 1;
        if (index >= heroSlides.length) index = 0;

        heroSlides.forEach((slide, i) => {
            slide.classList.toggle('hidden', i !== index);
            slide.classList.toggle('block', i === index);
        });

        heroDots.forEach((dot, i) => {
            dot.classList.toggle('bg-red-600', i === index);
            dot.classList.toggle('bg-gray-300', i !== index);
        });

        currentHeroSlide = index;
    };

    const nextHeroSlide = () => showHeroSlide(currentHeroSlide + 1);
    const prevHeroSlide = () => showHeroSlide(currentHeroSlide - 1);

    const startHeroAutoplay = () => {
        if (!heroSlides.length) return;

        stopHeroAutoplay();

        heroInterval = setInterval(() => {
            nextHeroSlide();
        }, 4000);
    };

    const stopHeroAutoplay = () => {
        if (heroInterval) {
            clearInterval(heroInterval);
            heroInterval = null;
        }
    };

    if (heroPrev) {
        heroPrev.addEventListener('click', () => {
            prevHeroSlide();
            startHeroAutoplay();
        });
    }

    if (heroNext) {
        heroNext.addEventListener('click', () => {
            nextHeroSlide();
            startHeroAutoplay();
        });
    }

    heroDots.forEach((dot) => {
        dot.addEventListener('click', () => {
            showHeroSlide(Number(dot.dataset.dotIndex));
            startHeroAutoplay();
        });
    });

    heroPreviewTriggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            openGenericModal(
                heroModal,
                heroModalImage,
                heroModalTitle,
                trigger.dataset.image,
                trigger.dataset.title
            );
        });
    });

    if (closeHeroButton) {
        closeHeroButton.addEventListener('click', () => {
            closeGenericModal(heroModal, heroModalImage, heroModalTitle);
        });
    }

    if (heroModal) {
        heroModal.addEventListener('click', (event) => {
            if (event.target === heroModal) {
                closeGenericModal(heroModal, heroModalImage, heroModalTitle);
            }
        });
    }

    // =========================
    // Cerrar con ESC
    // =========================
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            if (branchModal && !branchModal.classList.contains('hidden')) {
                closeGenericModal(branchModal, branchModalImage, branchModalTitle);
            }

            if (menuModal && !menuModal.classList.contains('hidden')) {
                closeGenericModal(menuModal, menuModalImage, menuModalTitle);
            }

            if (heroModal && !heroModal.classList.contains('hidden')) {
                closeGenericModal(heroModal, heroModalImage, heroModalTitle);
            }

            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                mobileMenuButton?.setAttribute('aria-expanded', 'false');
            }
        }
    });

    if (heroSlides.length) {
        showHeroSlide(0);
        startHeroAutoplay();
    }
});
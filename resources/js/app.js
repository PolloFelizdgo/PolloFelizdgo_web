const themeToggle = document.getElementById('themeToggle');
const themeToggleMobile = document.getElementById('themeToggleMobile');
const themeIcon = document.getElementById('themeIcon');
const themeIconMobile = document.getElementById('themeIconMobile');
const menuThemeToggle = document.getElementById('menuThemeToggle');
const menuThemeIcon = document.getElementById('menuThemeIcon');

// Aplica preferencia de tema guardada para mantener consistencia entre recargas.
const applySavedThemePreference = () => {
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
    }

    if (savedTheme === 'light') {
        document.documentElement.classList.remove('dark');
    }
};

applySavedThemePreference();

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

const initTestimonialCarousel = () => {
    const carousel = document.querySelector('.testimonial-carousel');

    if (!carousel) {
        return;
    }

    const track = carousel.querySelector('.testimonial-track');
    const slides = Array.from(carousel.querySelectorAll('.testimonial-slide'));
    const prevButton = carousel.querySelector('.testimonial-prev');
    const nextButton = carousel.querySelector('.testimonial-next');
    const dotsContainer = carousel.querySelector('.testimonial-dots');

    if (!track || !slides.length || !dotsContainer) {
        return;
    }

    let currentIndex = 0;
    let autoPlayId = null;

    const updateDots = () => {
        dotsContainer.innerHTML = '';

        slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.setAttribute('aria-label', `Ir al testimonio ${index + 1}`);
            dot.className = 'testimonial-dot h-2.5 rounded-full transition-all duration-300';

            if (index === currentIndex) {
                dot.classList.add('w-8', 'bg-red-600', 'dark:bg-yellow-400');
            } else {
                dot.classList.add('w-2.5', 'bg-gray-300', 'dark:bg-gray-600');
            }

            dot.addEventListener('click', () => {
                showSlide(index);
                restartAutoPlay();
            });

            dotsContainer.appendChild(dot);
        });
    };

    const showSlide = (index) => {
        const total = slides.length;
        currentIndex = (index + total) % total;
        track.style.transform = `translateX(-${currentIndex * 100}%)`;

        const dots = Array.from(dotsContainer.querySelectorAll('.testimonial-dot'));
        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('w-8', dotIndex === currentIndex);
            dot.classList.toggle('bg-red-600', dotIndex === currentIndex);
            dot.classList.toggle('dark:bg-yellow-400', dotIndex === currentIndex);
            dot.classList.toggle('w-2.5', dotIndex !== currentIndex);
            dot.classList.toggle('bg-gray-300', dotIndex !== currentIndex);
            dot.classList.toggle('dark:bg-gray-600', dotIndex !== currentIndex);
        });
    };

    const nextSlide = () => showSlide(currentIndex + 1);
    const prevSlide = () => showSlide(currentIndex - 1);

    const restartAutoPlay = () => {
        if (autoPlayId) {
            window.clearInterval(autoPlayId);
        }

        autoPlayId = window.setInterval(nextSlide, 6500);
    };

    if (prevButton) {
        prevButton.addEventListener('click', () => {
            prevSlide();
            restartAutoPlay();
        });
    }

    if (nextButton) {
        nextButton.addEventListener('click', () => {
            nextSlide();
            restartAutoPlay();
        });
    }

    carousel.addEventListener('mouseenter', () => {
        if (autoPlayId) {
            window.clearInterval(autoPlayId);
        }
    });

    carousel.addEventListener('mouseleave', restartAutoPlay);

    document.addEventListener('keydown', (event) => {
        if (!carousel.matches(':hover') && event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') {
            return;
        }

        if (event.key === 'ArrowLeft') {
            prevSlide();
            restartAutoPlay();
        }

        if (event.key === 'ArrowRight') {
            nextSlide();
            restartAutoPlay();
        }
    });

    updateDots();
    showSlide(0);
    restartAutoPlay();
};

initTestimonialCarousel();

const initHistoryPreview = () => {
    const triggers = Array.from(document.querySelectorAll('.history-preview-trigger'));
    const modal = document.getElementById('historyPreviewModal');
    const modalPanel = document.getElementById('historyPreviewPanel');
    const modalImage = document.getElementById('historyPreviewImage');
    const modalTitle = document.getElementById('historyPreviewTitle');
    const modalYear = document.getElementById('historyPreviewYear');
    const modalDescription = document.getElementById('historyPreviewDescription');
    const closeButton = document.getElementById('closeHistoryPreviewModal');

    if (!triggers.length || !modal || !modalPanel || !modalImage || !modalTitle || !modalYear || !modalDescription) {
        return;
    }

    let closeTimeoutId = null;

    const closeModal = () => {
        window.clearTimeout(closeTimeoutId);
        modal.classList.add('opacity-0');

        if (modalPanel) {
            modalPanel.classList.add('scale-95', 'opacity-0');
            modalPanel.classList.remove('scale-100', 'opacity-100');
        }

        closeTimeoutId = window.setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);

        document.body.classList.remove('overflow-hidden');
    };

    const openModal = (trigger) => {
        const previewSource = trigger?.dataset?.previewImage
            ? trigger
            : trigger?.closest?.('[data-preview-image]');

        const imageSrc = previewSource?.dataset?.previewImage || '';
        const title = previewSource?.dataset?.previewTitle || 'Historia';
        const year = previewSource?.dataset?.previewYear || '';
        const description = previewSource?.dataset?.previewDescription || '';

        if (!imageSrc) {
            return;
        }

        modalImage.src = imageSrc;
        modalImage.alt = title;
        modalTitle.textContent = title;
        modalYear.textContent = year;
        modalDescription.textContent = description;

        window.clearTimeout(closeTimeoutId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        window.setTimeout(() => {
            modal.classList.remove('opacity-0');

            if (modalPanel) {
                modalPanel.classList.remove('scale-95', 'opacity-0');
                modalPanel.classList.add('scale-100', 'opacity-100');
            }
        }, 10);
    };

    window.openHistoryPreview = (payload) => {
        const imageSrc = payload?.image || '';
        const title = payload?.title || 'Historia';
        const year = payload?.year || '';
        const description = payload?.description || '';

        if (!imageSrc) {
            return;
        }

        modalImage.src = imageSrc;
        modalImage.alt = title;
        modalTitle.textContent = title;
        modalYear.textContent = year;
        modalDescription.textContent = description;

        window.clearTimeout(closeTimeoutId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        window.setTimeout(() => {
            modal.classList.remove('opacity-0');

            if (modalPanel) {
                modalPanel.classList.remove('scale-95', 'opacity-0');
                modalPanel.classList.add('scale-100', 'opacity-100');
            }
        }, 10);
    };

    window.closeHistoryPreview = closeModal;

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => openModal(trigger));
    });

    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    }

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
};

initHistoryPreview();

const initContactForm = () => {
    const form = document.getElementById('contactForm');
    const submitButton = document.getElementById('contactSubmitButton');
    const submitText = document.getElementById('contactSubmitText');
    const spinner = document.getElementById('contactSubmitSpinner');
    const feedback = document.getElementById('contactFormFeedback');
    const recaptchaTokenInput = document.getElementById('recaptchaToken');

    if (!form || !submitButton || !submitText || !spinner || !feedback) {
        return;
    }

    const showFeedback = (type, message) => {
        feedback.className = 'mb-6 rounded-2xl px-5 py-4 transition-colors duration-300';

        if (type === 'success') {
            feedback.classList.add('bg-green-100', 'dark:bg-green-950/40', 'border', 'border-green-300', 'dark:border-green-800', 'text-green-800', 'dark:text-green-300');
        } else {
            feedback.classList.add('bg-red-100', 'dark:bg-red-950/40', 'border', 'border-red-300', 'dark:border-red-800', 'text-red-700', 'dark:text-red-300');
        }

        feedback.textContent = message;
        feedback.classList.remove('hidden');
    };

    const setLoadingState = (isLoading) => {
        submitButton.disabled = isLoading;
        spinner.classList.toggle('hidden', !isLoading);
        submitText.textContent = isLoading ? 'Enviando...' : 'Enviar mensaje';
    };

    // Solicita token reCAPTCHA v3 justo antes de enviar el formulario.
    const resolveRecaptchaToken = async () => {
        const siteKey = form.dataset.recaptchaSiteKey || '';

        if (!siteKey) {
            return '';
        }

        if (!window.grecaptcha || typeof window.grecaptcha.execute !== 'function') {
            throw new Error('reCAPTCHA no disponible');
        }

        return new Promise((resolve, reject) => {
            window.grecaptcha.ready(() => {
                window.grecaptcha.execute(siteKey, { action: 'contact_form' })
                    .then(resolve)
                    .catch(reject);
            });
        });
    };

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        feedback.classList.add('hidden');
        setLoadingState(true);

        const formData = new FormData(form);
        const csrfToken = form.querySelector('input[name="_token"]')?.value || '';

        try {
            const token = await resolveRecaptchaToken();

            if (recaptchaTokenInput) {
                recaptchaTokenInput.value = token;
            }

            formData.set('g-recaptcha-response', token);

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            });

            const payload = await response.json().catch(() => ({}));

            if (!response.ok) {
                if (payload?.errors && typeof payload.errors === 'object') {
                    const firstError = Object.values(payload.errors)[0];
                    const firstMessage = Array.isArray(firstError) ? firstError[0] : 'Verifica los campos e intenta nuevamente.';
                    showFeedback('error', firstMessage);
                } else {
                    showFeedback('error', payload?.message || 'No se pudo enviar tu mensaje en este momento. Intenta nuevamente o contactanos por WhatsApp.');
                }

                return;
            }

            showFeedback('success', payload?.message || 'Tu mensaje fue enviado correctamente.');
            form.reset();
        } catch (_error) {
            showFeedback('error', 'No se pudo enviar tu mensaje en este momento. Verifica tu conexion e intenta nuevamente o usa WhatsApp.');
        } finally {
            setLoadingState(false);
        }
    });
};

initContactForm();

const initContextualWhatsApp = () => {
    const button = document.getElementById('whatsappFloatButton');

    if (!button) {
        return;
    }

    const phone = button.dataset.phone || '526181293730';
    const messages = {
        default: button.dataset.messageDefault || 'Hola, quiero hacer un pedido en Pollo Feliz.',
        menu: button.dataset.messageMenu || 'Hola, estoy viendo el menu y quiero pedir una recomendacion.',
        promociones: button.dataset.messagePromociones || 'Hola, vi sus promociones y quiero mas informacion para ordenar.',
        sucursales: button.dataset.messageSucursales || 'Hola, necesito apoyo para elegir mi sucursal mas cercana.',
    };

    const sectionMap = [
        { id: 'menu', messageKey: 'menu' },
        { id: 'promociones', messageKey: 'promociones' },
        { id: 'sucursales', messageKey: 'sucursales' },
    ];

    const buildHref = (message) => `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;

    const applyMessage = (messageKey) => {
        const nextMessage = messages[messageKey] || messages.default;
        button.href = buildHref(nextMessage);
    };

    const syncMessageByViewport = () => {
        const middle = window.innerHeight / 2;
        let activeMessageKey = 'default';

        sectionMap.forEach((section) => {
            const element = document.getElementById(section.id);

            if (!element) {
                return;
            }

            const rect = element.getBoundingClientRect();
            if (rect.top <= middle && rect.bottom >= middle) {
                activeMessageKey = section.messageKey;
            }
        });

        applyMessage(activeMessageKey);
    };

    applyMessage('default');
    window.addEventListener('scroll', syncMessageByViewport, { passive: true });
    window.addEventListener('resize', syncMessageByViewport);
    syncMessageByViewport();
};

initContextualWhatsApp();

const initRevealOnScroll = () => {
    const items = Array.from(document.querySelectorAll('.reveal-on-scroll'));

    if (!items.length) {
        return;
    }

    if (!('IntersectionObserver' in window)) {
        items.forEach((item) => {
            item.classList.remove('opacity-0', 'translate-y-6');
            item.classList.add('opacity-100', 'translate-y-0');
        });

        return;
    }

    // Mantiene contenido visible por defecto y solo aplica estado inicial si JS esta activo.
    items.forEach((item) => {
        item.classList.add('opacity-0', 'translate-y-6');
        item.classList.remove('opacity-100', 'translate-y-0');
    });

    const observer = new IntersectionObserver((entries, currentObserver) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-6');
                entry.target.classList.add('opacity-100', 'translate-y-0');
                currentObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -8% 0px',
    });

    items.forEach((item) => observer.observe(item));

    // Fallback: evita que cualquier elemento quede oculto si el observer no dispara.
    window.setTimeout(() => {
        items.forEach((item) => {
            if (item.classList.contains('opacity-0')) {
                item.classList.remove('opacity-0', 'translate-y-6');
                item.classList.add('opacity-100', 'translate-y-0');
            }
        });
    }, 1800);
};

initRevealOnScroll();
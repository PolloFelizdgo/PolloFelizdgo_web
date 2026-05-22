
import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('branchImageModal');
    const modalImage = document.getElementById('branchModalImage');
    const modalTitle = document.getElementById('branchModalTitle');
    const closeButton = document.getElementById('closeBranchImageModal');
    const triggers = document.querySelectorAll('.branch-image-trigger');

    if (!modal || !modalImage || !modalTitle || !closeButton || !triggers.length) {
        return;
    }

    const openModal = (imageSrc, title) => {
        modalImage.src = imageSrc;
        modalImage.alt = title;
        modalTitle.textContent = title;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modalImage.src = '';
        modalImage.alt = '';
        modalTitle.textContent = '';
        document.body.classList.remove('overflow-hidden');
    };

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const imageSrc = trigger.dataset.image;
            const title = trigger.dataset.title;
            openModal(imageSrc, title);
        });
    });

    closeButton.addEventListener('click', closeModal);

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
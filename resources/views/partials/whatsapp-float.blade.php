<a
    id="whatsappFloatButton"
    href="https://wa.me/{{ config('external_links.contact.phone_digits') }}?text={{ rawurlencode((string) config('external_links.whatsapp.default_message')) }}"
    data-phone="{{ config('external_links.contact.phone_digits') }}"
    data-message-default="{{ config('external_links.whatsapp.default_message') }}"
    data-message-menu="{{ config('external_links.whatsapp.menu_message') }}"
    data-message-promociones="{{ config('external_links.whatsapp.promotions_message') }}"
    data-message-sucursales="{{ config('external_links.whatsapp.branches_message') }}"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Abrir WhatsApp para ordenar"
    class="fixed bottom-24 md:bottom-5 left-5 z-[998] inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-3 rounded-full shadow-2xl transition"
>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" aria-hidden="true">
        <path d="M20.52 3.48A11.83 11.83 0 0 0 12.07 0C5.5 0 .17 5.33.17 11.9c0 2.09.54 4.13 1.56 5.94L0 24l6.32-1.66a11.9 11.9 0 0 0 5.75 1.47h.01c6.57 0 11.9-5.33 11.9-11.9 0-3.18-1.24-6.17-3.46-8.43Zm-8.45 18.3h-.01a9.98 9.98 0 0 1-5.09-1.4l-.36-.21-3.75.98 1-3.66-.24-.38a9.9 9.9 0 0 1-1.53-5.22c0-5.46 4.44-9.9 9.9-9.9 2.64 0 5.13 1.03 7 2.9a9.84 9.84 0 0 1 2.9 7c0 5.46-4.44 9.9-9.9 9.9Zm5.42-7.42c-.3-.15-1.8-.88-2.08-.98-.28-.1-.49-.15-.69.15-.2.3-.79.98-.97 1.18-.18.2-.36.22-.66.07-.3-.15-1.27-.47-2.42-1.5a9.08 9.08 0 0 1-1.68-2.08c-.18-.3-.02-.46.13-.61.14-.14.3-.36.45-.54.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.69-1.67-.95-2.28-.25-.6-.5-.52-.69-.53h-.58c-.2 0-.53.08-.8.38-.28.3-1.05 1.03-1.05 2.5 0 1.47 1.08 2.9 1.23 3.1.15.2 2.12 3.24 5.13 4.54.72.31 1.28.5 1.72.64.72.23 1.37.2 1.88.12.57-.08 1.8-.73 2.06-1.44.25-.7.25-1.31.17-1.44-.07-.13-.27-.2-.57-.35Z"/>
    </svg>
    <span class="hidden sm:inline">Ordenar por WhatsApp</span>
</a>
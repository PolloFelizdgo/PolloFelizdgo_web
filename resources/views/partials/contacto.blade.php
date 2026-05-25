<section id="contacto" class="py-20 bg-gradient-to-r from-yellow-100 via-white to-red-100 dark:from-gray-950 dark:via-gray-900 dark:to-gray-950 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="section-title">Contáctanos</h2>
            <p class="section-subtitle">Envíanos tus dudas, comentarios o pedidos especiales.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-2xl bg-green-100 dark:bg-green-950/40 border border-green-300 dark:border-green-800 text-green-800 dark:text-green-300 px-5 py-4 transition-colors duration-300">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-2xl bg-red-100 dark:bg-red-950/40 border border-red-300 dark:border-red-800 text-red-700 dark:text-red-300 px-5 py-4 transition-colors duration-300">
                <p class="font-bold mb-2">Por favor corrige los siguientes errores:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="contactFormFeedback" class="hidden mb-6 rounded-2xl px-5 py-4 transition-colors duration-300" role="status" aria-live="polite"></div>

        <div class="mb-6 rounded-2xl bg-yellow-50 dark:bg-yellow-950/20 border border-yellow-200 dark:border-yellow-800 px-5 py-4 text-sm text-gray-700 dark:text-gray-300">
            <p class="font-semibold text-gray-900 dark:text-yellow-300">Canales alternos disponibles</p>
            <p class="mt-1">Si el formulario presenta una falla temporal de correo o API, puedes contactarnos por estos medios:</p>
            <div class="mt-3 flex flex-wrap gap-3">
                <a href="https://wa.me/{{ config('external_links.contact.phone_digits') }}?text={{ rawurlencode((string) config('external_links.whatsapp.fallback_message')) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center rounded-full bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 transition">
                    WhatsApp directo
                </a>
                <a href="tel:{{ config('external_links.contact.phone_e164') }}" class="inline-flex items-center rounded-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-100 font-semibold px-4 py-2 transition">
                    Llamar: {{ config('external_links.contact.phone_display') }}
                </a>
            </div>
        </div>

        <form id="contactForm" action="{{ route('contact.store') }}" method="POST" data-recaptcha-site-key="{{ config('services.recaptcha.site_key') }}" class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-8 grid md:grid-cols-2 gap-6 transition-colors duration-300">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold mb-2 text-gray-800 dark:text-gray-200">Nombre</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    class="w-full rounded-2xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-colors duration-300"
                >
            </div>

            <div>
                <label for="last_name" class="block text-sm font-semibold mb-2 text-gray-800 dark:text-gray-200">Apellidos</label>
                <input
                    id="last_name"
                    name="last_name"
                    type="text"
                    value="{{ old('last_name') }}"
                    class="w-full rounded-2xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-colors duration-300"
                >
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold mb-2 text-gray-800 dark:text-gray-200">Correo electrónico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    class="w-full rounded-2xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-colors duration-300"
                >
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold mb-2 text-gray-800 dark:text-gray-200">Celular</label>
                <input
                    id="phone"
                    name="phone"
                    type="text"
                    value="{{ old('phone') }}"
                    class="w-full rounded-2xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-colors duration-300"
                >
            </div>

            <div class="md:col-span-2">
                <label for="message" class="block text-sm font-semibold mb-2 text-gray-800 dark:text-gray-200">Mensaje</label>
                <textarea
                    id="message"
                    name="message"
                    rows="5"
                    class="w-full rounded-2xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-colors duration-300"
                >{{ old('message') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label for="privacy_consent" class="flex items-start gap-3 text-sm text-gray-700 dark:text-gray-300">
                    <input
                        id="privacy_consent"
                        name="privacy_consent"
                        type="checkbox"
                        value="1"
                        required
                        @checked(old('privacy_consent'))
                        class="mt-0.5 w-4 h-4 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-red-600 focus:ring-yellow-400"
                    >
                    <span>
                        Confirmo que he leído y acepto el
                        <a href="{{ route('privacy') }}" class="font-semibold text-red-600 dark:text-yellow-400 hover:underline">Aviso de privacidad</a>
                        para el tratamiento de mis datos personales.
                    </span>
                </label>
            </div>

            <div class="md:col-span-2">
                <input type="hidden" id="recaptchaToken" name="g-recaptcha-response" value="{{ old('g-recaptcha-response') }}">
                @if(config('services.recaptcha.site_key'))
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                        Este sitio esta protegido por reCAPTCHA y aplican la Politica de Privacidad y los Terminos de Servicio de Google.
                    </p>
                @else
                    <p class="text-sm text-red-600 dark:text-red-400 text-center">
                        Configura RECAPTCHA_SITE_KEY para activar el captcha del formulario.
                    </p>
                @endif
            </div>

            <div class="md:col-span-2 text-center">
                <button
                    type="submit"
                    id="contactSubmitButton"
                    class="inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 disabled:bg-red-400 disabled:cursor-not-allowed text-white px-8 py-3 rounded-full shadow-lg transition"
                >
                    <svg id="contactSubmitSpinner" class="hidden w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span id="contactSubmitText">Enviar mensaje</span>
                </button>
            </div>
        </form>
    </div>
</section>

@if(config('services.recaptcha.site_key'))
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}" async defer></script>
@endif
<section id="contacto" class="py-20 bg-gradient-to-r from-yellow-100 via-white to-red-100">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="section-title">Contáctanos</h2>
            <p class="section-subtitle">Envíanos tus dudas, comentarios o pedidos especiales.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-2xl bg-green-100 border border-green-300 text-green-800 px-5 py-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-2xl bg-red-100 border border-red-300 text-red-700 px-5 py-4">
                <p class="font-bold mb-2">Por favor corrige los siguientes errores:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="bg-white shadow-2xl rounded-3xl p-8 grid md:grid-cols-2 gap-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold mb-2">Nombre</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                >
            </div>

            <div>
                <label for="last_name" class="block text-sm font-semibold mb-2">Apellidos</label>
                <input
                    id="last_name"
                    name="last_name"
                    type="text"
                    value="{{ old('last_name') }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                >
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold mb-2">Correo electrónico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                >
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold mb-2">Celular</label>
                <input
                    id="phone"
                    name="phone"
                    type="text"
                    value="{{ old('phone') }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                >
            </div>

            <div class="md:col-span-2">
                <label for="message" class="block text-sm font-semibold mb-2">Mensaje</label>
                <textarea
                    id="message"
                    name="message"
                    rows="5"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                >{{ old('message') }}</textarea>
            </div>

            <div class="md:col-span-2 text-center">
                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-full shadow-lg transition">
                    Enviar mensaje
                </button>
            </div>
        </form>
    </div>
</section>
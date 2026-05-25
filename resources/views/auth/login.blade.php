<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al panel | Pollo Feliz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            min-height: 100vh;
            background:
                radial-gradient(1000px 360px at 12% -8%, rgba(248, 113, 113, 0.22), transparent 70%),
                radial-gradient(820px 300px at 88% -14%, rgba(250, 204, 21, 0.16), transparent 70%),
                linear-gradient(180deg, #fff8f2 0%, #fefcf8 58%, #fffdfb 100%);
        }

        .login-card {
            border: 1px solid rgba(229, 231, 235, 0.94);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 24px 46px -38px rgba(15, 23, 42, 0.6);
        }

        .login-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 9999px;
            padding: 0.28rem 0.72rem;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #991b1b;
            background: rgba(254, 202, 202, 0.72);
            border: 1px solid rgba(252, 165, 165, 0.68);
        }

        .login-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            border-radius: 9999px;
            padding: 0.78rem 1rem;
            font-size: 0.94rem;
            font-weight: 800;
            color: #ffffff;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            box-shadow: 0 16px 28px -20px rgba(220, 38, 38, 0.95);
            transition: transform 140ms ease, filter 140ms ease;
        }

        .login-button:hover {
            transform: translateY(-1px);
            filter: brightness(1.03);
        }

        .dark body {
            background:
                radial-gradient(920px 340px at 12% -8%, rgba(239, 68, 68, 0.22), transparent 70%),
                radial-gradient(760px 300px at 88% -14%, rgba(245, 158, 11, 0.16), transparent 70%),
                linear-gradient(180deg, #111827 0%, #0b1220 55%, #0a0f1b 100%);
        }

        .dark .login-card {
            border-color: rgba(55, 65, 81, 0.9);
            background: rgba(17, 24, 39, 0.92);
            box-shadow: 0 24px 46px -38px rgba(0, 0, 0, 0.8);
        }
    </style>
</head>
<body class="text-gray-900 dark:text-gray-100 flex items-center justify-center px-4 py-8">
    <main class="w-full max-w-md">
        <section class="login-card rounded-3xl p-7 md:p-8">
            <div class="mb-6">
                <p class="login-badge">Panel interno</p>
                <h1 class="mt-4 text-3xl font-extrabold tracking-tight">Acceso al panel</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Ingresa con tu correo y contrasena para editar contenido, usuarios y roles.</p>
            </div>

            @if(session('success'))
                <div class="mb-4 rounded-xl border border-green-300 bg-green-50 text-green-800 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 rounded-xl border border-red-300 bg-red-50 text-red-700 px-4 py-3 text-sm">
                    <p class="font-semibold mb-1">Revisa lo siguiente:</p>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                @csrf

                <label class="block">
                    <span class="text-sm font-semibold">Correo</span>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 w-full rounded-2xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold">Contrasena</span>
                    <input type="password" name="password" required class="mt-1 w-full rounded-2xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3">
                </label>

                <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                    <input type="checkbox" name="remember" value="1" class="rounded border-gray-300 dark:border-gray-700">
                    Recordarme en este equipo
                </label>

                <button type="submit" class="login-button">Entrar al panel</button>
            </form>

            <p class="mt-6 text-xs text-gray-500 dark:text-gray-400">Si no tienes acceso, pide al administrador crear tu usuario.</p>
        </section>
    </main>
</body>
</html>
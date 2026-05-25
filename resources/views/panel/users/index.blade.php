@extends('panel.layouts.app')

@section('title', 'Usuarios y roles')

@section('content')
    <div class="mb-7 panel-card p-6">
        <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Gestion de usuarios y roles</h2>
        <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm md:text-base">
            Crea usuarios del panel, asigna permisos por rol y agrega nuevos roles.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-xl border border-green-300 bg-green-50 text-green-800 px-4 py-3 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 rounded-xl border border-red-300 bg-red-50 text-red-700 px-4 py-3 shadow-sm">
            <p class="font-semibold mb-2">Revisa lo siguiente:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid lg:grid-cols-2 gap-4">
        <section class="panel-card p-5">
            <h3 class="text-xl font-bold">Crear usuario</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Define nombre, correo, clave y rol de acceso.</p>

            <form method="POST" action="{{ route('panel.users.store') }}" class="mt-4 space-y-3">
                @csrf

                <label class="block">
                    <span class="text-sm font-semibold">Nombre</span>
                    <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-xl border border-gray-300 px-3 py-2 bg-white dark:bg-gray-900" required>
                </label>

                <label class="block">
                    <span class="text-sm font-semibold">Correo</span>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-xl border border-gray-300 px-3 py-2 bg-white dark:bg-gray-900" required>
                </label>

                <div class="grid md:grid-cols-2 gap-3">
                    <label class="block">
                        <span class="text-sm font-semibold">Contrasena</span>
                        <input type="password" name="password" class="mt-1 w-full rounded-xl border border-gray-300 px-3 py-2 bg-white dark:bg-gray-900" required>
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold">Confirmar contrasena</span>
                        <input type="password" name="password_confirmation" class="mt-1 w-full rounded-xl border border-gray-300 px-3 py-2 bg-white dark:bg-gray-900" required>
                    </label>
                </div>

                <label class="block">
                    <span class="text-sm font-semibold">Rol</span>
                    <select name="role_id" class="mt-1 w-full rounded-xl border border-gray-300 px-3 py-2 bg-white dark:bg-gray-900" required>
                        <option value="">Selecciona un rol</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @selected((string) old('role_id') === (string) $role->id)>{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </label>

                <button type="submit" class="panel-btn">Crear usuario</button>
            </form>
        </section>

        <section class="panel-card p-5">
            <h3 class="text-xl font-bold">Crear rol</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Usa nombres simples como cobranzas, soporte o auditor.</p>

            <form method="POST" action="{{ route('panel.roles.store') }}" class="mt-4 space-y-3">
                @csrf
                <label class="block">
                    <span class="text-sm font-semibold">Nombre del rol</span>
                    <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-xl border border-gray-300 px-3 py-2 bg-white dark:bg-gray-900" placeholder="ejemplo: soporte" required>
                </label>

                <button type="submit" class="panel-btn">Crear rol</button>
            </form>

            <div class="mt-6">
                <p class="text-sm font-semibold mb-2">Roles disponibles</p>
                <div class="flex flex-wrap gap-2">
                    @forelse($roles as $role)
                        <span class="rounded-full border border-gray-300 px-3 py-1 text-xs font-semibold bg-white dark:bg-gray-900">{{ $role->name }}</span>
                    @empty
                        <span class="text-sm text-gray-500">No hay roles registrados.</span>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <section class="mt-6 panel-card p-5">
        <h3 class="text-xl font-bold">Usuarios registrados</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Puedes actualizar el rol de cada usuario desde esta tabla.</p>

        <div class="mt-4 overflow-x-auto">
            <table class="w-full min-w-[620px] text-sm">
                <thead>
                    <tr class="text-left border-b border-gray-200 dark:border-gray-800">
                        <th class="py-2 pr-3">Nombre</th>
                        <th class="py-2 pr-3">Correo</th>
                        <th class="py-2 pr-3">Rol actual</th>
                        <th class="py-2">Cambiar rol</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td class="py-3 pr-3 font-semibold">{{ $user->name }}</td>
                            <td class="py-3 pr-3">{{ $user->email }}</td>
                            <td class="py-3 pr-3">{{ $user->role?->name ?? 'Sin rol' }}</td>
                            <td class="py-3">
                                <form method="POST" action="{{ route('panel.users.role.update', $user) }}" class="flex items-center gap-2">
                                    @csrf
                                    <select name="role_id" class="rounded-xl border border-gray-300 px-2 py-1 bg-white dark:bg-gray-900" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @selected((int) $user->role_id === (int) $role->id)>{{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="panel-btn-muted">Guardar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-500">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
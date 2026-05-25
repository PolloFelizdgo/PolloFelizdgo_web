<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->with('role')
            ->orderBy('name')
            ->get();

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        return view('panel.users.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function storeUser(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ]);

        User::query()->create([
            'name' => trim((string) $validated['name']),
            'email' => Str::lower((string) $validated['email']),
            'password' => (string) $validated['password'],
            'role_id' => (int) $validated['role_id'],
        ]);

        return redirect()->route('panel.users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function updateUserRole(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ]);

        $newRoleId = (int) $validated['role_id'];
        $authUser = $request->user();

        if ($authUser && $authUser->id === $user->id) {
            $adminRoleId = (int) Role::query()->where('name', 'administrador')->value('id');
            if ($adminRoleId > 0 && $user->role_id === $adminRoleId && $newRoleId !== $adminRoleId) {
                return back()->withErrors([
                    'role_id' => 'No puedes quitarte a ti mismo el rol administrador desde esta pantalla.',
                ]);
            }
        }

        $user->role_id = $newRoleId;
        $user->save();

        return redirect()->route('panel.users.index')->with('success', 'Rol de usuario actualizado.');
    }

    public function storeRole(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:60', 'unique:roles,name'],
        ]);

        $roleName = Str::of((string) $validated['name'])
            ->trim()
            ->lower()
            ->toString();

        if ($roleName === '') {
            return back()->withErrors([
                'name' => 'El nombre del rol es obligatorio.',
            ]);
        }

        Role::query()->create([
            'name' => $roleName,
        ]);

        return redirect()->route('panel.users.index')->with('success', 'Rol creado correctamente.');
    }
}
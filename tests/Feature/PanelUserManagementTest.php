<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PanelUserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_user_management_screen(): void
    {
        $admin = $this->createUserWithRole('administrador');

        $response = $this->actingAs($admin)->get(route('panel.users.index'));

        $response
            ->assertOk()
            ->assertSee('Gestion de usuarios y roles', false);
    }

    public function test_admin_can_create_new_role(): void
    {
        $admin = $this->createUserWithRole('administrador');

        $response = $this->actingAs($admin)->post(route('panel.roles.store'), [
            'name' => 'soporte',
        ]);

        $response
            ->assertRedirect(route('panel.users.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('roles', [
            'name' => 'soporte',
        ]);
    }

    public function test_admin_can_create_user_with_role(): void
    {
        $admin = $this->createUserWithRole('administrador');
        $editorRole = $this->createRole('superusario');

        $response = $this->actingAs($admin)->post(route('panel.users.store'), [
            'name' => 'Editor Uno',
            'email' => 'editor-uno@example.com',
            'password' => 'supersecret123',
            'password_confirmation' => 'supersecret123',
            'role_id' => $editorRole->id,
        ]);

        $response
            ->assertRedirect(route('panel.users.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'Editor Uno',
            'email' => 'editor-uno@example.com',
            'role_id' => $editorRole->id,
        ]);
    }

    public function test_non_admin_user_cannot_create_roles_or_users(): void
    {
        $editor = $this->createUserWithRole('superusario');
        $viewerRole = $this->createRole('diseño');

        $createRoleResponse = $this->actingAs($editor)->post(route('panel.roles.store'), [
            'name' => 'auditor',
        ]);

        $createRoleResponse->assertForbidden();

        $createUserResponse = $this->actingAs($editor)->post(route('panel.users.store'), [
            'name' => 'Sin Permiso',
            'email' => 'sin-permiso@example.com',
            'password' => 'supersecret123',
            'password_confirmation' => 'supersecret123',
            'role_id' => $viewerRole->id,
        ]);

        $createUserResponse->assertForbidden();

        $this->assertDatabaseMissing('roles', [
            'name' => 'auditor',
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => 'sin-permiso@example.com',
        ]);
    }

    private function createUserWithRole(string $roleName): User
    {
        $role = $this->createRole($roleName);

        return User::factory()->create([
            'role_id' => $role->id,
        ]);
    }

    private function createRole(string $name): Role
    {
        return Role::query()->firstOrCreate([
            'name' => $name,
        ]);
    }
}
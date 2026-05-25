<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PanelLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_opening_panel(): void
    {
        $response = $this->get(route('panel.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_login_screen_is_accessible(): void
    {
        $response = $this->get(route('login'));

        $response
            ->assertOk()
            ->assertSee('Acceso al panel', false);
    }

    public function test_user_can_log_in_and_access_panel(): void
    {
        $user = $this->createPanelUser();

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response
            ->assertRedirect(route('panel.dashboard'))
            ->assertSessionHasNoErrors();

        $this->assertAuthenticated();

        $this->get(route('panel.dashboard'))->assertOk();
    }

    public function test_user_can_log_out(): void
    {
        $user = $this->createPanelUser();

        $this->actingAs($user)->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    private function createPanelUser(): User
    {
        $role = Role::query()->firstOrCreate([
            'name' => 'administrador',
        ]);

        return User::factory()->create([
            'role_id' => $role->id,
            'email' => 'panel-admin@example.com',
        ]);
    }
}
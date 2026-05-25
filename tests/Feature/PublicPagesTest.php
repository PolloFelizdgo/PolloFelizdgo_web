<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_about_and_menu_pages_are_accessible(): void
    {
        $this->get(route('home'))->assertOk();
        $this->get(route('about'))->assertOk();
        $this->get(route('menu.full'))->assertOk();
    }

    public function test_home_contains_key_external_links_from_configuration(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee((string) config('external_links.billing.url'), false);
        $response->assertSee((string) config('external_links.social.facebook'), false);
        $response->assertSee((string) config('external_links.social.instagram'), false);
        $response->assertSee((string) config('external_links.contact.email'), false);
        $response->assertSee((string) config('external_links.contact.phone_display'), false);
    }

    public function test_health_endpoint_returns_operational_status(): void
    {
        $response = $this->get(route('health'));

        $response->assertOk();
        $response->assertJson([
            'status' => 'up',
        ]);
        $response->assertJsonStructure([
            'status',
            'app',
            'env',
            'timestamp',
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class VacancyBoardTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_board_page_is_accessible(): void
    {
        $response = $this->get(route('vacancies.index'));

        $response
            ->assertOk()
            ->assertSee('Bolsa de trabajo', false)
            ->assertSee('Vacantes disponibles en Pollo Feliz', false)
            ->assertDontSee('Subir nueva vacante', false)
            ->assertDontSee('Panel de publicacion', false)
            ->assertDontSee('Publicar vacante', false);
    }

    public function test_it_can_publish_a_vacancy(): void
    {
        $response = $this->post(route('vacancies.store'), [
            'title' => 'Cajero de sucursal',
            'department' => 'Operaciones',
            'location' => 'Durango Centro',
            'employment_type' => 'Tiempo completo',
            'schedule' => '09:00 AM - 06:00 PM',
            'salary' => '$11,000 mensuales',
            'summary' => 'Atencion al cliente, cobro y cierre de caja.',
            'requirements' => "Experiencia minima de 1 año\nManejo basico de caja",
            'vacancy_image' => UploadedFile::fake()->image('vacante.jpg'),
        ]);

        $response
            ->assertRedirect(route('vacancies.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('vacancies', [
            'title' => 'Cajero de sucursal',
            'department' => 'Operaciones',
            'location' => 'Durango Centro',
            'employment_type' => 'Tiempo completo',
            'is_active' => true,
        ]);

        $vacancy = Vacancy::where('title', 'Cajero de sucursal')->first();

        $this->assertNotNull($vacancy);
        $this->assertNotNull($vacancy->image_path);
        $this->assertFileExists(public_path($vacancy->image_path));

        if ($vacancy->image_path) {
            @unlink(public_path($vacancy->image_path));
        }
    }
}
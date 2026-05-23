<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VacancyController extends Controller
{
    public function index(): View
    {
        // Lista solo vacantes activas para la pagina publica.
        $vacancies = Vacancy::query()
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('vacancies.index', compact('vacancies'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Valida el formulario de alta de vacantes antes de guardarlo.
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'string', 'max:100'],
            'schedule' => ['nullable', 'string', 'max:100'],
            'salary' => ['nullable', 'string', 'max:100'],
            'summary' => ['required', 'string', 'max:2000'],
            'requirements' => ['nullable', 'string', 'max:4000'],
            'vacancy_image' => ['nullable', 'image', 'max:4096'],
        ], [
            'title.required' => 'Ingresa el nombre de la vacante.',
            'department.required' => 'Ingresa el area o departamento.',
            'location.required' => 'Ingresa la ubicacion de la vacante.',
            'employment_type.required' => 'Selecciona el tipo de empleo.',
            'summary.required' => 'Agrega una descripcion breve del puesto.',
            'vacancy_image.image' => 'La imagen debe ser un archivo valido.',
        ]);

        $imagePath = null;

        if ($request->hasFile('vacancy_image')) {
            // Guarda la imagen dentro de public/uploads/vacancies.
            $directory = public_path('uploads/vacancies');

            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $extension = $request->file('vacancy_image')->getClientOriginalExtension();
            $filename = Str::slug($validated['title']).'-'.Str::random(8).'.'.$extension;

            $request->file('vacancy_image')->move($directory, $filename);
            $imagePath = 'uploads/vacancies/'.$filename;
        }

        Vacancy::create([
            'title' => $validated['title'],
            'department' => $validated['department'],
            'location' => $validated['location'],
            'employment_type' => $validated['employment_type'],
            'schedule' => $validated['schedule'] ?? null,
            'salary' => $validated['salary'] ?? null,
            'summary' => $validated['summary'],
            'requirements' => $validated['requirements'] ?? null,
            'image_path' => $imagePath,
            'is_active' => true,
            'published_at' => now(),
        ]);

        // Regresa al listado con mensaje de exito.
        return redirect()
            ->route('vacancies.index')
            ->with('status', 'Vacante publicada correctamente.');
    }
}
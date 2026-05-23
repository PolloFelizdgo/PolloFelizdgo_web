<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

// Ruta principal de la portada.
Route::get('/', [HomeController::class, 'index'])->name('home');
// Pagina de menu completo.
Route::get('/menu', [HomeController::class, 'menu'])->name('menu.full');
// Pagina corporativa de historia, mision y vision.
Route::get('/acerca', [HomeController::class, 'about'])->name('about');
// Bolsa de trabajo publica.
Route::get('/bolsa-de-trabajo', [VacancyController::class, 'index'])->name('vacancies.index');
// Publicacion de vacantes.
Route::post('/bolsa-de-trabajo', [VacancyController::class, 'store'])->name('vacancies.store');
// Envio del formulario de contacto.
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');
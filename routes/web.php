<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu.full');
Route::get('/acerca', [HomeController::class, 'about'])->name('about');
Route::get('/bolsa-de-trabajo', [VacancyController::class, 'index'])->name('vacancies.index');
Route::post('/bolsa-de-trabajo', [VacancyController::class, 'store'])->name('vacancies.store');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');
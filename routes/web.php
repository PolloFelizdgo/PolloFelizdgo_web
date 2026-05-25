<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\PanelAuthController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\ContentController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\UserManagementController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

// Ruta principal de la portada.
Route::get('/', [HomeController::class, 'index'])->name('home');
// Pagina de menu completo.
Route::get('/menu', [HomeController::class, 'menu'])->name('menu.full');
// Pagina corporativa de historia, mision y vision.
Route::get('/acerca', [HomeController::class, 'about'])->name('about');
// Aviso de privacidad y tratamiento de datos personales.
Route::view('/aviso-de-privacidad', 'privacy')->name('privacy');
// Bolsa de trabajo publica.
Route::get('/bolsa-de-trabajo', [VacancyController::class, 'index'])->name('vacancies.index');
// Publicacion de vacantes.
Route::post('/bolsa-de-trabajo', [VacancyController::class, 'store'])->name('vacancies.store');
// Envio del formulario de contacto.
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');
// Endpoint de salud para monitoreo (deploy, uptime y validacion rapida).
Route::get('/health', HealthController::class)->name('health');

Route::middleware('guest')->group(function (): void {
	Route::get('/panel/login', [PanelAuthController::class, 'create'])->name('login');
	Route::post('/panel/login', [PanelAuthController::class, 'store'])->name('login.store');
});

Route::post('/logout', [PanelAuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('panel')
	->name('panel.')
	->middleware(['auth', 'panel.role:administrador,superusario,diseño'])
	->group(function (): void {
		Route::get('/', DashboardController::class)->name('dashboard');

		Route::middleware('panel.role:administrador')->group(function (): void {
			Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
			Route::post('/users', [UserManagementController::class, 'storeUser'])->name('users.store');
			Route::post('/users/{user}/role', [UserManagementController::class, 'updateUserRole'])->name('users.role.update');
			Route::post('/roles', [UserManagementController::class, 'storeRole'])->name('roles.store');
		});

		Route::post('/content/upload-image', [ContentController::class, 'uploadImage'])->name('content.upload-image');

		Route::get('/content/home', [ContentController::class, 'editHome'])->name('content.home.edit');
		Route::put('/content/home', [ContentController::class, 'updateHome'])->name('content.home.update');
		Route::post('/content/home/publish', [ContentController::class, 'publishHome'])->name('content.home.publish');
		Route::post('/content/home/revert', [ContentController::class, 'revertHome'])->name('content.home.revert');

		Route::get('/content/about', [ContentController::class, 'editAbout'])->name('content.about.edit');
		Route::put('/content/about', [ContentController::class, 'updateAbout'])->name('content.about.update');
		Route::post('/content/about/publish', [ContentController::class, 'publishAbout'])->name('content.about.publish');
		Route::post('/content/about/revert', [ContentController::class, 'revertAbout'])->name('content.about.revert');

		Route::get('/content/footer', [ContentController::class, 'editFooter'])->name('content.footer.edit');
		Route::put('/content/footer', [ContentController::class, 'updateFooter'])->name('content.footer.update');
		Route::post('/content/footer/publish', [ContentController::class, 'publishFooter'])->name('content.footer.publish');
		Route::post('/content/footer/revert', [ContentController::class, 'revertFooter'])->name('content.footer.revert');

		Route::get('/content/menu', [ContentController::class, 'editMenu'])->name('content.menu.edit');
		Route::put('/content/menu', [ContentController::class, 'updateMenu'])->name('content.menu.update');
		Route::post('/content/menu/publish', [ContentController::class, 'publishMenu'])->name('content.menu.publish');
		Route::post('/content/menu/revert', [ContentController::class, 'revertMenu'])->name('content.menu.revert');

		Route::get('/content/theme', [ContentController::class, 'editTheme'])->name('content.theme.edit');
		Route::put('/content/theme', [ContentController::class, 'updateTheme'])->name('content.theme.update');
		Route::post('/content/theme/publish', [ContentController::class, 'publishTheme'])->name('content.theme.publish');
		Route::post('/content/theme/revert', [ContentController::class, 'revertTheme'])->name('content.theme.revert');
		Route::post('/content/theme/presets', [ContentController::class, 'saveThemePreset'])->name('content.theme.presets.save');
		Route::post('/content/theme/presets/{slug}/delete', [ContentController::class, 'deleteThemePreset'])->name('content.theme.presets.delete');
		Route::post('/content/theme/schedule', [ContentController::class, 'scheduleThemePublish'])->name('content.theme.schedule');
		Route::post('/content/theme/schedule/cancel', [ContentController::class, 'cancelThemeScheduledPublish'])->name('content.theme.schedule.cancel');
	});
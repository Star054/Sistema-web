<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormularioSIGSAController;
use App\Http\Controllers\VacunaController;
use App\Http\Controllers\FormularioController5bA;
use App\Http\Controllers\FormularioController3CS;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaVacunasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para vacunas utilizando Route::resource
    Route::resource('vacunas', VacunaController::class)->only(['create', 'store', 'index']);
    Route::post('/formulario-sigsa', [FormularioSIGSAController::class, 'store'])->name('formulario-sigsa.store');

    // Rutas para el formulario FOR-SIGSA-5b utilizando Route::resource
    Route::resource('for-sigsa-5b', FormularioSIGSAController::class);

    // Rutas para el formulario FOR-SIGSA-5bA utilizando Route::resource
    Route::resource('for-sigsa-5bA', FormularioController5bA::class);

    // Rutas para el formulario FOR-SIGSA-3CS utilizando Route::resource

    Route::resource('formularios-3cs', FormularioController3CS::class);



// Ruta para mostrar el formulario de filtros
    Route::get('/filtros-vacunas', [ConsultaVacunasController::class, 'mostrarFiltros'])->name('vacunas.filtros');

// Ruta para procesar los filtros y mostrar los resultados de los pacientes vacunados
    Route::get('/resultados-vacunas', [ConsultaVacunasController::class, 'mostrarResultados'])->name('vacunas.resultados');

    // Vista de formulario exitoso
    Route::get('/formulario-exitoso', function () {
        return view('formulario-exitoso');
    })->name('formulario.exitoso');
});

require __DIR__.'/auth.php';

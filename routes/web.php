<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormularioSIGSAController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacunaController;
use App\Http\Controllers\FormularioController5bA;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\FormularioController3CS;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Rutas para vacunas utilizando Route::resource
    Route::resource('vacunas', VacunaController::class)->only(['create', 'store', 'index']);
    Route::post('/formulario-sigsa', [FormularioSIGSAController::class, 'store'])->name('formulario-sigsa.store');


    // Rutas para el formulario FOR-SIGSA-5b
    Route::get('/for-sigsa-5b', [FormularioSIGSAController::class, 'create'])->name('for-sigsa-5b.create');
    Route::post('/for-sigsa-5b', [FormularioSIGSAController::class, 'store'])->name('for-sigsa-5b.store');


    Route::get('/formulario-exitoso', function () {
        return view('formulario-exitoso'); // Nombre de la vista (blade)
    })->name('formulario.exitoso');

    Route::get('/for-sigsa-5bA', [FormularioController5bA::class, 'create'])->name('for-sigsa-5bA.create');
    Route::post('/for-sigsa-5bA', [FormularioController5bA::class, 'store'])->name('for-sigsa-5bA.store');

    Route::get('/for-sigsa-3cs', [FormularioController3CS::class, 'create'])->name('for-sigsa-3cs.create');
    Route::post('/for-sigsa-3cs', [FormularioController3CS::class, 'store'])->name('for-sigsa-3cs.store');


    Route::get('/consultas', [ConsultaController::class, 'create'])->name('consultas.create');  // Formulario de creación
    Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');    // Guardar la consulta

});

require __DIR__.'/auth.php';

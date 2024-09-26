<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormularioSIGSAController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacunaController;

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
    Route::resource('vacunas', VacunaController::class)->only(['create', 'store']);


    // Rutas para el formulario FOR-SIGSA-5b
    Route::get('/for-sigsa-5b', [FormularioSIGSAController::class, 'create'])->name('for-sigsa-5b.create');
    Route::post('/for-sigsa-5b', [FormularioSIGSAController::class, 'store'])->name('for-sigsa-5b.store');


    // Ejemplo de una ruta para otro formulario (form2)
    Route::get('/form2', [FormularioController::class, 'form2'])->name('form2');
});

require __DIR__.'/auth.php';

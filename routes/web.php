<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioSIGSAController;

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


//    route::get('/form1', [FormularioController::class, 'form1'])->name('form1');
    Route::get('/for-sigsa-5b', [FormularioSIGSAController::class, 'create'])->name('for-sigsa-5b');
    Route::post('/for-sigsa-5b', [FormularioSIGSAController::class, 'store'])->name('for-sigsa-5b.store');
    Route::get('/form2', [FormularioController::class, 'form2'])->name('form2');
});

require __DIR__.'/auth.php';

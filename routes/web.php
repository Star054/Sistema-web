<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormularioSIGSAController;
use App\Http\Controllers\VacunaController;
use App\Http\Controllers\FormularioController5bA;
use App\Http\Controllers\FormularioController3CS;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaVacunasController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFTestController;
use App\Http\Controllers\PDFController3CS;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/reglas5bA', function () {
    return view('reglas5bA'); // Asegúrate de que la vista '5bA.blade.php' esté en la carpeta 'Reglas'
})->middleware(['auth', 'verified'])->name('5bA');

Route::get('/reglas3CS', function () {
    return view('reglas3CS'); // Asegúrate de que la vista '3CS.blade.php' esté en la carpeta 'Reglas'
})->middleware(['auth', 'verified'])->name('3CS');

Route::get('/instructivo', function () {
    return view('instructivo'); // Asegúrate de que la vista '3CS.blade.php' esté en la carpeta 'Reglas'
})->middleware(['auth', 'verified'])->name('instructivo');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::resource('vacunas', VacunaController::class)->only(['create', 'store', 'index', 'edit', 'update', 'destroy']);

    Route::post('/formulario-sigsa', [FormularioSIGSAController::class, 'store'])->name('formulario-sigsa.store');

    Route::resource('for-sigsa-5b', FormularioSIGSAController::class);

    Route::resource('for-sigsa-5bA', FormularioController5bA::class);

    Route::resource('formularios-3cs', FormularioController3CS::class);


// Ruta para mostrar el formulario de filtros
    Route::get('/filtros-vacunas', [ConsultaVacunasController::class, 'mostrarFiltros'])->name('vacunas.filtros');
    Route::get('/resultados-vacunas', [ConsultaVacunasController::class, 'mostrarResultados'])->name('vacunas.resultados');

    Route::get('/busqueda-resultados', [ConsultaVacunasController::class, 'buscar'])->name('busqueda.resultados');

    Route::post('/generar-pdf-filtro', [ConsultaVacunasController::class, 'generarPDF'])->name('vacunas.generarPDF');


    Route::post('/generar-pdf-5b', [PDFController::class, 'generarPDF5b'])->name('pdf.generar5b');
    Route::post('/generar-pdf-5bA', [PDFController::class, 'generarPDF5bA'])->name('pdf.generar5bA');
    Route::post('pdf/3cs', [PDFController3CS::class, 'generarPDF3CS'])->name('generarPDF3CS');


    Route::get('/pdf-prueba', [PDFTestController::class, 'generarPDF']);

    // Vista de formulario exitoso
    Route::get('/formulario-exitoso', function () {
        return view('formulario-exitoso');
    })->name('formulario.exitoso');
});

require __DIR__.'/auth.php';

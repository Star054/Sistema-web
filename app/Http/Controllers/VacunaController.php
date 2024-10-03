<?php

namespace App\Http\Controllers;

use App\Models\Vacuna;
use Illuminate\Http\Request;

class VacunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Opcional: Mostrar una lista de todas las vacunas
        $vacunas = Vacuna::all();
        return view('vacunas.create', compact('vacunas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario de creación de vacunas
        return view('vacunas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Inicializamos un array para almacenar los errores
        $errors = [];

        // Validación para nombres que sean solo números
        if (preg_match('/^\d+$/', $request->nombre_vacuna)) {
            // Si el nombre de la vacuna es solo números
            $errors['nombre_vacuna'][] = 'Error: no se puede registrar solo números como nombre de vacuna.';
        }

        // Validación de unicidad manual
        if (Vacuna::where('nombre_vacuna', $request->nombre_vacuna)->exists()) {
            $errors['nombre_vacuna'][] = 'El nombre de la vacuna ya ha sido registrado.';
        }

        // Si hay errores, redirigir de vuelta con los errores
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Si no hay errores, guardar los datos en la base de datos
        Vacuna::create($request->only('nombre_vacuna', 'descripcion'));

        // Redirigir con un mensaje de éxito
        return redirect()->route('vacunas.create')->with('status', 'form-saved');
    }




    /**
     * Display the specified resource.
     */
    public function show(Vacuna $vacuna)
    {
        // Opcional: Mostrar detalles de una vacuna específica
        return view('vacunas.show', compact('vacuna'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacuna $vacuna)
    {
        // Opcional: Mostrar un formulario de edición para una vacuna específica
        return view('vacunas.edit', compact('vacuna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacuna $vacuna)
    {
        // Validar los datos actualizados del formulario
        $validated = $request->validate([
            'nombre_vacuna' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        // Actualizar los datos de la vacuna
        $vacuna->update($validated);

        // Redirigir a la vista de la vacuna o a la lista
        return redirect()->route('vacunas.index')->with('success', 'Vacuna actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacuna $vacuna)
    {
        // Eliminar la vacuna
        $vacuna->delete();

        // Redirigir a la lista de vacunas
        return redirect()->route('vacunas.index')->with('success', 'Vacuna eliminada exitosamente.');
    }
}

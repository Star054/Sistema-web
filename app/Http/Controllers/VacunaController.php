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
        return view('vacunas.index', compact('vacunas'));
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
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre_vacuna' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        // Guardar los datos validados en la base de datos
        Vacuna::create($validated);

        // Redirigir a una página de éxito o a la lista de vacunas
        return redirect()->route('vacunas.create')->with('success', 'Vacuna creada exitosamente.');
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

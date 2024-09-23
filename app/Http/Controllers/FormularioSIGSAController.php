<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormularioSIGSAController extends Controller
{
    public function create()
    {
        // Mostrar la vista del formulario
        return view('formulario-for-sigsa-5b');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'orden' => 'required|string|max:255',
            'nombre_paciente' => 'required|string|max:255',
            'cui' => 'required|string|max:13',
            'sexo' => 'required',
            'pueblo' => 'required|string|max:255',
            'comunidad_linguistica' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'discapacidad' => 'nullable|string|max:255',
            'orientacion_sexual' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255',
            'profesion_oficio' => 'nullable|string|max:255',
            'comunidad_direccion' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'agricola_migrante' => 'required|in:Sí,No',
            'embarazada' => 'required|in:Sí,No',
            'vacuna_1a' => 'nullable|date',
            'vacuna_2a' => 'nullable|date',
            'vacuna_3a' => 'nullable|date',
            'refuerzo_r1' => 'nullable|date',
            'refuerzo_r2' => 'nullable|date',
        ]);

        // Aquí podrías almacenar los datos en la base de datos

        return redirect()->back()->with('success', 'Formulario enviado correctamente.');
    }
}

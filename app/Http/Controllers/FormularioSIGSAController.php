<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormularioSIGSA5b;  // Modelo para la tabla principal del formulario
use App\Models\Residencia;         // Modelo para la tabla de residencia
use App\Models\Mujer15a49yOtrosGrupos; // Modelo para la tabla de mujer 15 a 49 años y otros grupos
use App\Models\Vacuna;  // Modelo para la tabla de vacunas

class FormularioSIGSAController extends Controller
{
    // Mostrar el formulario
    public function create()
    {
        // Obtener todas las vacunas para mostrarlas en el select
        $vacunas = Vacuna::all();

        // Retornar la vista del formulario, pasando las vacunas a la vista
        return view('formulario-for-sigsa-5b', compact('vacunas'));
    }

    // Almacenar los datos del formulario en la base de datos
    public function store(Request $request)
    {
        // Validar los datos que vienen desde el formulario
        $validated = $request->validate([
            'vacuna' => 'required|string|exists:vacunas,nombre_vacuna',  // Validar que la vacuna es requerida y existe en la tabla vacunas
            'nombre_paciente' => 'required|string',
            'codigo_formulario' => 'nullable|string',

            // Validaciones de los campos de la tabla principal
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',

            // Campos del paciente
            'no_orden' => 'nullable|integer',
            'cui' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|max:1',
            'pueblo' => 'nullable|string',
            'comunidad_linguistica' => 'nullable|string',
            'escolaridad' => 'nullable|string',
            'profesion_oficio' => 'nullable|string',

            // Campos de residencia
            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|boolean',
            'embarazada' => 'nullable|boolean',

            // Campos de mujer 15 a 49 años y otros grupos
            'vacuna_mujer_15_49_1a' => 'nullable|date',
            'vacuna_mujer_15_49_2a' => 'nullable|date',
            'vacuna_mujer_15_49_3a' => 'nullable|date',
            'vacuna_mujer_15_49_r1' => 'nullable|date',
            'vacuna_mujer_15_49_r2' => 'nullable|date',
            'vacuna_otros_grupos_1a' => 'nullable|date',
            'vacuna_otros_grupos_2a' => 'nullable|date',
            'vacuna_otros_grupos_3a' => 'nullable|date',
            'vacuna_otros_grupos_r1' => 'nullable|date',
            'vacuna_otros_grupos_r2' => 'nullable|date',
        ]);

        // Buscar el ID de la vacuna basada en su nombre
        $vacuna = Vacuna::where('nombre_vacuna', $validated['vacuna'])->firstOrFail();

        // Almacenar los datos en la tabla principal del formulario
        $formulario = FormularioSIGSA5b::create([
            'vacuna' => $vacuna->nombre_vacuna,  // Almacenar el nombre de la vacuna seleccionada
            'nombre_paciente' => $validated['nombre_paciente'],
            'codigo_formulario' => $validated['codigo_formulario'],
            'area_salud' => $validated['area_salud'],
            'distrito_salud' => $validated['distrito_salud'],
            'municipio' => $validated['municipio'],
            'servicio_salud' => $validated['servicio_salud'],
            'responsable_informacion' => $validated['responsable_informacion'],
            'cargo_responsable' => $validated['cargo_responsable'],
            'anio' => $validated['anio'],
        ]);

        // Almacenar los datos de la tabla de residencia
        $formulario->residencia()->create([
            'comunidad_direccion' => $validated['comunidad_direccion'],
            'municipio_residencia' => $validated['municipio_residencia'],
            'agricola_migrante' => $validated['agricola_migrante'],
            'embarazada' => $validated['embarazada'],
        ]);

        $formulario->mujer15a49yOtrosGrupos()->create([
            'vacuna_mujer_15_49_1a' => $validated['vacuna_mujer_15_49_1a'] ?? null,
            'vacuna_mujer_15_49_2a' => $validated['vacuna_mujer_15_49_2a'] ?? null,
            'vacuna_mujer_15_49_3a' => $validated['vacuna_mujer_15_49_3a'] ?? null,
            'vacuna_mujer_15_49_r1' => $validated['vacuna_mujer_15_49_r1'] ?? null,
            'vacuna_mujer_15_49_r2' => $validated['vacuna_mujer_15_49_r2'] ?? null,
            'vacuna_otros_grupos_1a' => $validated['vacuna_otros_grupos_1a'] ?? null,
            'vacuna_otros_grupos_2a' => $validated['vacuna_otros_grupos_2a'] ?? null,
            'vacuna_otros_grupos_3a' => $validated['vacuna_otros_grupos_3a'] ?? null,
            'vacuna_otros_grupos_r1' => $validated['vacuna_otros_grupos_r1'] ?? null,
            'vacuna_otros_grupos_r2' => $validated['vacuna_otros_grupos_r2'] ?? null,
        ]);

        // Redirigir a la misma página con un mensaje de éxito
        return redirect()->back()->with('status', 'Formulario guardado exitosamente');
    }
}

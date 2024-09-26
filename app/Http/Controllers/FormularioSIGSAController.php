<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormularioSIGSA5b;  // Modelo para la tabla principal del formulario
use App\Models\Residencia;         // Modelo para la tabla de residencia
use App\Models\Mujer15a49yOtrosGrupos; // Modelo para la tabla de mujer 15 a 49 años y otros grupos

class FormularioSIGSAController extends Controller
{
    // Mostrar el formulario
    public function create()
    {
        // Retorna la vista del formulario (el archivo blade para mostrar el formulario)
        return view('formulario-for-sigsa-5b'); // Cambia esto al nombre de la vista que corresponda
    }

    // Almacenar los datos del formulario en la base de datos
    public function store(Request $request)
    {
        // Validar los datos que vienen desde el formulario
        $validated = $request->validate([
            'vacuna' => 'required|string',
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
            'no_orden' => 'nullable|int',
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

        // Almacenar los datos en la tabla principal del formulario
        $formulario = FormularioSIGSA5b::create([
            'vacuna' => $validated['vacuna'],
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
        Residencia::create([
            'formulario_sigsa_5b_id' => $formulario->id, // Relación con el formulario
            'comunidad_direccion' => $validated['comunidad_direccion'],
            'municipio_residencia' => $validated['municipio_residencia'],
            'agricola_migrante' => $validated['agricola_migrante'],
            'embarazada' => $validated['embarazada'],
        ]);

        // Almacenar los datos de la tabla de mujer 15 a 49 años y otros grupos
        Mujer15a49yOtrosGrupos::create([
            'formulario_sigsa_5b_id' => $formulario->id, // Relación con el formulario
            'vacuna_mujer_15_49_1a' => $validated['vacuna_mujer_15_49_1a'],
            'vacuna_mujer_15_49_2a' => $validated['vacuna_mujer_15_49_2a'],
            'vacuna_mujer_15_49_3a' => $validated['vacuna_mujer_15_49_3a'],
            'vacuna_mujer_15_49_r1' => $validated['vacuna_mujer_15_49_r1'],
            'vacuna_mujer_15_49_r2' => $validated['vacuna_mujer_15_49_r2'],
            'vacuna_otros_grupos_1a' => $validated['vacuna_otros_grupos_1a'],
            'vacuna_otros_grupos_2a' => $validated['vacuna_otros_grupos_2a'],
            'vacuna_otros_grupos_3a' => $validated['vacuna_otros_grupos_3a'],
            'vacuna_otros_grupos_r1' => $validated['vacuna_otros_grupos_r1'],
            'vacuna_otros_grupos_r2' => $validated['vacuna_otros_grupos_r2'],
        ]);

        // Redirigir a la misma página con un mensaje de éxito
        return redirect()->back()->with('status', 'Formulario guardado exitosamente');
    }
}

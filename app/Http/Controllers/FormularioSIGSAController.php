<?php

namespace App\Http\Controllers;

use App\Models\FormularioSIGSA5b;
use Illuminate\Http\Request;
use App\Models\Residencia;         // Modelo para la tabla de residencia
use App\Models\Mujer15a49yOtrosGrupos; // Modelo para la tabla de mujer 15 a 49 años y otros grupos
use App\Models\Vacuna;  // Modelo para la tabla de vacunas
use App\Models\TipoFormulario;  // Modelo para la tabla de tipos de formularios

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
            'codigo_formulario' => 'required|string', // Validar que el código de formulario es requerido

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
            'cui' => 'nullable|string|unique:formulario_sigsa_base,cui',  // Evitar duplicados de CUI
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

//        ], [
//            // Aquí van los mensajes personalizados
//            'vacuna.required' => 'La selección de la vacuna es obligatoria.',
//            'vacuna.exists' => 'La vacuna seleccionada no existe.',
//            'nombre_paciente.required' => 'El nombre del paciente es obligatorio.',
//            'codigo_formulario.required' => 'El código del formulario es obligatorio.',
//            'cui.unique' => 'El CUI ya ha sido registrado.',
//            // Agrega más mensajes personalizados según tus campos y reglas...
        ]);



        // Verificar si el paciente ya está registrado usando el CUI
        $pacienteExistente = FormularioSIGSA5b::where('cui', $validated['cui'])->first();

        if ($pacienteExistente) {
            return redirect()->back()->with('error', 'Este paciente ya está registrado con el CUI proporcionado.');
        }

        // Buscar el tipo de formulario 'FOR-SIGSA-5b' o crearlo si no existe
        $tipoFormulario = TipoFormulario::firstOrCreate([
            'codigo_formulario' => $validated['codigo_formulario'],
        ]);

        // Buscar el ID de la vacuna basada en su nombre
        $vacuna = Vacuna::where('nombre_vacuna', $validated['vacuna'])->firstOrFail();



        // Almacenar los datos en la tabla principal del formulario
        $formulario = FormularioSIGSA5b::create([
            'vacuna' => $vacuna->nombre_vacuna,  // Almacenar el nombre de la vacuna seleccionada
            'codigo_formulario' => $validated['codigo_formulario'],
            'area_salud' => $validated['area_salud'],
            'distrito_salud' => $validated['distrito_salud'],
            'municipio' => $validated['municipio'],
            'servicio_salud' => $validated['servicio_salud'],
            'responsable_informacion' => $validated['responsable_informacion'],
            'cargo_responsable' => $validated['cargo_responsable'],
            'anio' => $validated['anio'],
            'no_orden' => $validated['no_orden'] ?? null,
            'cui' => $validated['cui'] ?? null,
            'nombre_paciente' => $validated['nombre_paciente'],
            'sexo' => $validated['sexo'] ?? null,
            'pueblo' => $validated['pueblo'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? null,
            'escolaridad' => $validated['escolaridad'] ?? null,
            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
        ]);

        // Guardar la relación en la tabla pivote
        $formulario->tiposFormulario()->attach($tipoFormulario->id);

        // Almacenar los datos de la tabla de residencia
        $formulario->residencia()->create([
            'comunidad_direccion' => $validated['comunidad_direccion'],
            'municipio_residencia' => $validated['municipio_residencia'],
            'agricola_migrante' => $validated['agricola_migrante'],
            'embarazada' => $validated['embarazada'],
        ]);

        // Almacenar los datos de la tabla de mujer 15 a 49 años y otros grupos
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

        // Redirigir a una ruta específica para evitar el doble envío
        return redirect()->route('formulario.exitoso')->with('status', 'Formulario guardado exitosamente');


    }
}

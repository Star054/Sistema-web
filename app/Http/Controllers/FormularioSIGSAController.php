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
    // Mostrar la lista de formularios (index)
    public function index()
    {
        $formularios = FormularioSIGSA5b::all(); // Obtener todos los registros
        return view('formularios.crud5b.index', compact('formularios')); // Devolver a la vista
    }

    // Mostrar un formulario específico (show)
    public function show($id)
    {
        $formulario = FormularioSIGSA5b::findOrFail($id);
        return view('formularios.crud5b.show', compact('formulario')); // Devolver a la vista
    }

    // Editar un formulario existente (edit)
    public function edit($id)
    {
        $formulario = FormularioSIGSA5b::findOrFail($id);  // Buscar el formulario por ID
        $vacunas = Vacuna::all();  // Obtener todas las vacunas para el select

        // Pasar los datos del formulario y las vacunas a la vista
        return view('formularios.crud5b.edit', compact('formulario', 'vacunas'));
    }

    // Actualizar un formulario existente (update)
    public function update(Request $request, $id)
    {
        // Validar los campos para evitar datos incorrectos
        $validated = $request->validate([
            // Campos de la tabla principal
            'vacuna' => 'nullable|string',
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',
            'no_orden' => 'nullable|integer',
            'cui' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|max:1',
            'pueblo' => 'nullable|string',
            'comunidad_linguistica' => 'nullable|string',
            'escolaridad' => 'nullable|string',
            'profesion_oficio' => 'nullable|string',
            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|boolean',
            'embarazada' => 'nullable|boolean',

            // Validaciones para los campos de vacunación
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

        // Buscar el formulario en la tabla principal
        $formulario = FormularioSIGSA5b::findOrFail($id);

        // Actualizar los datos de la tabla principal (formulario_sigsa_base)
        $formulario->update([
            'vacuna' => $validated['vacuna'] ?? $formulario->vacuna,
            'area_salud' => $validated['area_salud'] ?? $formulario->area_salud,
            'distrito_salud' => $validated['distrito_salud'] ?? $formulario->distrito_salud,
            'municipio' => $validated['municipio'] ?? $formulario->municipio,
            'servicio_salud' => $validated['servicio_salud'] ?? $formulario->servicio_salud,
            'responsable_informacion' => $validated['responsable_informacion'] ?? $formulario->responsable_informacion,
            'cargo_responsable' => $validated['cargo_responsable'] ?? $formulario->cargo_responsable,
            'anio' => $validated['anio'] ?? $formulario->anio,
            'no_orden' => $validated['no_orden'] ?? $formulario->no_orden,
            'cui' => $validated['cui'] ?? $formulario->cui,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? $formulario->fecha_nacimiento,
            'sexo' => $validated['sexo'] ?? $formulario->sexo,
            'pueblo' => $validated['pueblo'] ?? $formulario->pueblo,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? $formulario->comunidad_linguistica,
            'escolaridad' => $validated['escolaridad'] ?? $formulario->escolaridad,
            'profesion_oficio' => $validated['profesion_oficio'] ?? $formulario->profesion_oficio,
        ]);

        // Actualizar o crear los datos de la tabla `residencia`
        $residencia = $formulario->residencia;

        if ($residencia) {
            // Si ya existe, actualizar los datos de residencia
            $residencia->update([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? $residencia->comunidad_direccion,
                'municipio_residencia' => $validated['municipio_residencia'] ?? $residencia->municipio_residencia,
                'agricola_migrante' => $validated['agricola_migrante'] ?? $residencia->agricola_migrante,
                'embarazada' => $validated['embarazada'] ?? $residencia->embarazada,
            ]);
        } else {
            // Si no existe, crear un nuevo registro en `residencia`
            $formulario->residencia()->create([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
                'municipio_residencia' => $validated['municipio_residencia'] ?? null,
                'agricola_migrante' => $validated['agricola_migrante'] ?? null,
                'embarazada' => $validated['embarazada'] ?? null,
            ]);
        }

        // Verificar si existe la relación con `mujer15a49y_otros_grupos`
        $mujerGrupos = $formulario->mujer15a49yOtrosGrupos;

        if ($mujerGrupos) {
            // Actualizar los datos de la tabla `mujer15a49y_otros_grupos`
            $mujerGrupos->update([
                'vacuna_mujer_15_49_1a' => $validated['vacuna_mujer_15_49_1a'] ?? $mujerGrupos->vacuna_mujer_15_49_1a,
                'vacuna_mujer_15_49_2a' => $validated['vacuna_mujer_15_49_2a'] ?? $mujerGrupos->vacuna_mujer_15_49_2a,
                'vacuna_mujer_15_49_3a' => $validated['vacuna_mujer_15_49_3a'] ?? $mujerGrupos->vacuna_mujer_15_49_3a,
                'vacuna_mujer_15_49_r1' => $validated['vacuna_mujer_15_49_r1'] ?? $mujerGrupos->vacuna_mujer_15_49_r1,
                'vacuna_mujer_15_49_r2' => $validated['vacuna_mujer_15_49_r2'] ?? $mujerGrupos->vacuna_mujer_15_49_r2,
                'vacuna_otros_grupos_1a' => $validated['vacuna_otros_grupos_1a'] ?? $mujerGrupos->vacuna_otros_grupos_1a,
                'vacuna_otros_grupos_2a' => $validated['vacuna_otros_grupos_2a'] ?? $mujerGrupos->vacuna_otros_grupos_2a,
                'vacuna_otros_grupos_3a' => $validated['vacuna_otros_grupos_3a'] ?? $mujerGrupos->vacuna_otros_grupos_3a,
                'vacuna_otros_grupos_r1' => $validated['vacuna_otros_grupos_r1'] ?? $mujerGrupos->vacuna_otros_grupos_r1,
                'vacuna_otros_grupos_r2' => $validated['vacuna_otros_grupos_r2'] ?? $mujerGrupos->vacuna_otros_grupos_r2,
            ]);
        } else {
            // Si no existe, crear un nuevo registro relacionado
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
                'formulario_base_id' => $formulario->id,
            ]);
        }

        // Redirigir con mensaje de éxito
        return redirect()->route('for-sigsa-5b.index')->with('success', 'Formulario actualizado correctamente');
    }





    // Eliminar un formulario existente (destroy)
    public function destroy($id)
    {
        $formulario = FormularioSIGSA5b::findOrFail($id);
        $formulario->delete(); // Eliminar el registro
        return redirect()->route('for-sigsa-5b.index')->with('success', 'Formulario eliminado correctamente');
    }

    // Crear un nuevo formulario (create)
    public function create()
    {
        // Obtener todas las vacunas para mostrarlas en el select
        $vacunas = Vacuna::all();
        // Retornar la vista del formulario, pasando las vacunas a la vista
        return view('formularios.formulario-for-sigsa-5b', compact('vacunas'));
    }

    // Almacenar los datos del formulario en la base de datos (store)
    public function store(Request $request)
    {
        // Validar los datos que vienen desde el formulario
        $validated = $request->validate([
            'vacuna' => 'required|string|exists:vacunas,nombre_vacuna',
            'nombre_paciente' => 'required|string',
            'codigo_formulario' => 'required|string',
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',
            'no_orden' => 'nullable|integer',
            'cui' => 'nullable|string|unique:formulario_sigsa_base,cui',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|max:1',
            'pueblo' => 'nullable|string',
            'comunidad_linguistica' => 'nullable|string',
            'escolaridad' => 'nullable|string',
            'profesion_oficio' => 'nullable|string',
            'dia_consulta' => 'nullable|date',
            'no_historia_clinica' => 'nullable|string',
            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|boolean',
            'embarazada' => 'nullable|boolean',
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

        // Verificar si el paciente ya está registrado usando el CUI
        $pacienteExistente = FormularioSIGSA5b::where('cui', $validated['cui'])->first();

        if ($pacienteExistente) {
            return redirect()->back()->with('error', 'Este paciente ya está registrado con el CUI proporcionado.');
        }

        // Guardar el tipo de formulario en la tabla `tipo_formularios`
        $tipoFormulario = TipoFormulario::firstOrCreate([
            'codigo_formulario' => $validated['codigo_formulario'],
        ]);

        // Buscar el ID de la vacuna basada en su nombre
        $vacuna = Vacuna::where('nombre_vacuna', $validated['vacuna'])->firstOrFail();

        // Almacenar los datos en la tabla principal del formulario
        $formulario = FormularioSIGSA5b::create([
            'vacuna' => $vacuna->nombre_vacuna,
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
            'dia_consulta' => $validated['dia_consulta'] ?? null,
            'no_historia_clinica' => $validated['no_historia_clinica'] ?? null,
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

<?php

namespace App\Http\Controllers;

use App\Models\FormularioSIGSA5b;
use App\Models\TipoFormulario;
use App\Models\Consulta;  // Agregamos el modelo Consulta
use Illuminate\Http\Request;
use App\Models\Residencia;

class FormularioController3CS extends Controller
{
    // Mostrar el formulario FOR-SIGSA-3CS (incluyendo la consulta)
    public function create()
    {
        return view('formularios.3CS');  // Mostrar la vista para el formulario FOR-SIGSA-3CS
    }

    public function store(Request $request)
    {
        // Validar los datos generales del formulario y la consulta
        $validated = $request->validate([
            'codigo_formulario' => 'required|string',
            'nombre_paciente' => 'required|string|max:255',
            'cui' => 'required|string|max:13|unique:formulario_sigsa_base,cui',
            'sexo' => 'required|string|max:1',

            'dia_consulta' => 'required|date',
            'no_historia_clinica' => 'required|string|max:255',

            'area_salud' => 'nullable|string|max:255',
            'distrito_salud' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'servicio_salud' => 'nullable|string|max:255',
            'responsable_informacion' => 'nullable|string|max:255',
            'cargo_responsable' => 'nullable|string|max:255',
            'anio' => 'nullable|integer|between:2000,2030',
            'no_orden' => 'nullable|integer',
            'pueblo' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'comunidad_linguistica' => 'nullable|string|max:255',
            'orientacion_sexual' => 'nullable|string|max:255',
            'escolaridad' => 'nullable|string|max:255',
            'profesion_oficio' => 'nullable|string|max:255',


            // Campos de residencia
            'comunidad_direccion' => 'required|string',
            'municipio_residencia' => 'required|string',
            'agricola_migrante' => 'nullable|boolean',



            // Otros campos relacionados con la consulta
            'consulta' => 'nullable|string',
            'control' => 'nullable|string',
            'semana_gestacion' => 'nullable|integer',
            'referido_a' => 'nullable|string|max:255',
            'diagnostico' => 'nullable|string',
            'codigo_cie' => 'nullable|string|max:255',
            'tratamiento_descripcion' => 'nullable|string',
            'tratamiento_presentacion' => 'nullable|string|max:255',
            'cantidad_recetada' => 'nullable|integer',
            'notificacion_lugar' => 'nullable|string|max:255',
            'notificacion_numero' => 'nullable|string|max:255',
            'nombre_acompanante' => 'nullable|string|max:255',
        ]);

        // Guardar el tipo de formulario en la tabla `tipo_formularios`
        $tipoFormulario = TipoFormulario::firstOrCreate([
            'codigo_formulario' => $validated['codigo_formulario'],
        ]);

        // Guardar los datos generales del formulario en `formulario_sigsa_base`
        $formulario = FormularioSIGSA5b::create([
            'nombre_paciente' => $validated['nombre_paciente'],
            'cui' => $validated['cui'],
            'sexo' => $validated['sexo'],
            'dia_consulta' => $validated['dia_consulta'],
            'no_historia_clinica' => $validated['no_historia_clinica'],
            'area_salud' => $validated['area_salud'] ?? null,
            'distrito_salud' => $validated['distrito_salud'] ?? null,
            'municipio' => $validated['municipio'] ?? null,
            'servicio_salud' => $validated['servicio_salud'] ?? null,
            'responsable_informacion' => $validated['responsable_informacion'] ?? null,
            'cargo_responsable' => $validated['cargo_responsable'] ?? null,
            'anio' => $validated['anio'] ?? null,
            'no_orden' => $validated['no_orden'] ?? null,
            'pueblo' => $validated['pueblo'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? null,
            'orientacion_sexual' => $validated['orientacion_sexual'] ?? null,
            'escolaridad' => $validated['escolaridad'] ?? null,
            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
        ]);

        // Establecer la relación en la tabla pivote con `tipo_formulario`
        $formulario->tiposFormulario()->attach($tipoFormulario->id);

        $formulario->residencia()->create([
            'comunidad_direccion' => $validated['comunidad_direccion'],
            'municipio_residencia' => $validated['municipio_residencia'],
            'agricola_migrante' => $validated['agricola_migrante'] ?? null,
            'formulario_base_id' => $formulario->id,  // Relacionar con el formulario correctamente
        ]);


        // Guardar los datos de la tabla `consulta`
        Consulta::create([
            'formulario_base_id' => $formulario->id,  // Relación con la tabla principal
            'consulta' => $validated['consulta'] ?? null,
            'control' => $validated['control'] ?? null,
            'semana_gestacion' => $validated['semana_gestacion'] ?? null,
            'referido_a' => $validated['referido_a'] ?? null,
            'diagnostico' => $validated['diagnostico'] ?? null,
            'codigo_cie' => $validated['codigo_cie'] ?? null,
            'tratamiento_descripcion' => $validated['tratamiento_descripcion'] ?? null,
            'tratamiento_presentacion' => $validated['tratamiento_presentacion'] ?? null,
            'cantidad_recetada' => $validated['cantidad_recetada'] ?? null,
            'notificacion_lugar' => $validated['notificacion_lugar'] ?? null,
            'notificacion_numero' => $validated['notificacion_numero'] ?? null,
            'nombre_acompanante' => $validated['nombre_acompanante'] ?? null,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('for-sigsa-3cs.create')->with('status', 'Formulario y consulta guardados correctamente.');
    }
}

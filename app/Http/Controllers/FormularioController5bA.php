<?php


namespace App\Http\Controllers;

use App\Models\FormularioSIGSA5b;
use App\Models\Residencia;
use Illuminate\Http\Request;
use App\Models\Modelo5bA;
use App\Models\CriteriosVacuna;
use App\Models\Vacuna;
use App\Models\TipoFormulario;

class FormularioController5bA extends Controller
{
    public function create()
    {
        // Obtener todas las vacunas de la base de datos
        $vacunas = Vacuna::all();
        return view('formularios.5bA', compact('vacunas'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'codigo_formulario' => 'required|string',
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'required|string',
            'no_orden' => 'nullable|integer',
            'nombre_paciente' => 'required|string|max:255',
            'cui' => 'required|string|max:13|unique:formulario_sigsa_base,cui',
            'sexo' => 'nullable|string|max:1',
            'pueblo' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
            'comunidad_linguistica' => 'nullable|string',
            'orientacion_sexual' => 'nullable|string',
            'escolaridad' => 'nullable|string',
            'profesion_oficio' => 'nullable|string',
            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|boolean',
            'embarazada' => 'nullable|boolean',
            'vacuna' => 'required|string',
            'grupo_priorizado' => 'required|string',
            'fecha_administracion' => 'required|date',
            'dosis' => 'required|numeric|min:0',
        ]);

        // Guardar el tipo de formulario en la tabla `tipo_formularios`
        $tipoFormulario = TipoFormulario::firstOrCreate([
            'codigo_formulario' => $validated['codigo_formulario'],
        ]);

        // Guardar los datos generales del formulario en `formulario_sigsa_base`
        $formulario = Modelo5bA::create([
            'area_salud' => $validated['area_salud'] ?? null,
            'distrito_salud' => $validated['distrito_salud'] ?? null,
            'municipio' => $validated['municipio'] ?? null,
            'servicio_salud' => $validated['servicio_salud'] ?? null,
            'responsable_informacion' => $validated['responsable_informacion'] ?? null,
            'cargo_responsable' => $validated['cargo_responsable'] ?? null,
            'anio' => $validated['anio'],
            'no_orden' => $validated['no_orden'] ?? null,
            'nombre_paciente' => $validated['nombre_paciente'],
            'cui' => $validated['cui'],
            'sexo' => $validated['sexo'] ?? null,
            'pueblo' => $validated['pueblo'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? null,
            'orientacion_sexual' => $validated['orientacion_sexual'] ?? null,
            'escolaridad' => $validated['escolaridad'] ?? null,
            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
        ]);

        // Guardar la relación en `formulario_sigsa_tipo_formulario` (tabla pivote)
        $formulario->tipoFormularios()->attach($tipoFormulario->id);



        // Guardar los datos de Residencia
        $formulario->residencia()->create([
            'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
            'municipio_residencia' => $validated['municipio_residencia'] ?? null,
            'agricola_migrante' => $validated['agricola_migrante'] ?? null,
            'embarazada' => $validated['embarazada'] ?? null,
            'formulario_base_id' => $formulario->id,  // Relacionar con el formulario correctamente
        ]);

        // Guardar los criterios de selección en `criterios_vacuna`
        CriteriosVacuna::create([
            'formulario_sigsa_base_id' => $formulario->id,
            'nombre_vacuna' => $validated['vacuna'],
            'grupo_priorizado' => $validated['grupo_priorizado'],
            'fecha_administracion' => $validated['fecha_administracion'],
            'dosis' => $validated['dosis'],
        ]);

        // Redirigir a la vista de creación con un mensaje de éxito
        return redirect()->route('for-sigsa-5bA.create')->with('status', 'Formulario guardado correctamente.');
    }
}

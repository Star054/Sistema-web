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
    public function index()
    {
        // Obtener los formularios que corresponden al código FOR-SIGSA-5bA
        $formularios = Modelo5bA::whereHas('tipoFormularios', function ($query) {
            $query->where('codigo_formulario', 'FOR-SIGSA-5bA');
        })->get();

        return view('formularios.crud5bA.index', compact('formularios'));
    }


    public function show($id)
    {
        // Buscar el formulario 5bA por ID
        $formulario = Modelo5bA::findOrFail($id);

        // Devolver la vista, pasando el formulario a la vista de show para 5bA
        return view('formularios.crud5bA.show', compact('formulario'));
    }


    public function edit($id)
    {
        $formulario = Modelo5bA::findOrFail($id);
        $vacunas = Vacuna::all(); // Obtener todas las vacunas para el select

        // Asegúrate de que pasas 'formulario' y no 'consulta'
        return view('formularios.crud5bA.edit', compact('formulario', 'vacunas'));
    }



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
            'vacuna_id' => 'required|exists:vacunas,id',
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
            'formulario_sigsa_base_id' => $formulario->id,  // Relacionar con el formulario
            'vacuna_id' => $validated['vacuna_id'],
            'grupo_priorizado' => $validated['grupo_priorizado'],
            'fecha_administracion' => $validated['fecha_administracion'],
            'dosis' => $validated['dosis'],
        ]);


        // Redirigir a la vista de creación con un mensaje de éxito
        return redirect()->route('for-sigsa-5bA.create')->with('status', 'Formulario guardado correctamente.');
    }

    // Método para actualizar el formulario
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'required|string',
            'no_orden' => 'nullable|integer',
            'nombre_paciente' => 'required|string|max:255',
            'cui' => 'required|string|max:13',
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

        // Buscar el formulario por ID
        $formulario = Modelo5bA::findOrFail($id);

        // Actualizar los datos generales del formulario en `formulario_sigsa_base`
        $formulario->update([
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

        // Actualizar los datos de Residencia si ya existen
        if ($formulario->residencia) {
            $formulario->residencia->update([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
                'municipio_residencia' => $validated['municipio_residencia'] ?? null,
                'agricola_migrante' => $validated['agricola_migrante'] ?? null,
                'embarazada' => $validated['embarazada'] ?? null,
            ]);
        } else {
            // Crear los datos de residencia si no existen
            $formulario->residencia()->create([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
                'municipio_residencia' => $validated['municipio_residencia'] ?? null,
                'agricola_migrante' => $validated['agricola_migrante'] ?? null,
                'embarazada' => $validated['embarazada'] ?? null,
            ]);
        }

        // Actualizar o crear los criterios de selección en `criterios_vacuna`
        $criteriosVacuna = $formulario->criteriosVacuna->first(); // Obtener el primer registro relacionado

        if ($criteriosVacuna) {
            $criteriosVacuna->update([
                'nombre_vacuna' => $validated['vacuna'],
                'grupo_priorizado' => $validated['grupo_priorizado'],
                'fecha_administracion' => $validated['fecha_administracion'],
                'dosis' => $validated['dosis'],
            ]);
        } else {
            // Si no existe el registro en `criterios_vacuna`, crear uno nuevo
            CriteriosVacuna::create([
                'formulario_sigsa_base_id' => $formulario->id,
                'nombre_vacuna' => $validated['vacuna'],
                'grupo_priorizado' => $validated['grupo_priorizado'],
                'fecha_administracion' => $validated['fecha_administracion'],
                'dosis' => $validated['dosis'],
            ]);
        }

        // Redirigir con mensaje de éxito
        return redirect()->route('for-sigsa-5bA.index')->with('success', 'Formulario actualizado correctamente.');
    }


    // Método para eliminar un formulario
    public function destroy($id)
    {
        // Buscar el formulario por ID y eliminarlo junto con sus relaciones en cascada
        $formulario = Modelo5bA::findOrFail($id);
        $formulario->delete();

        return redirect()->route('for-sigsa-5bA.index')->with('success', 'Formulario eliminado correctamente.');
    }

}

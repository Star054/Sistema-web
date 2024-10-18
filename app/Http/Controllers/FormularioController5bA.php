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
        $formulario = Modelo5bA::with('criteriosVacuna')->findOrFail($id);
        $vacunas = Vacuna::all(); // Obtener todas las vacunas para el select

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
            'nombre_paciente' => 'required|string|max:150',
            'fecha_nacimiento' => 'nullable|date',
            'cui' => 'nullable|string',
            'sexo' => 'nullable|string|in:M,F', // Es requerido porque es clave para los datos
            'pueblo' => 'nullable|integer|in:1,2,3,4,5,6', // También es requerido en la actualización
            'comunidad_linguistica' => 'nullable|integer|in:1,2,3,...,23', // Opcional
            'escolaridad' => 'nullable|integer|in:0,1,2,3,4,5,6,7', // Opcional
            'profesion_oficio' => 'nullable|in:0,1,2,3,4,5,6,7,8',
            'discapacidad' => 'nullable|integer|in:0,1,2,3,4,5', // Opcional
            'orientacion_sexual' => 'nullable|integer|in:0,1,2,3,4,5', // Opcional
            'comunidad_direccion' => 'nullable|string', // Opcional
            'municipio_residencia' => 'nullable|string', // Opcional
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',

            'vacuna' => 'required|exists:vacunas,nombre_vacuna',
            'grupo_priorizado' => 'required|string',
            'fecha_administracion' => 'required|date',
            'dosis' => 'required|String',

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
            'escolaridad' => $validated['escolaridad'] !== '' ? $validated['escolaridad'] : null,

            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
            'discapacidad' => $validated['discapacidad'] ?? null,

            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',
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


        CriteriosVacuna::create([

            'formulario_sigsa_base_id' => $formulario->id,
            'vacuna' => $validated['vacuna'],  // Incluir 'vacuna' en la creación
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
            'no_orden' => 'nullable|integer',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'required|string',
            'nombre_paciente' => 'required|string|max:255',
            'cui' => 'nullable|string|max:13',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|in:M,F', // Es requerido porque es clave para los datos
            'pueblo' => 'nullable|integer|in:1,2,3,4,5,6', // También es requerido en la actualización
            'comunidad_linguistica' => 'nullable|integer|in:1,2,3,...,23', // Opcional
            'escolaridad' => 'nullable|integer|in:0,1,2,3,4,5,6,7', // Opcional
            'profesion_oficio' => 'nullable|in:0,1,2,3,4,5,6,7,8',
            'discapacidad' => 'nullable|integer|in:0,1,2,3,4,5', // Opcional
            'orientacion_sexual' => 'nullable|integer|in:0,1,2,3,4,5', // Opcional
            'comunidad_direccion' => 'nullable|string', // Opcional
            'municipio_residencia' => 'nullable|string', // Opcional
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',

            'vacuna' => 'required|exists:vacunas,nombre_vacuna',
            'grupo_priorizado' => 'required|string',
            'fecha_administracion' => 'required|date',
            'dosis' => 'required|String',
        ]);


        // Actualizar los datos generales del formulario
        $formulario = Modelo5bA::findOrFail($id);
        $formulario->update([
            'area_salud' => $validated['area_salud'] ?? null,
            'distrito_salud' => $validated['distrito_salud'] ?? null,
            'municipio' => $validated['municipio'] ?? null,
            'no_orden' => $validated['no_orden'] ?? null,
            'servicio_salud' => $validated['servicio_salud'] ?? null,
            'responsable_informacion' => $validated['responsable_informacion'] ?? null,
            'cargo_responsable' => $validated['cargo_responsable'] ?? null,
            'anio' => $validated['anio'],
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
        if ($formulario->residencia) {
            $formulario->residencia->update([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
                'municipio_residencia' => $validated['municipio_residencia'] ?? null,
                'agricola_migrante' => $validated['agricola_migrante'],
                'embarazada' => $validated['embarazada'],
            ]);
        } else {
            // Crear los datos de residencia si no existen
            $formulario->residencia()->create([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
                'municipio_residencia' => $validated['municipio_residencia'] ?? null,
                'agricola_migrante' => $validated['agricola_migrante'],
                'embarazada' => $validated['embarazada'],
            ]);
        }


        $criteriosVacuna = $formulario->criteriosVacuna->first();
        if ($criteriosVacuna) {
            $criteriosVacuna->update([
                'vacuna' => $validated['vacuna'],  // Asegúrate de incluir 'vacuna'
                'grupo_priorizado' => $validated['grupo_priorizado'],
                'fecha_administracion' => $validated['fecha_administracion'],
                'dosis' => $validated['dosis'],
            ]);
        } else {
            CriteriosVacuna::create([
                'formulario_sigsa_base_id' => $formulario->id,
                'vacuna' => $validated['vacuna'],  // Incluir 'vacuna' en la creación
                'grupo_priorizado' => $validated['grupo_priorizado'],
                'fecha_administracion' => $validated['fecha_administracion'],
                'dosis' => $validated['dosis'],

            ]);
        }

        $buscar = $request->input('buscar');
        if ($buscar) {
            return redirect()->route('busqueda.resultados', ['buscar' => $buscar])
                ->with('success', 'Formulario actualizado correctamente.');
        }


// Redirigir al índice con mensaje de éxito
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

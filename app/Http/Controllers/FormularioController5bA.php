<?php

namespace App\Http\Controllers;

use App\Models\FormularioSIGSA5b;
use Illuminate\Http\Request;
use App\Models\Modelo5bA;
use App\Models\CriteriosVacuna;
use App\Models\Vacuna;
use App\Models\TipoFormulario;

class FormularioController5bA extends Controller
{
    // Método para mostrar el formulario FOR-SIGSA-5bA
    public function create()
    {
        // Obtener todas las vacunas de la base de datos
        $vacunas = Vacuna::all();

        // Pasar las vacunas a la vista principal
        return view('formularios.5bA', compact('vacunas'));
    }

    // Método para almacenar los datos del formulario FOR-SIGSA-5bA


    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'codigo_formulario' => 'required|string',
            'nombre_paciente' => 'required|string|max:255',
            'cui' => 'required|string|max:13|unique:formulario_sigsa_base,cui', // Verificar que el CUI sea único en la tabla base
            'grupo_priorizado' => 'required|string',
            'fecha_administracion' => 'required|date',
            'dosis' => 'required|numeric|min:0',
            'vacuna' => 'required|string', // Validar el campo de vacuna
        ]);

        // Verificar si el paciente ya está registrado usando el CUI
        $pacienteExistente = Modelo5bA::where('cui', $validated['cui'])->first();

        if ($pacienteExistente) {
            return redirect()->back()->with('error', 'Este paciente ya está registrado con el CUI proporcionado.');
        }

        // Guardar el tipo de formulario en la tabla `tipo_formularios`
        $tipoFormulario = TipoFormulario::firstOrCreate([
            'codigo_formulario' => $validated['codigo_formulario'],
        ]);

        // Guardar los datos generales del formulario en `formulario_sigsa_base`
        $formulario = Modelo5bA::create([
            'codigo_formulario' => $validated['codigo_formulario'],
            'nombre_paciente' => $validated['nombre_paciente'],
            'cui' => $validated['cui'],
            // Otros campos del formulario base
        ]);

        // Guardar la relación en `formulario_sigsa_tipo_formulario` (tabla pivote)
        $formulario->tipoFormularios()->attach($tipoFormulario->id);

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

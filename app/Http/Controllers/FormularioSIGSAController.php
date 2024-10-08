<?php

namespace App\Http\Controllers;

use App\Models\FormularioSIGSA5b;
use Illuminate\Http\Request;
use App\Models\Residencia;
use App\Models\Vacuna;
use App\Models\TipoFormulario;
use App\Models\Mujer15a49yOtrosGrupos;

class FormularioSIGSAController extends Controller
{
    public function index()
    {
        $formularios = FormularioSIGSA5b::whereHas('tipoFormularios', function ($query) {
            $query->where('codigo_formulario', 'FOR-SIGSA-5b');
        })->get();

        return view('formularios.crud5b.index', compact('formularios'));
    }

    public function show($id)
    {
        $formulario = FormularioSIGSA5b::with(['residencia', 'mujer15a49yOtrosGrupos'])->findOrFail($id);
        return view('formularios.crud5b.show', compact('formulario'));
    }

    public function create()
    {
        $vacunas = Vacuna::all();
        return view('formularios.formulario-for-sigsa-5b', compact('vacunas'));
    }

    public function store(Request $request)
    {
//
//        dd($request->all());  // Depurar todos los datos enviados desde el formulario

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
            'cui' => 'nullable|string', // El CUI es opcional
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

            'mujer_15_49' => 'nullable|array',
            'mujer_15_49.*' => 'nullable|date',

            'otros_grupos' => 'nullable|array',
            'otros_grupos.*' => 'nullable|date',
        ]);


        // Si se proporciona el CUI, buscar por CUI y vacuna
        if (!empty($validated['cui'])) {
            $pacienteExistente = FormularioSIGSA5b::where('cui', $validated['cui'])
                ->where('vacuna', $validated['vacuna']) // Verificar la misma vacuna
                ->first();
        } else {
            // Si no se proporciona el CUI, buscar por nombre del paciente y vacuna
            $pacienteExistente = FormularioSIGSA5b::where('nombre_paciente', $validated['nombre_paciente'])
                ->where('vacuna', $validated['vacuna']) // Verificar la misma vacuna
                ->first();
        }

        if ($pacienteExistente) {
            // Si ya existe, redirigir con un mensaje de alerta
            return redirect()->back()->with('alert', 'Este paciente ya ha recibido esta vacuna. Si deseas agregar una segunda dosis o refuerzo, edita el registro existente.');
        }



        $tipoFormulario = TipoFormulario::firstOrCreate([
            'codigo_formulario' => $validated['codigo_formulario'],
        ]);

        $vacuna = Vacuna::where('nombre_vacuna', $validated['vacuna'])->firstOrFail();

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
        ]);

        // Relacionar el formulario con el tipo de formulario
        $formulario->tipoFormularios()->attach($tipoFormulario->id);

        // Guardar los datos de residencia
        $formulario->residencia()->create([
            'comunidad_direccion' => $validated['comunidad_direccion'],
            'municipio_residencia' => $validated['municipio_residencia'],
            'agricola_migrante' => $validated['agricola_migrante'],
            'embarazada' => $validated['embarazada'],
        ]);

        // Almacenar las dosis de vacunación para mujeres de 15 a 49 años
        foreach ($request->input('mujer_15_49', []) as $tipoDosis => $fechaVacunacion) {
            if ($fechaVacunacion) {
                Mujer15a49yOtrosGrupos::create([
                    'formulario_base_id' => $formulario->id,
                    'grupo' => 'mujer_15_49',
                    'fecha_vacunacion' => $fechaVacunacion,
                    'tipo_dosis' => $tipoDosis,
                ]);
            }
        }

        // Almacenar las dosis de vacunación para otros grupos
        foreach ($request->input('otros_grupos', []) as $tipoDosis => $fechaVacunacion) {
            if ($fechaVacunacion) {
                Mujer15a49yOtrosGrupos::create([
                    'formulario_base_id' => $formulario->id,
                    'grupo' => 'otros_grupos',
                    'fecha_vacunacion' => $fechaVacunacion,
                    'tipo_dosis' => $tipoDosis,
                ]);
            }
        }

        return redirect()->route('formulario.exitoso')->with('status', 'Formulario guardado exitosamente');
    }


    public function edit($id)
    {
        // Cargar el formulario junto con las relaciones
        $formulario = FormularioSIGSA5b::with('mujer15a49yOtrosGrupos', 'residencia')->findOrFail($id);

        // Obtener las vacunas disponibles
        $vacunas = Vacuna::all();

        return view('formularios.crud5b.edit', compact('formulario', 'vacunas'));
    }



    public function update(Request $request, $id)
    {
        // Validar los datos
        $validated = $request->validate([
            'vacuna' => 'nullable|string',
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',
            'no_orden' => 'nullable|integer',
            'nombre_paciente' => 'required|string|max:150',
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
            'vacuna_mujer_15_49' => 'nullable|array',
            'vacuna_mujer_15_49.*' => 'nullable|date',
            'vacuna_otros_grupos' => 'nullable|array',
            'vacuna_otros_grupos.*' => 'nullable|date',
        ]);

        // Buscar el formulario
        $formulario = FormularioSIGSA5b::findOrFail($id);

        // Actualizar el formulario principal
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
            'nombre_paciente' => $validated['nombre_paciente'],
            'cui' => $validated['cui'] ?? $formulario->cui,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? $formulario->fecha_nacimiento,
            'sexo' => $validated['sexo'] ?? $formulario->sexo,
            'pueblo' => $validated['pueblo'] ?? $formulario->pueblo,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? $formulario->comunidad_linguistica,
            'escolaridad' => $validated['escolaridad'] ?? $formulario->escolaridad,
            'profesion_oficio' => $validated['profesion_oficio'] ?? $formulario->profesion_oficio,
        ]);

        // Actualizar residencia
        $residencia = $formulario->residencia;
        if ($residencia) {
            $residencia->update([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? $residencia->comunidad_direccion,
                'municipio_residencia' => $validated['municipio_residencia'] ?? $residencia->municipio_residencia,
                'agricola_migrante' => $validated['agricola_migrante'] ?? $residencia->agricola_migrante,
                'embarazada' => $validated['embarazada'] ?? $residencia->embarazada,
            ]);
        } else {
            $formulario->residencia()->create([
                'comunidad_direccion' => $validated['comunidad_direccion'],
                'municipio_residencia' => $validated['municipio_residencia'],
                'agricola_migrante' => $validated['agricola_migrante'],
                'embarazada' => $validated['embarazada'],
            ]);
        }

        // Actualizar dosis de vacunación para mujeres de 15 a 49 años
        foreach ($validated['vacuna_mujer_15_49'] as $tipoDosis => $fechaVacunacion) {
            if ($fechaVacunacion) {
                Mujer15a49yOtrosGrupos::updateOrCreate(
                    ['formulario_base_id' => $formulario->id, 'grupo' => 'mujer_15_49', 'tipo_dosis' => $tipoDosis],
                    ['fecha_vacunacion' => $fechaVacunacion]
                );
            }
        }

        // Actualizar dosis de vacunación para otros grupos
        foreach ($validated['vacuna_otros_grupos'] as $tipoDosis => $fechaVacunacion) {
            if ($fechaVacunacion) {
                Mujer15a49yOtrosGrupos::updateOrCreate(
                    ['formulario_base_id' => $formulario->id, 'grupo' => 'otros_grupos', 'tipo_dosis' => $tipoDosis],
                    ['fecha_vacunacion' => $fechaVacunacion]
                );
            }
        }

        return redirect()->route('for-sigsa-5b.index')->with('success', 'Formulario actualizado correctamente');
    }
}

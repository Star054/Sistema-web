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



    public function destroy($id)
    {
        $formulario = FormularioSIGSA5b::findOrFail($id);
        $vacuna = Vacuna::where('nombre_vacuna', $formulario->vacuna)->first();

        if ($vacuna) {
            // Contar el número de dosis registradas para este formulario
            $dosisRegistradas = $formulario->mujer15a49yOtrosGrupos()->count();


            $vacuna->cantidad_despachada += $dosisRegistradas;


            $vacuna->save();
        }

        // Eliminar las dosis relacionadas y luego el formulario
        $formulario->mujer15a49yOtrosGrupos()->delete(); // Eliminar las dosis primero
        $formulario->delete(); // Luego eliminar el formulario principal

        return redirect()->route('for-sigsa-5b.index')->with('status', 'Formulario y dosis eliminados exitosamente, inventario actualizado.');
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
        // Validar los datos del formulario
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
            'cui' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|in:M,F',
            'pueblo' => 'nullable|integer|in:1,2,3,4,5,6',
            'comunidad_linguistica' => 'nullable|integer|in:1,2,3,...,23',
            'escolaridad' => 'nullable|integer|in:0,1,2,3,4,5,6,7',
            'profesion_oficio' => 'nullable|integer|in:0,1,2,3,4,5,6,7,8',
            'discapacidad' => 'nullable|integer|in:0,1,2,3,4,5',
            'orientacion_sexual' => 'nullable|integer|in:0,1,2,3,4,5',
            'dia_consulta' => 'nullable|date',
            'no_historia_clinica' => 'nullable|string',
            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',
            'mujer_15_49' => 'nullable|array',
            'mujer_15_49.*' => 'nullable|date',
            'otros_grupos' => 'nullable|array',
            'otros_grupos.*' => 'nullable|date',
        ]);

        // Verificar si el paciente ya está registrado con esta vacuna
        $pacienteExistente = FormularioSIGSA5b::where(function ($query) use ($validated) {
            $query->where('vacuna', $validated['vacuna']);
            if (!empty($validated['cui'])) {
                $query->where('cui', $validated['cui']);
            } else {
                $query->where('nombre_paciente', $validated['nombre_paciente']);
            }
        })->first();

        if ($pacienteExistente) {
            return redirect()->back()->with('alert', 'Este paciente ya ha recibido esta vacuna. Si deseas agregar una segunda dosis o refuerzo, edita el registro existente.');
        }

        // Reducir el inventario de la vacuna
        $inventarioController = new InventarioController();
        if (!$inventarioController->reducirDosisPorNombre($validated['vacuna'])) {
            return redirect()->back()->withErrors(['error' => 'No hay stock suficiente para esta vacuna.']);
        }

        // Crear el registro del formulario del paciente
        $formulario = FormularioSIGSA5b::create([
            'vacuna' => $validated['vacuna'],
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
            'escolaridad' => $validated['escolaridad'] !== '' ? $validated['escolaridad'] : null,
            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
            'discapacidad' => $validated['discapacidad'] ?? null,
            'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
            'municipio_residencia' => $validated['municipio_residencia'] ?? null,
            'agricola_migrante' => $validated['agricola_migrante'] ?? null,
            'embarazada' => $validated['embarazada'] ?? null,
        ]);

        // Asociar el formulario con el tipo de formulario
        $tipoFormulario = TipoFormulario::firstOrCreate(['codigo_formulario' => $validated['codigo_formulario']]);
        $formulario->tipoFormularios()->attach($tipoFormulario->id);

        // Guardar los datos de vacunación para mujeres de 15 a 49 años y otros grupos
        foreach (['mujer_15_49', 'otros_grupos'] as $grupo) {
            foreach ($request->input($grupo, []) as $fechaVacunacion) {
                if ($fechaVacunacion) {
                    Mujer15a49yOtrosGrupos::create([
                        'formulario_base_id' => $formulario->id,
                        'grupo' => $grupo,
                        'fecha_vacunacion' => $fechaVacunacion,
                    ]);
                }
            }
        }
        session()->flash('status', 'form-saved');

        // Redirigir a la vista anterior o a otra
        return redirect()->route('for-sigsa-5b.create')->with('success', 'Paciente registrado exitosamente.');
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


        // Validar los datos del formulario
        $validated = $request->validate([
            'vacuna' => 'nullable|string|exists:vacunas,nombre_vacuna', // No requerido en la actualización
            'nombre_paciente' => 'required|string|max:150', // Este es requerido porque es un campo clave
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',
            'no_orden' => 'nullable|integer',
            'cui' => 'nullable|string', // Opcional en la actualización
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
            'vacuna_mujer_15_49' => 'nullable|array', // Opcional
            'vacuna_mujer_15_49.*' => 'nullable|date', // Opcional
            'vacuna_otros_grupos' => 'nullable|array', // Opcional
            'vacuna_otros_grupos.*' => 'nullable|date', // Opcional
        ]);

        // Buscar el formulario
        $formulario = FormularioSIGSA5b::findOrFail($id);

        // Actualizar el formulario principal
        $formulario->update([
            'vacuna' => $validated['vacuna'] ?? $formulario->vacuna,
            'nombre_paciente' => $validated['nombre_paciente'], // Campo requerido
            'area_salud' => $validated['area_salud'] ?? null,
            'distrito_salud' => $validated['distrito_salud'] ?? null,
            'municipio' => $validated['municipio'] ?? null,
            'servicio_salud' => $validated['servicio_salud'] ?? null,
            'responsable_informacion' => $validated['responsable_informacion'] ?? null,
            'cargo_responsable' => $validated['cargo_responsable'] ?? null,
            'anio' => $validated['anio'] ?? null,
            'orientacion_sexual' => $validated['orientacion_sexual'] ?? null,
            'no_orden' => $validated['no_orden'] ?? null,
            'cui' => $validated['cui'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'sexo' => $validated['sexo'] ?? null,
            'pueblo' => $validated['pueblo'] ?? null,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? null,
            'escolaridad' => $validated['escolaridad'] ?? null,
            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
            'discapacidad' => $validated['discapacidad'] ?? null,
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

        // Manejo de las dosis para Mujer de 15 a 49 años
        foreach (['1a', '2a', '3a', 'r1', 'r2'] as $dosis) {
            $fechaVacunacion = $request->input('vacuna_mujer_15_49.'.$dosis);

            // Busca la dosis existente
            $dosisExistente = $formulario->mujer15a49yOtrosGrupos()
                ->where('tipo_dosis', $dosis)
                ->where('grupo', 'mujer_15_49')
                ->first();

            if ($fechaVacunacion) {
                // Si hay una fecha, actualiza o crea la dosis
                if ($dosisExistente) {
                    $dosisExistente->fecha_vacunacion = $fechaVacunacion;
                    $dosisExistente->save();
                } else {
                    // Crea una nueva dosis si no existe
                    $formulario->mujer15a49yOtrosGrupos()->create([
                        'tipo_dosis' => $dosis,
                        'grupo' => 'mujer_15_49',
                        'fecha_vacunacion' => $fechaVacunacion,
                    ]);
                }
            } elseif ($dosisExistente) {
                // Si no hay fecha y existe la dosis, elimínala
                $dosisExistente->delete();
            }
        }

        // Manejo de las dosis para Otros Grupos
        foreach (['1a', '2a', '3a', 'r1', 'r2'] as $dosis) {
            $fechaVacunacion = $request->input('vacuna_otros_grupos.'.$dosis);

            // Busca la dosis existente
            $dosisExistente = $formulario->mujer15a49yOtrosGrupos()
                ->where('tipo_dosis', $dosis)
                ->where('grupo', 'otros_grupos')
                ->first();

            if ($fechaVacunacion) {
                // Si hay una fecha, actualiza o crea la dosis
                if ($dosisExistente) {
                    $dosisExistente->fecha_vacunacion = $fechaVacunacion;
                    $dosisExistente->save();
                } else {
                    // Crea una nueva dosis si no existe
                    $formulario->mujer15a49yOtrosGrupos()->create([
                        'tipo_dosis' => $dosis,
                        'grupo' => 'otros_grupos',
                        'fecha_vacunacion' => $fechaVacunacion,
                    ]);
                }
            } elseif ($dosisExistente) {
                // Si no hay fecha y existe la dosis, elimínala
                $dosisExistente->delete();
            }
        }


        // Redirigir de vuelta a la búsqueda si el término de búsqueda está presente
        $buscar = $request->input('buscar');
        if ($buscar) {
            return redirect()->route('busqueda.resultados', ['buscar' => $buscar])
                ->with('success', 'Formulario actualizado correctamente.');
        }


        // Redirigir al índice si no hay un término de búsqueda
        return redirect()->route('for-sigsa-5b.index')->with('success', 'Formulario actualizado correctamente');
    }

}


<?php

namespace App\Http\Controllers;

use App\Models\FormularioSIGSA5b;
use App\Models\Modelo5bA;
use Illuminate\Http\Request;
use App\Models\Vacuna;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\CriteriosVacuna;

class ConsultaVacunasController extends Controller
{
    public function mostrarFiltros()
    {
        // Obtener todas las vacunas para mostrarlas en el select
        $vacunas = Vacuna::all();
        return view('consultas.filtros', compact('vacunas'));
    }

    public function mostrarResultados(Request $request)
    {
        // Capturar los valores del formulario
        $tipoFormulario = $request->input('tipo_formulario');
        $vacuna = $request->input('vacuna');
        $mes = Carbon::parse($request->input('mes'))->month;  // Extrae solo el número del mes
        $anio = Carbon::parse($request->input('mes'))->year;   // Extrae solo el año

        // Lógica de consulta dependiendo del formulario
        switch ($tipoFormulario) {
            case 'SIGSA5b':
                // Consulta con relaciones Eloquent en lugar de un join manual
                $pacientes = FormularioSIGSA5b::with(['residencia', 'mujer15a49yOtrosGrupos'])
                    ->whereHas('mujer15a49yOtrosGrupos', function ($query) use ($vacuna, $mes, $anio) {
                        $query->where('fecha_vacunacion', 'like', "{$anio}-{$mes}%")
                            ->where('vacuna', $vacuna);  // Aquí asumimos que 'vacuna' es el campo de la tabla relacionada
                    })
                    ->get();

                // Retornar la vista del formulario 5b
                return view('consultas.resultados', compact('pacientes', 'vacuna', 'mes', 'tipoFormulario'));
                break;

            case 'SIGSA5bA':
                // Consulta utilizando el nombre de la vacuna en la tabla `criterios_vacuna`
                $pacientes = Modelo5bA::with(['residencia', 'criteriosVacuna'])
                    ->whereHas('criteriosVacuna', function ($query) use ($vacuna, $mes, $anio) {
                        $query->where('fecha_administracion', 'like', "{$anio}-{$mes}%")
                            ->where('vacuna', $vacuna); // Filtrar por el nombre de la vacuna en lugar de vacuna_id
                    })
                    ->get();

                // Retornar la vista del formulario 5bA
                return view('consultas.resultados5bA', compact('pacientes', 'vacuna', 'mes', 'anio', 'tipoFormulario'));
                break;

            default:
                // Devuelve una colección vacía si no se selecciona un tipo válido
                $pacientes = collect();
                // Retornar la vista por defecto
                return view('consultas.resultados', compact('pacientes', 'vacuna', 'mes', 'tipoFormulario'));
                break;
        }
    }


    public function buscar(Request $request)
    {
        $busqueda = $request->input('buscar');

        // Realizar el inner join usando Eloquent
        $pacientes = FormularioSIGSA5b::join('formulario_sigsa_tipo_formulario', 'formulario_sigsa_base.id', '=', 'formulario_sigsa_tipo_formulario.formulario_sigsa_base_id')
            ->join('tipo_formularios', 'formulario_sigsa_tipo_formulario.tipo_formulario_id', '=', 'tipo_formularios.id')
            ->where(function($query) use ($busqueda) {
                $query->where('formulario_sigsa_base.cui', 'LIKE', "%{$busqueda}%")
                    ->orWhere('formulario_sigsa_base.nombre_paciente', 'LIKE', "%{$busqueda}%");
            })
            ->select('formulario_sigsa_base.*', 'tipo_formularios.codigo_formulario as tipo_formulario')
            ->get();



        return view('busqueda-resultados', compact('pacientes'));
    }
}

<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\FormularioSIGSA5b;
use App\Models\Modelo5bA;
use App\Models\Vacuna;
use TCPDF;


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
        $fecha = $request->input('mes');

        try {
            $mes = Carbon::createFromFormat('Y-m', $fecha)->month;
            $anio = Carbon::createFromFormat('Y-m', $fecha)->year;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['mes' => 'Fecha no válida.']);
        }

        // Lógica de consulta dependiendo del formulario
        switch ($tipoFormulario) {
            case 'SIGSA5b':
                $pacientes = FormularioSIGSA5b::with(['residencia', 'mujer15a49yOtrosGrupos'])
                    ->where('vacuna', $vacuna) // Filtrar por la vacuna en la tabla correcta
                    ->whereHas('mujer15a49yOtrosGrupos', function ($query) use ($mes, $anio) {
                        $query->whereMonth('fecha_vacunacion', $mes)
                            ->whereYear('fecha_vacunacion', $anio);
                    })
                    ->get();

                // Retornar la vista de resultados
                return view('consultas.resultados', compact('pacientes', 'vacuna', 'mes', 'anio', 'tipoFormulario'));
                break;

            case 'SIGSA5bA':
                $pacientes = Modelo5bA::with(['residencia', 'criteriosVacuna'])
                    ->whereHas('criteriosVacuna', function ($query) use ($vacuna, $mes, $anio) {
                        $query->whereMonth('fecha_administracion', $mes)
                            ->whereYear('fecha_administracion', $anio)
                            ->where('vacuna', $vacuna);
                    })
                    ->get();

                return view('consultas.resultados5bA', compact('pacientes', 'vacuna', 'mes', 'anio', 'tipoFormulario'));
                break;

            default:
                return view('consultas.resultados', ['pacientes' => collect()]);
        }


        
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->input('buscar');

        // Realizar el inner join usando Eloquent
        $pacientes = FormularioSIGSA5b::join('formulario_sigsa_tipo_formulario', 'formulario_sigsa_base.id', '=', 'formulario_sigsa_tipo_formulario.formulario_sigsa_base_id')
            ->join('tipo_formularios', 'formulario_sigsa_tipo_formulario.tipo_formulario_id', '=', 'tipo_formularios.id')
            ->leftJoin('criterios_vacuna', function($join) {
                $join->on('formulario_sigsa_base.id', '=', 'criterios_vacuna.formulario_sigsa_base_id')
                    ->where('tipo_formularios.codigo_formulario', 'FOR-SIGSA-5bA');
            })
            ->leftJoin('mujer15a49y_otros_grupos', function($join) {
                $join->on('formulario_sigsa_base.id', '=', 'mujer15a49y_otros_grupos.formulario_base_id')
                    ->where('tipo_formularios.codigo_formulario', 'FOR-SIGSA-5b');
            })
            ->where(function($query) use ($busqueda) {
                $query->where('formulario_sigsa_base.cui', 'LIKE', "%{$busqueda}%")
                    ->orWhere('formulario_sigsa_base.nombre_paciente', 'LIKE', "%{$busqueda}%");
            })
            ->select(
                'formulario_sigsa_base.*',
                'tipo_formularios.codigo_formulario as tipo_formulario',
                \DB::raw("IF(tipo_formularios.codigo_formulario = 'FOR-SIGSA-5b', mujer15a49y_otros_grupos.tipo_dosis, criterios_vacuna.dosis) as tipo_dosis"),
                \DB::raw("IF(tipo_formularios.codigo_formulario = 'FOR-SIGSA-5b', mujer15a49y_otros_grupos.fecha_vacunacion, criterios_vacuna.fecha_administracion) as fecha_vacunacion"),
                \DB::raw("IF(tipo_formularios.codigo_formulario = 'FOR-SIGSA-5b', mujer15a49y_otros_grupos.grupo, criterios_vacuna.grupo_priorizado) as grupo"),
                \DB::raw("IF(tipo_formularios.codigo_formulario = 'FOR-SIGSA-5b', formulario_sigsa_base.vacuna, criterios_vacuna.vacuna) as nombre_vacuna")
            )
            ->paginate(10);

        return view('busqueda-resultados', compact('pacientes'));
    }

}

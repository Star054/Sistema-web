<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacuna;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $vacuna = $request->input('vacuna');  // El campo vacuna está en formulario_sigsa_base
        $mes = $request->input('mes');

        // Lógica de consulta dependiendo del formulario
        switch ($tipoFormulario) {
            case 'SIGSA5b':
                // Consulta con el filtro de vacuna desde formulario_sigsa_base y la fecha de vacunación desde mujer15a49y_otros_grupos
                $pacientes = DB::table('formulario_sigsa_base')
                    ->join('residencia', 'formulario_sigsa_base.id', '=', 'residencia.formulario_base_id')
                    ->join('mujer15a49y_otros_grupos', 'formulario_sigsa_base.id', '=', 'mujer15a49y_otros_grupos.formulario_base_id')
                    ->where('formulario_sigsa_base.vacuna', $vacuna)  // El filtro de vacuna se aplica aquí
                    ->whereMonth('mujer15a49y_otros_grupos.fecha_vacunacion', Carbon::parse($mes)->month)
                    ->whereYear('mujer15a49y_otros_grupos.fecha_vacunacion', Carbon::parse($mes)->year)
                    ->select('formulario_sigsa_base.*', 'residencia.*', 'mujer15a49y_otros_grupos.fecha_vacunacion', 'mujer15a49y_otros_grupos.tipo_dosis')
                    ->get();
                break;

            default:
                // Si no se selecciona un tipo de formulario válido
                $pacientes = collect(); // Devuelve una colección vacía
                break;
        }

        // Obtener todas las vacunas disponibles
        $vacunas = Vacuna::all();

        // Retornar la vista con los resultados
        return view('consultas.resultados', compact('pacientes', 'vacunas', 'vacuna', 'mes', 'tipoFormulario'));
    }
}

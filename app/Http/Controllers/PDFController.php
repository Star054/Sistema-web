<?php
//
//
//namespace App\Http\Controllers;
//
//use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
//use Illuminate\Http\Request;
//use Carbon\Carbon;
//use App\Models\FormularioSIGSA5b;
//use App\Models\Modelo5bA;
//
//class PDFController extends Controller
//{
//    // Generar PDF basado en los filtros
//    public function generarPDFFiltro(Request $request)
//    {
//        // Validar los parámetros
//        $request->validate([
//            'mes' => 'required|date_format:Y-m',
//            'vacuna' => 'required|string|exists:vacunas,nombre_vacuna',
//            'tipo_formulario' => 'required|string|in:SIGSA5b,SIGSA5bA',
//        ]);
//
//        // Capturar los filtros
//        $vacuna = $request->input('vacuna');
//        $fecha = $request->input('mes');
//        $tipoFormulario = $request->input('tipo_formulario');
//
//        // Procesar mes y año
//        try {
//            $mes = Carbon::createFromFormat('Y-m', $fecha)->month;
//            $anio = Carbon::createFromFormat('Y-m', $fecha)->year;
//        } catch (\Exception $e) {
//            return redirect()->back()->withErrors(['mes' => 'Formato de fecha no válido.']);
//        }
//
//        // Generar PDF según el tipo de formulario
//        switch ($tipoFormulario) {
//            case 'SIGSA5b':
//                // Consulta para SIGSA5b
//                $pacientes = FormularioSIGSA5b::with(['residencia', 'mujer15a49yOtrosGrupos'])
//                    ->whereHas('mujer15a49yOtrosGrupos', function ($query) use ($vacuna, $mes, $anio) {
//                        $query->whereMonth('fecha_vacunacion', $mes)
//                            ->whereYear('fecha_vacunacion', $anio)
//                            ->where('vacuna', $vacuna);
//                    })
//                    ->get();
//
//                // Generar PDF para SIGSA5b
//                $pdf = PDF::loadView('pdf.resultados5b', compact('pacientes', 'vacuna', 'mes', 'anio', 'tipoFormulario'));
//                break;
//
//            case 'SIGSA5bA':
//                // Consulta para SIGSA5bA
//                $pacientes = Modelo5bA::with(['residencia', 'criteriosVacuna'])
//                    ->whereHas('criteriosVacuna', function ($query) use ($vacuna, $mes, $anio) {
//                        $query->whereMonth('fecha_administracion', $mes)
//                            ->whereYear('fecha_administracion', $anio)
//                            ->where('vacuna', $vacuna);
//                    })
//                    ->get();
//
//                // Generar PDF para SIGSA5bA
//                $pdf = PDF::loadView('pdf.resultados5bA', compact('pacientes', 'vacuna', 'mes', 'anio', 'tipoFormulario'));
//                break;
//
//            default:
//                abort(404, 'Formulario no encontrado.');
//        }
//
//        // Descargar PDF
//        $nombreArchivo = 'pacientes_' . $tipoFormulario . '_' . $vacuna . '_' . $mes . '_' . $anio . '.pdf';
//        return $pdf->download($nombreArchivo);
//    }
//}

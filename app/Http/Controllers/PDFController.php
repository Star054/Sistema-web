<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\FormularioSIGSA5b;
use App\Models\Modelo5bA;
use Carbon\Carbon;


class PDFController extends Controller
{

    public function generarPDF5b(Request $request)
    {
        // Capturar los valores del formulario para filtrar pacientes
        $vacuna = $request->input('vacuna');
        $mes = Carbon::createFromFormat('Y-m', $request->input('mes'))->month;
        $anio = Carbon::createFromFormat('Y-m', $request->input('mes'))->year;

        // Obtener los pacientes que coincidan con los filtros
        $pacientes = FormularioSIGSA5b::with(['residencia', 'mujer15a49yOtrosGrupos'])
            ->whereHas('mujer15a49yOtrosGrupos', function ($query) use ($vacuna, $mes, $anio) {
                $query->whereMonth('fecha_vacunacion', $mes)
                    ->whereYear('fecha_vacunacion', $anio)
                    ->where('vacuna', $vacuna);
            })
            ->get();

        if ($pacientes->isEmpty()) {
            return redirect()->back()->withErrors(['mensaje' => 'No se encontraron pacientes para generar el PDF.']);
        }

        // Obtener el primer paciente
        $primerPaciente = $pacientes->first();

        // Asignar los datos del encabezado desde el primer paciente
        $area_salud = $primerPaciente->area_salud;
        $distrito_salud = $primerPaciente->distrito_salud;
        $municipio = $primerPaciente->municipio;
        $servicio_salud = $primerPaciente->servicio_salud;
        $responsable_informacion = $primerPaciente->responsable_informacion;
        $cargo_responsable = $primerPaciente->cargo_responsable;
        $anio = $primerPaciente->anio;

        // Crear PDF con TCPDF en formato horizontal (Landscape) y tamaño oficio (Legal)
        $pdf = new TCPDF('L', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
        $pdf->SetMargins(5, 5, 5);

        // Establecer información del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Vacunación');
        $pdf->SetTitle('Reporte de Pacientes Vacunados - SIGSA5b');

        // Añadir página
        $pdf->AddPage();

        // Logos
        $pdf->Image(public_path('logos/logo.jpg'), 10, 10, 20); // Logo 1
        $pdf->Image(public_path('logos/logo2.jpg'), 40, 10, 20); // Logo 2

        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 15, 'Reporte de Vacunación - Formulario SIGSA5b', 0, 1, 'C');

        // Vacuna a la derecha
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetXY(140, 25);
        $pdf->Cell(0, 10, 'Vacuna: ' . $vacuna, 0, 0, 'L');

        // Información del formulario (Código, Versión, Vigencia)
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetY(10);
        $pdf->SetX(-60);
        $pdf->MultiCell(50, 5, "Código: FOR-SIGSA-5b\nVersión: 3.0\nVigente a partir de: Noviembre 2017", 0, 'R');

        $pdf->Ln(10);

        $pdf->SetFont('helvetica', '', 10);
        $cellWidth = 90;

        // Primera fila de información adicional
        $pdf->Cell($cellWidth, 6, 'Área de Salud: ' . $area_salud, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Distrito de Salud: ' . $distrito_salud, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Municipio: ' . $municipio, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Servicio de Salud: ' . $servicio_salud, 0, 1, 'L');

        // Segunda fila de información adicional
        $pdf->Cell($cellWidth, 6, 'Responsable de la Información: ' . $responsable_informacion, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Cargo: ' . $cargo_responsable, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Año: ' . $anio, 0, 0, 'L');
        $pdf->Cell($cellWidth, 6, 'Firma: .......................', 0, 1, 'L');
        $pdf->Ln(5);

        // Definir los anchos de las columnas ajustados
        $columnWidths = [
            'no' => 8,
            'nombre_paciente' => 50, // Aumentamos el ancho para el nombre
            'cui' => 20,
            'sexo' => 8, // Reducido
            'pueblo' => 15, // Reducido
            'fecha_nacimiento' => 18, // Reducido
            'comunidad_linguistica' => 15, // Reducido
            'orientacion_sexual' => 15, // Reducido
            'escolaridad' => 15, // Reducido
            'profesion_oficio' => 15, // Reducido
            'comunidad_direccion' => 25,
            'municipio_residencia' => 25,
            'agricola_migrante' => 15,
            'embarazada' => 15,
            'grupo' => 20,
            'fecha_vacunacion' => 18,
            'tipo_dosis' => 18,
        ];

        // Agregar los encabezados de las columnas
        $pdf->SetFont('helvetica', 'B', 8);

        // Usaremos MultiCell en lugar de Cell para poder ajustar la altura
        $pdf->MultiCell($columnWidths['no'], 7, 'No', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['nombre_paciente'], 7, 'Nombre Paciente', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['cui'], 7, 'CUI', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['sexo'], 7, 'Sexo', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['pueblo'], 7, 'Pueblo', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['fecha_nacimiento'], 7, 'Fecha Nac.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['comunidad_linguistica'], 7, 'Lingüística', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['orientacion_sexual'], 7, 'Orient. Sexual', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['escolaridad'], 7, 'Escolaridad', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['profesion_oficio'], 7, 'Prof./Oficio', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['comunidad_direccion'], 7, 'Comunidad', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['municipio_residencia'], 7, 'Municipio Res.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['agricola_migrante'], 7, 'Agri. Migrante', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['embarazada'], 7, 'Embarazada', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['grupo'], 7, 'Grupo', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['fecha_vacunacion'], 7, 'Fecha Vac.', 1, 'C', 0, 0);
        $pdf->MultiCell($columnWidths['tipo_dosis'], 7, 'Tipo Dosis', 1, 'C', 0, 1);

        // Añadir los datos de los pacientes
        $pdf->SetFont('helvetica', '', 8);
        foreach ($pacientes as $paciente) {
            // Ahora recorremos todas las dosis del paciente
            foreach ($paciente->mujer15a49yOtrosGrupos as $grupo) {
                $rowData = [
                    'no' => $paciente->no_orden,
                    'nombre_paciente' => $paciente->nombre_paciente,
                    'cui' => $paciente->cui,
                    'sexo' => $paciente->sexo,
                    'pueblo' => $paciente->pueblo ?? 'N/A',
                    'fecha_nacimiento' => $paciente->fecha_nacimiento ? Carbon::parse($paciente->fecha_nacimiento)->format('d-m-Y') : 'N/A',
                    'comunidad_linguistica' => $paciente->comunidad_linguistica ?? 'N/A',
                    'orientacion_sexual' => $paciente->orientacion_sexual ?? 'N/A',
                    'escolaridad' => $paciente->escolaridad ?? 'N/A',
                    'profesion_oficio' => $paciente->profesion_oficio ?? 'N/A',
                    'comunidad_direccion' => $paciente->residencia->comunidad_direccion ?? 'N/A',
                    'municipio_residencia' => $paciente->residencia->municipio_residencia ?? 'N/A',
                    'agricola_migrante' => $paciente->residencia->agricola_migrante ?? 'N/A',
                    'embarazada' => $paciente->residencia->embarazada ?? 'N/A',
                    'grupo' => $grupo->grupo,
                    'fecha_vacunacion' => isset($grupo->fecha_vacunacion) ? Carbon::parse($grupo->fecha_vacunacion)->format('d-m-Y') : 'N/A',
                    'tipo_dosis' => $grupo->tipo_dosis ?? 'N/A',
                ];

                // Calculamos la altura máxima de la fila
                $maxHeight = $this->getMaxRowHeight($pdf, $rowData, $columnWidths);

                // Escribimos cada celda utilizando MultiCell para ajustar la altura
                $pdf->MultiCell($columnWidths['no'], $maxHeight, $rowData['no'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['nombre_paciente'], $maxHeight, $rowData['nombre_paciente'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['cui'], $maxHeight, $rowData['cui'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['sexo'], $maxHeight, $rowData['sexo'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['pueblo'], $maxHeight, $rowData['pueblo'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['fecha_nacimiento'], $maxHeight, $rowData['fecha_nacimiento'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['comunidad_linguistica'], $maxHeight, $rowData['comunidad_linguistica'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['orientacion_sexual'], $maxHeight, $rowData['orientacion_sexual'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['escolaridad'], $maxHeight, $rowData['escolaridad'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['profesion_oficio'], $maxHeight, $rowData['profesion_oficio'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['comunidad_direccion'], $maxHeight, $rowData['comunidad_direccion'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['municipio_residencia'], $maxHeight, $rowData['municipio_residencia'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['agricola_migrante'], $maxHeight, $rowData['agricola_migrante'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['embarazada'], $maxHeight, $rowData['embarazada'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['grupo'], $maxHeight, $rowData['grupo'], 1, 'L', 0, 0);
                $pdf->MultiCell($columnWidths['fecha_vacunacion'], $maxHeight, $rowData['fecha_vacunacion'], 1, 'C', 0, 0);
                $pdf->MultiCell($columnWidths['tipo_dosis'], $maxHeight, $rowData['tipo_dosis'], 1, 'L', 0, 1);
            }
        }

        // Descargar el PDF
        $pdf->Output('reporte_pacientes_5b.pdf', 'D');
    }


    // Función para obtener la altura máxima de una fila
    private function getMaxRowHeight($pdf, $rowData, $columnWidths)
    {
        $heights = [];
        foreach ($rowData as $key => $data) {
            $heights[] = $pdf->getStringHeight($columnWidths[$key], $data);
        }
        return max($heights);
    }



        // Generar PDF para el formulario SIGSA5bA
    public function generarPDF5bA(Request $request)
    {
        // Capturar los valores del formulario
        $vacuna = $request->input('vacuna');
        $mes = Carbon::createFromFormat('Y-m', $request->input('mes'))->month;
        $anio = Carbon::createFromFormat('Y-m', $request->input('mes'))->year;

        $pacientes = Modelo5bA::with(['residencia', 'criteriosVacuna'])
            ->whereHas('criteriosVacuna', function ($query) use ($vacuna, $mes, $anio) {
                $query->whereMonth('fecha_administracion', $mes)
                    ->whereYear('fecha_administracion', $anio)
                    ->where('vacuna', $vacuna);
            })
            ->get();

        if ($pacientes->isEmpty()) {
            return redirect()->back()->withErrors(['mensaje' => 'No se encontraron pacientes para generar el PDF.']);
        }

        // Crear PDF con TCPDF en formato horizontal (Landscape) y tamaño oficio (Legal)
        $pdf = new TCPDF('L', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

        // Establecer información del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema de Vacunación');
        $pdf->SetTitle('Reporte de Pacientes Vacunados - SIGSA5bA');

        // Establecer márgenes
        $pdf->SetMargins(10, 10, 10);

        // Agregar página en formato horizontal (landscape) con tamaño oficio
        $pdf->AddPage();

        // Aquí añades la lógica de generación del PDF
        // (similar a la que ya tienes)

        // Descargar el PDF
        $pdf->Output('reporte_pacientes_5bA.pdf', 'D');
    }
}

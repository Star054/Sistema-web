{{--<x-app-layout>--}}

<table>
    <thead>
    <tr>
        <th>Área de Salud</th>
        <th>Distrito de Salud</th>
        <th>Municipio</th>
        <th>Servicio de Salud</th>
        <th>Responsable Información</th>
        <th>Cargo Responsable</th>
        <th>Año</th>
        <th>No. Orden</th>
        <th>Nombres y Apellidos</th>
        <th>CUI</th>
        <th>Sexo</th>
        <th>Pueblo</th>
        <th>Fecha de Nacimiento</th>
        <th>Comunidad Lingüística</th>
        <th>Orientación Sexual</th>
        <th>Escolaridad</th>
        <th>Profesión u Oficio</th>
        <th>Comunidad Dirección</th>
        <th>Municipio Residencia</th>
        <th>Agrícola Migrante</th>
        <th>Embarazada</th>
        <th>Grupo</th>
        <th>Fecha Vacunación</th>
        <th>Tipo Dosis</th>
    </tr>
    </thead>

    <tbody>
    @foreach($pacientes as $paciente)
        @foreach($paciente->mujer15a49yOtrosGrupos as $grupo)
            <tr>
                <td>{{ $paciente->area_salud }}</td>
                <td>{{ $paciente->distrito_salud }}</td>
                <td>{{ $paciente->municipio }}</td>
                <td>{{ $paciente->servicio_salud }}</td>
                <td>{{ $paciente->responsable_informacion }}</td>
                <td>{{ $paciente->cargo_responsable }}</td>
                <td>{{ $paciente->anio }}</td>
                <td>{{ $paciente->no_orden }}</td>
                <td>{{ $paciente->nombre_paciente }}</td>
                <td>{{ $paciente->cui }}</td>
                <td>{{ $paciente->sexo }}</td>
                <td>{{ $paciente->pueblo }}</td>
                <td>{{ $paciente->fecha_nacimiento }}</td>
                <td>{{ $paciente->comunidad_linguistica }}</td>
                <td>{{ $paciente->orientacion_sexual }}</td>
                <td>{{ $paciente->escolaridad }}</td>
                <td>{{ $paciente->profesion_oficio }}</td>
                <td>{{ $paciente->residencia->comunidad_direccion ?? 'N/A' }}</td>
                <td>{{ $paciente->residencia->municipio_residencia ?? 'N/A' }}</td>
                <td>{{ $paciente->residencia->agricola_migrante ?? 'N/A' }}</td>
                <td>{{ $paciente->residencia->embarazada ?? 'N/A' }}</td>
                <td>{{ $grupo->grupo }}</td>
                <td>{{ $grupo->fecha_vacunacion ?? 'Fecha no disponible' }}</td>
                <td>{{ $grupo->tipo_dosis ?? 'Dosis no disponible' }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
    <form action="{{ route('pdf.generar5b') }}" method="POST">
        @csrf
        <input type="hidden" name="vacuna" value="{{ request('vacuna') }}">
        <input type="hidden" name="mes" value="{{ request('mes') }}">
        <button type="submit">Generar PDF Formulario 5b</button>
    </form>


</table>
{{--</x-app-layout>--}}

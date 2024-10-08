<x-app-layout>
    <div class="container">
        <!-- Resultados si existen -->
        @if(isset($pacientes) && !$pacientes->isEmpty())
            <h3>Pacientes vacunados con {{ $vacuna }} en {{ \Carbon\Carbon::parse($mes)->format('F, Y') }}</h3>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Nombre del Paciente</th>
                    <th>CUI</th>
                    <th>Comunidad Dirección</th>
                    <th>Municipio Residencia</th>
                    <th>Fecha de Vacunación</th>
                    <th>Tipo de Dosis</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->nombre_paciente }}</td>
                        <td>{{ $paciente->cui }}</td>
                        <td>{{ $paciente->comunidad_direccion }}</td>
                        <td>{{ $paciente->municipio_residencia }}</td>
                        <td>{{ \Carbon\Carbon::parse($paciente->fecha_vacunacion)->format('d-m-Y') }}</td>
                        <td>{{ $paciente->tipo_dosis }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                <p>No se encontraron pacientes vacunados con los criterios seleccionados.</p>
            </div>
        @endif
    </div>
</x-app-layout>

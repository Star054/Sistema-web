<x-app-layout>
    <div class="container">
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
                        <td>{{ optional($paciente->residencia)->comunidad_direccion ?? 'No registrada' }}</td>
                        <td>{{ optional($paciente->residencia)->municipio_residencia ?? 'No registrado' }}</td>
                        <td>{{ optional($paciente->mujer15a49yOtrosGrupos)->fecha_vacunacion ? \Carbon\Carbon::parse(optional($paciente->mujer15a49yOtrosGrupos)->fecha_vacunacion)->format('d-m-Y') : 'No registrada' }}</td>
                        <td>{{ optional($paciente->mujer15a49yOtrosGrupos)->tipo_dosis ?? 'No registrada' }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                <p>No se encontraron pacientes vacunados con los criterios seleccionados.</p>
            </div>
        @endif

        <form action="{{ route('vacunas.generarPDF') }}" method="POST">
            @csrf
            <input type="hidden" name="mes" value="{{ request('mes') }}">
            <input type="hidden" name="vacuna" value="{{ request('vacuna') }}">
            <input type="hidden" name="tipo_formulario" value="{{ request('tipo_formulario') }}">
            <input type="hidden" name="generar_pdf" value="1">
            <button type="submit" class="btn btn-primary">Generar PDF</button>
        </form>
    </div>
</x-app-layout>

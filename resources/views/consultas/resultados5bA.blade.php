<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultados de Pacientes Vacunados - 5bA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Mostrar los resultados filtrados para el formulario 5bA -->
                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Resultados:</h4>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <h1>Información de Pacientes</h1>

                            @if($pacientes->isEmpty())
                                <p>No se encontraron pacientes.</p>
                            @else
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Nombre Paciente</th>
                                        <th>CUI</th>
                                        <th>Municipio</th>
                                        <th>Comunidad</th>
                                        <th>Vacuna</th>
                                        <th>Dosis</th>
                                        <th>Fecha Vacunación</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pacientes as $paciente)
                                        @if ($paciente->mujer15a49yOtrosGrupos->isNotEmpty())
                                            @foreach($paciente->mujer15a49yOtrosGrupos as $grupo)
                                                <tr>
                                                    <td>{{ $paciente->nombre_paciente }}</td>
                                                    <td>{{ $paciente->cui }}</td>
                                                    <td>{{ $paciente->residencia->municipio_residencia ?? 'N/A' }}</td>
                                                    <td>{{ $paciente->residencia->comunidad_direccion ?? 'N/A' }}</td>
                                                    <td>{{ $paciente->vacuna }}</td>
                                                    <td>{{ $grupo->tipo_dosis }}</td>
                                                    <td>{{ $grupo->fecha_vacunacion }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">No se encontraron registros en Mujer 15 a 49</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif

                        </div>
                    </div>
                    <form action="{{ route('pdf.generar5b') }}" method="POST">
                        @csrf
                        <input type="hidden" name="vacuna" value="{{ request('vacuna') }}">
                        <input type="hidden" name="mes" value="{{ request('mes') }}">
                        <button type="submit">Generar PDF Formulario 5b</button>
                    </form>




                @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

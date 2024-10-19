<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultados de Pacientes - 3CS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Resultados:</h4>

                    @if($pacientes->isEmpty())
                        <p>No se encontraron pacientes.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th>Nombre Paciente</th>
                                <th>CUI</th>
                                <th>Municipio</th>
                                <th>Comunidad</th>
                                <th>Tratamiento</th>
                                <th>Fecha Consulta</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach($pacientes as $paciente)
                                @if ($paciente->consulta && $paciente->consulta->isNotEmpty())
                                    @foreach($paciente->consulta as $consulta)
                                        <tr>
                                            <td>{{ $paciente->nombre_paciente }}</td>
                                            <td>{{ $paciente->cui }}</td>
                                            <td>{{ $paciente->residencia->municipio_residencia ?? 'N/A' }}</td>
                                            <td>{{ $paciente->residencia->comunidad_direccion ?? 'N/A' }}</td>
                                            <td>{{ $consulta->tratamiento_descripcion }}</td>
                                            <td>{{ $paciente->dia_consulta }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">No se encontraron registros en Consulta</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6">
                            <form action="{{ route('generarPDF3CS') }}" method="POST">
                                @csrf
                                <input type="hidden" name="vacuna" value="{{ request('vacuna') }}">
                                <input type="hidden" name="mes" value="{{ request('mes') }}">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition">
                                    Descargar PDF
                                </button>
                            </form>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

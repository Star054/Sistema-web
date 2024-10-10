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
                                <!-- Aquí se organizará la información de los pacientes en una tabla -->
                                <table class="min-w-full bg-white dark:bg-gray-800">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-2">Paciente</th>
                                        <th class="px-4 py-2">CUI</th>
                                        <th class="px-4 py-2">Municipio de Residencia</th>
                                        <th class="px-4 py-2">Comunidad</th>
                                        <th class="px-4 py-2">Vacuna</th>
                                        <th class="px-4 py-2">Dosis</th>
                                        <th class="px-4 py-2">Fecha de Administración</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pacientes as $paciente)
                                        @foreach ($paciente->criteriosVacuna as $criterio)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $paciente->nombre_paciente ?? 'No registrado' }}</td>
                                                <td class="border px-4 py-2">{{ $paciente->cui ?? 'No registrado' }}</td>
                                                <td class="border px-4 py-2">{{ $paciente->residencia->municipio_residencia ?? 'No registrado' }}</td>
                                                <td class="border px-4 py-2">{{ $paciente->residencia->comunidad_direccion ?? 'No registrada' }}</td>
                                                <td class="border px-4 py-2">{{ $criterio->vacuna ?? 'No especificada' }}</td>
                                                <td class="border px-4 py-2">{{ $criterio->dosis ?? 'No especificada' }}</td>
                                                <td class="border px-4 py-2">{{ $criterio->fecha_administracion ?? 'No especificada' }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('vacunas.generarPDF') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mes" value="{{ request('mes') }}">
                        <input type="hidden" name="vacuna" value="{{ request('vacuna') }}">
                        <input type="hidden" name="tipo_formulario" value="{{ request('tipo_formulario') }}">
                        <input type="hidden" name="generar_pdf" value="1">
                        <button type="submit" class="btn btn-primary">Generar PDF</button>
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

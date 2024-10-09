<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultados de la búsqueda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(isset($pacientes) && !$pacientes->isEmpty())
                        <h3>Resultados de la búsqueda</h3>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre del Paciente</th>
                                <th>CUI</th>
                                <th>Comunidad Dirección</th>
                                <th>Municipio Residencia</th>
                                <th>Fecha de Vacunación</th>
                                <th>Tipo de Dosis</th>
                                <th>Acciones</th>
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
                                    <td>
                                        <!-- Redireccionar a la página de edición basada en el tipo de formulario -->
                                        @if($paciente->tipo_formulario == 'FOR-SIGSA-5b')
                                            <a href="{{ route('for-sigsa-5b.edit', $paciente->id) }}" class="text-indigo-600 hover:underline">Editar</a>
                                        @elseif($paciente->tipo_formulario == 'FOR-SIGSA-5bA')
                                            <a href="{{ route('for-sigsa-5bA.edit', $paciente->id) }}" class="text-indigo-600 hover:underline">Editar</a>
                                        @elseif($paciente->tipo_formulario == 'FOR-SIGSA-3CS')
                                            <a href="{{ route('formularios-3cs.edit', $paciente->id) }}" class="text-indigo-600 hover:underline">Editar</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            <p>No se encontraron resultados para "{{ request('buscar') }}"</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

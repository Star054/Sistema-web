<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Formularios 3CS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('formularios-3cs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Crear nuevo formulario
                </a>

                @if ($formularios->count())
                    <table class="min-w-full mt-6">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Paciente</th>
                            <th>Día Consulta</th>
                            <th>No. Historia Clínica</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($formularios as $formulario)
                            <tr>
                                <td>{{ $formulario->id }}</td>
                                <td>{{ $formulario->nombre_paciente }}</td>
                                <td>{{ $formulario->dia_consulta }}</td>
                                <td>{{ $formulario->no_historia_clinica }}</td>
                                <td>
                                    <a href="{{ route('formularios-3cs.edit', $formulario->id) }}" class="text-blue-500">Editar</a>

                                    <form action="{{ route('formularios-3cs.destroy', $formulario->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-6">No hay formularios aún.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

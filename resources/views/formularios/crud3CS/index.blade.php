<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Formularios 3CS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Tabla de Formularios -->
                @if ($formularios->count())
                    <table class="min-w-full mt-6 bg-white dark:bg-gray-800 table-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Día de la Consulta</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">No. Historia Clínica</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Nombres y Apellidos</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">CUI</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($formularios as $formulario)
                            <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $formulario->dia_consulta }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->no_historia_clinica }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->nombre_paciente }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->cui }}</td>
                                <td class="px-4 py-2 text-sm font-medium space-x-2">
                                    <a href="{{ route('formularios-3cs.edit', $formulario->id) }}" class="text-blue-500 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-300">Editar</a>

                                    <form action="{{ route('formularios-3cs.destroy', $formulario->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este formulario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400 dark:text-red-400 dark:hover:text-red-300">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-6 text-gray-700 dark:text-gray-200">No hay formularios aún.</p>
                @endif

                <a href="{{ route('formularios-3cs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:text-white font-semibold rounded-md shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                    Crear nuevo formulario
                </a>


            </div>
        </div>
    </div>
</x-app-layout>

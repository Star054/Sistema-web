<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Vacunas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 text-left">Nombre</th>
                        <th class="px-6 py-3 text-left">Descripción</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($vacunas as $vacuna)
                        <tr>
                            <td class="px-6 py-4">{{ $vacuna->nombre_vacuna }}</td>
                            <td class="px-6 py-4">{{ $vacuna->descripcion }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('vacunas.edit', $vacuna) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                <form action="{{ route('vacunas.destroy', $vacuna) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar esta vacuna?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

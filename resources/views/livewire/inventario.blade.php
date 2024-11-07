<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Índice de Vacunas
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Filtro de Búsqueda -->
                    <input type="text" wire:model="search" placeholder="Buscar vacuna por nombre" class="border rounded px-3 py-2 mb-4">

                    <!-- Estadísticas -->
                    <div class="mb-4">
                        <p>Total de Vacunas Disponibles: <strong>{{ $totalVacunas }}</strong></p>
                        <p>Total de Vacunas Utilizadas: <strong>{{ $totalUtilizadas }}</strong></p>
                    </div>

                    <!-- Tabla de Vacunas -->
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Nombre de la Vacuna</th>
                            <th class="border border-gray-300 px-4 py-2">Descripción</th>
                            <th class="border border-gray-300 px-4 py-2">Unidad de Medida</th>
                            <th class="border border-gray-300 px-4 py-2">Tipo de Dosis</th>
                            <th class="border border-gray-300 px-4 py-2">Cantidad Solicitada</th>
                            <th class="border border-gray-300 px-4 py-2">Cantidad Total</th>
                            <th class="border border-gray-300 px-4 py-2">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vacunas as $vacuna)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->nombre_vacuna }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->descripcion }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->unidad_medida }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->tipo_dosis }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->cantidad_solicitada }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->cantidad_despachada }}</td>
                                <td class="border border-gray-300 px-4 py-2">

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

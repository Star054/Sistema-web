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


                    <form method="GET" action="{{ route('inventario.index') }}" class="mb-4">
                        <a href="{{ route('vacunas.inventario.historial') }}" class="btn btn-primary mb-3"
                           data-toggle="tooltip" data-placement="top" title="Ver el historial de cambios en el inventario">
                            <i class="fas fa-history"></i> Ver Historial de Inventario
                        </a>
                    </form>



                    <!-- Filtro de Búsqueda -->
                    <form method="GET" action="{{ route('inventario.index') }}" class="mb-4">
                        <input type="text" name="search" placeholder="Buscar vacuna por nombre"
                               value="{{ $search }}" class="border rounded px-3 py-2">
                        <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Buscar</button>
                    </form>

                    <!-- Estadísticas -->
                    <div class="mb-4">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-gray-100 p-4 rounded border border-gray-300">
                                <p class="font-semibold">Total de Vacunas Disponibles:</p>
                                <strong id="total-vacunas">{{ $totalVacunas }}</strong>
                            </div>
                            <div class="bg-gray-100 p-4 rounded border border-gray-300">
                                <p class="font-semibold">Total de Vacunas Utilizadas:</p>
                                <strong id="total-utilizadas">{{ $totalUtilizadas }}</strong>
                            </div>
                            <div class="bg-gray-100 p-4 rounded border border-gray-300">
                                <p class="font-semibold">Saldo Anterior:</p>
                                <strong id="saldo-anterior">{{ $saldoAnterior ?? 0 }}</strong>
                            </div>
                            <div class="bg-gray-100 p-4 rounded border border-gray-300">
                                <p class="font-semibold">Saldo Siguiente:</p>
                                <strong id="saldo-siguiente">{{ $saldoSiguiente ?? 0 }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Vacunas -->
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Nombre de la Vacuna</th>
                            <th class="border border-gray-300 px-4 py-2">Descripción</th>
                            <th class="border border-gray-300 px-4 py-2">Unidad de Medida</th>
                            <th class="border border-gray-300 px-4 py-2">Cantidad Inicial</th>
                            <th class="border border-gray-300 px-4 py-2">Cantidad Actual Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vacunas as $vacuna)
                            <tr data-id="{{ $vacuna->id }}">
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->nombre_vacuna }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->descripcion }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->unidad_medida }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $vacuna->cantidad_solicitada }}</td>
                                <td class="border border-gray-300 px-4 py-2 cantidad_despachada">{{ $vacuna->cantidad_despachada }}</td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>



    <!-- Script para manejo en tiempo real -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Aquí puedes agregar más scripts si lo necesitas
        });
    </script>
</x-app-layout>

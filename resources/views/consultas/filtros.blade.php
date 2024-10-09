<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Filtrar Pacientes Vacunados') }}
        </h2>
    </x-slot>

    <div>
        <x-barra-busqueda/>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Formulario para aplicar los filtros de vacuna -->
                    <form method="GET" action="{{ route('vacunas.resultados') }}" class="space-y-6">

                        <!-- Campo para seleccionar el tipo de formulario -->
                        <div class="space-y-2">
                            <label for="tipo_formulario" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Seleccionar tipo de formulario:</label>
                            <select name="tipo_formulario" id="tipo_formulario" required class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                <option value="SIGSA5b" {{ request()->input('tipo_formulario') == 'SIGSA5b' ? 'selected' : '' }}>SIGSA5b</option>
                                <option value="SIGSA3CS" {{ request()->input('tipo_formulario') == 'SIGSA5bA' ? 'selected' : '' }}>SIGSA3CS</option>
                            </select>
                        </div>

                        <!-- Campo para seleccionar la vacuna -->
                        <div class="space-y-2">
                            <label for="vacuna" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Seleccionar vacuna:</label>
                            <select name="vacuna" id="vacuna" required class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                                @foreach($vacunas as $vacunaItem)
                                    <option value="{{ $vacunaItem->nombre_vacuna }}" {{ request()->input('vacuna') == $vacunaItem->nombre_vacuna ? 'selected' : '' }}>
                                        {{ $vacunaItem->nombre_vacuna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo para seleccionar el mes -->
                        <div class="space-y-2">
                            <label for="mes" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Seleccionar mes:</label>
                            <input type="month" name="mes" id="mes" value="{{ request()->input('mes') }}" required class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>

                        <!-- Botón para aplicar los filtros -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Filtrar
                            </button>
                        </div>
                    </form>

                    <!-- Mostrar los resultados filtrados -->
                    @if(isset($resultados))
                        <div class="mt-8">
                            <h4 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Resultados:</h4>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                @foreach($resultados as $resultado)
                                    <p class="text-gray-700 dark:text-gray-300">{{ $resultado->campo_deseado }}</p> <!-- Reemplaza 'campo_deseado' por el campo real -->
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

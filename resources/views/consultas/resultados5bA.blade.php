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
                            @foreach($pacientes as $paciente)
                                <p class="text-gray-700 dark:text-gray-300">Nombre: {{ $paciente->nombre_paciente }}</p>
                                <p>Fecha de Administración: {{ $paciente->fecha_administracion }}</p> <!-- Correcto -->
                                <p class="text-gray-700 dark:text-gray-300">Dosis: {{ $paciente->dosis }}</p>
                                <p class="text-gray-700 dark:text-gray-300">Vacuna ID: {{ $paciente->vacuna_id }}</p>
                            @endforeach


                        </div>
                    </div>

                    <!-- Botón para generar PDF -->
                    <div class="mt-4">
                        <a href="{{ route('vacunas.pdf_5ba', ['pacientes' => $pacientes]) }}" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-500">
                            Generar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

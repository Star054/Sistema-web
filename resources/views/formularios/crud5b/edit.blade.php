<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Formulario FOR-SIGSA-5b') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form action="{{ route('for-sigsa-5b.update', ['for_sigsa_5b' => $formulario->id]) }}" method="POST">
                @csrf
                    @method('PUT') <!-- Directiva para actualizar -->

                  c

                    <!-- Sección de Vacunas para Mujer de 15 a 49 años -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Mujer de 15 a 49</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach (['1a', '2a', '3a', 'r1', 'r2'] as $dosis)
                                <div class="mb-4">
                                    <label for="vacuna_mujer_15_49_{{ $dosis }}" class="block text-gray-700 dark:text-gray-400">Vacuna Mujer 15-49 ({{ $dosis }})</label>
                                    <input type="date" name="vacuna_mujer_15_49[{{ $dosis }}]" id="vacuna_mujer_15_49_{{ $dosis }}"
                                           value="{{ old('vacuna_mujer_15_49.'.$dosis, $formulario->mujer15a49yOtrosGrupos->where('tipo_dosis', $dosis)->where('grupo', 'mujer_15_49')->first()->fecha_vacunacion ?? '') }}"
                                           class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sección de Vacunas para Otros Grupos -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Otros Grupos</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach (['1a', '2a', '3a', 'r1', 'r2'] as $dosis)
                                <div class="mb-4">
                                    <label for="vacuna_otros_grupos_{{ $dosis }}" class="block text-gray-700 dark:text-gray-400">Vacuna Otros Grupos ({{ $dosis }})</label>
                                    <input type="date" name="vacuna_otros_grupos[{{ $dosis }}]" id="vacuna_otros_grupos_{{ $dosis }}"
                                           value="{{ old('vacuna_otros_grupos.'.$dosis, $formulario->mujer15a49yOtrosGrupos->where('tipo_dosis', $dosis)->where('grupo', 'otros_grupos')->first()->fecha_vacunacion ?? '') }}"
                                           class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- Botón para actualizar -->
                    <div class="mt-8">
                        <x-primary-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-opacity-50 text-white font-semibold rounded-lg py-2 px-4 transition-all duration-300 ease-in-out">
                            {{ __('Actualizar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

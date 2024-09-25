<x-app-layout>
    <div class="container mx-auto px-4 py-6 space-y-8">

        <!-- Encabezado dinámico usando slot -->
        <div class=" bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">

        <x-formulario-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('REGISTRO DE VACUNACION PARA LA MUJER DE 15 A 49 AÑOS Y OTROS GRUPOS') }}
            </h2>
        </x-formulario-slot>
        </div>


        <br>
        <!-- Componente de datos paciente -->
        <div class=" bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
            <x-datosPaciente5b />
        </div>



        <br>
        <!-- Componente de residencia -->
        <div class=" bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
            <x-residencia />
        </div>

        <br>
        <!-- Componente de mujer 15 a 49 años y otros grupos -->
        <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
            <x-mujer15a49yOtrosGrupos />
        </div>

        <!-- Botón de guardar y notificación -->
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-opacity-50 text-white font-semibold rounded-lg py-2 px-4 transition-all duration-300 ease-in-out">
                {{ __('Guardar') }}
            </x-primary-button>

            @if (session('status') === 'form-saved')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400 transition-opacity duration-300"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </div>
</x-app-layout>

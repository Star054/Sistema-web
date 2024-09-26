<x-app-layout>
    <div class="container mx-auto px-4 py-6 space-y-8">

        <!-- Iniciar el formulario -->
        <form action="{{ route('for-sigsa-5b.store') }}" method="POST">
            @csrf  <!-- Token de seguridad de Laravel -->

            <!-- Inputs ocultos para el tipo de formulario -->
            <input type="hidden" name="codigo_formulario" value="FOR-SIGSA-5b">

            <!-- Encabezado dinámico usando slot para el título y select -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-formulario-slot
                    codigo="FOR-SIGSA-5b"
                    version="3.0"
                    vigencia="Noviembre 2017">
                    REGISTRO DE VACUNACION PARA LA MUJER DE 15 A 49 AÑOS Y OTROS GRUPOS
                    <br>
                    <div class="flex justify-end items-center mt-2">
                        <label for="vacuna" class="text-sm text-gray-600 dark:text-gray-400 mr-2">Seleccione la vacuna:</label>
                        <select name="vacuna" id="vacuna" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-1 rounded-md text-sm w-auto">
                            <option value="">Seleccione una vacuna</option>
                            @foreach($vacunas as $vacuna)
                                <option value="{{ $vacuna->nombre_vacuna }}">{{ $vacuna->nombre_vacuna }}</option>
                            @endforeach
                        </select>
                    </div>
                </x-formulario-slot>
            </div>

            <!-- Mensajes de validación -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Oops!</strong>
                    <span class="block sm:inline">Hay algunos problemas con tus datos:</span>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Componente de datos paciente -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-datosPaciente5b />
            </div>

            <br>

            <!-- Componente de residencia -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-residencia />
            </div>

            <br>

            <!-- Componente de mujer 15 a 49 años y otros grupos -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-mujer15a49yOtrosGrupos />
            </div>

            <br>

            <!-- Botón de guardar y notificación -->
            <div class="flex items-center gap-4 mt-6">
                <x-primary-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-opacity-50 text-white font-semibold rounded-lg py-2 px-4 transition-all duration-300 ease-in-out">
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
        </form> <!-- Fin del formulario -->
    </div>
</x-app-layout>

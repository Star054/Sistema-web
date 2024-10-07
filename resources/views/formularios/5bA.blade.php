<x-app-layout>
    <div class="container mx-auto px-4 py-6 space-y-8">

        <!-- Iniciar el formulario -->
        <form action="{{ route('for-sigsa-5bA.store') }}" method="POST">
            @csrf  <!-- Token de seguridad de Laravel -->

            <!-- Inputs ocultos para el tipo de formulario -->
            <input type="hidden" name="codigo_formulario" value="FOR-SIGSA-5bA">

            <!-- Encabezado dinámico usando slot para el título y select -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-formulario-slot
                    codigo="FOR-SIGSA-5bA"
                    version="4.2"
                    vigencia="14-02-2018">
                    REGISTRO DE VACUNACION EN OTROS GRUPOS DE POBLACION
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

            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <!-- Tabla de criterios de selección según vacuna administrada -->
                <div class="container mx-auto px-4 py-6">
                    <div class="w-3/4 overflow-x-auto">
                        <table class="table-auto w-3/4 border-collapse mb-6 border border-black dark:border-white">
                            <thead>
                            <tr>
                                <th colspan="4" class="border border-black dark:border-white p-2 text-center text-black dark:text-white">
                                    Criterios de selección según vacuna administrada
                                </th>
                            </tr>
                            <tr>
                                <th class="border border-black dark:border-white p-2 text-black dark:text-white">
                                    11/ Nombre de vacuna
                                </th>
                                <th class="border border-black dark:border-white p-2 text-black dark:text-white">
                                    12/ Grupo priorizado <br>
                                    <span class="text-sm">(escribir código según instructivo, en la parte posterior de la hoja)</span>
                                </th>
                                <th class="border border-black dark:border-white p-2 text-black dark:text-white">
                                    Fecha administración dosis <br> (dd/mm/aaaa)
                                </th>
                                <th class="border border-black dark:border-white p-2 text-black dark:text-white">
                                    13/ Dosis
                                </th>
                            </tr>

                            </thead>
                            <tbody>
                            <tr>

                                <!-- Select para la vacuna -->
                                <td class="border border-black dark:border-white p-0">
                                    <select name="vacuna_id" id="vacuna_id"
                                            class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                        <option value="">Seleccione una vacuna</option>
                                        @foreach($vacunas as $vacuna)
                                            <option value="{{ $vacuna->id }}" {{ old('vacuna_id') == $vacuna->id ? 'selected' : '' }}>
                                                {{ $vacuna->nombre_vacuna }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>


                                <!-- Campo para Grupo priorizado -->
                                <td class="border border-black dark:border-white p-0">
                                    <input type="text" name="grupo_priorizado" id="grupo_priorizado"
                                           value="{{ old('grupo_priorizado') }}"
                                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                           placeholder="Código grupo priorizado">
                                </td>

                                <!-- Campo para Fecha de administración -->
                                <td class="border border-black dark:border-white p-0">
                                    <input type="date" name="fecha_administracion" id="fecha_administracion"
                                           value="{{ old('fecha_administracion') }}"
                                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                </td>

                                <!-- Campo para Dosis -->
                                <td class="border border-black dark:border-white p-0">
                                    <input type="text" name="dosis" id="dosis"
                                           value="{{ old('dosis') }}"
                                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                           placeholder="Dosis">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

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

        <!-- Botones CRUD para la navegación -->
        <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
            <div class="container mx-auto px-3 py-5 space-y-5">
                <div class="flex justify-center space-x-5 mt-5">
                    <!-- Botón Listar Formularios -->
                    <a href="{{ route('for-sigsa-5bA.index') }}" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Ver lista de registros
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

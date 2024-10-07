<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Formulario FOR-SIGSA-5bA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Formulario de edición -->
                <form action="{{ route('for-sigsa-5bA.update', $formulario->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Directiva para actualizar -->

                    <!-- Sección de Información del Formulario -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Información adicional -->
                        <div class="mb-4">
                            <label for="area_salud" class="block text-gray-700 dark:text-gray-400">Área de Salud</label>
                            <input type="text" name="area_salud" id="area_salud" value="{{ $formulario->area_salud }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="distrito_salud" class="block text-gray-700 dark:text-gray-400">Distrito de Salud</label>
                            <input type="text" name="distrito_salud" id="distrito_salud" value="{{ $formulario->distrito_salud }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="municipio" class="block text-gray-700 dark:text-gray-400">Municipio</label>
                            <input type="text" name="municipio" id="municipio" value="{{ $formulario->municipio }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="servicio_salud" class="block text-gray-700 dark:text-gray-400">Servicio de Salud</label>
                            <input type="text" name="servicio_salud" id="servicio_salud" value="{{ $formulario->servicio_salud }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="responsable_informacion" class="block text-gray-700 dark:text-gray-400">Responsable de la Información</label>
                            <input type="text" name="responsable_informacion" id="responsable_informacion" value="{{ $formulario->responsable_informacion }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="cargo_responsable" class="block text-gray-700 dark:text-gray-400">Cargo del Responsable</label>
                            <input type="text" name="cargo_responsable" id="cargo_responsable" value="{{ $formulario->cargo_responsable }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="anio" class="block text-gray-700 dark:text-gray-400">Año</label>
                            <input type="text" name="anio" id="anio" value="{{ $formulario->anio }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>
                    </div>
                <div/>

                    <!-- Sección de Datos del Paciente -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Datos del Paciente</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="no_orden" class="block text-gray-700 dark:text-gray-400">No. Orden</label>
                                <input type="text" name="no_orden" id="no_orden" value="{{ $formulario->no_orden }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>
                            <div class="mb-4">
                                <label for="nombre_paciente" class="block text-gray-700 dark:text-gray-400">Nombre del Paciente</label>
                                <input type="text" name="nombre_paciente" id="nombre_paciente" value="{{ $formulario->nombre_paciente }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="cui" class="block text-gray-700 dark:text-gray-400">CUI</label>
                                <input type="text" name="cui" id="cui" value="{{ $formulario->cui }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="fecha_nacimiento" class="block text-gray-700 dark:text-gray-400">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $formulario->fecha_nacimiento }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="sexo" class="block text-gray-700 dark:text-gray-400">Sexo</label>
                                <select name="sexo" id="sexo" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    <option value="M" {{ $formulario->sexo === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ $formulario->sexo === 'F' ? 'selected' : '' }}>Femenino</option>
                                </select>
                            </div>



                            <div class="mb-4">
                                <label for="pueblo" class="block text-gray-700 dark:text-gray-400">Pueblo</label>
                                <input type="text" name="pueblo" id="pueblo" value="{{ $formulario->pueblo }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="comunidad_linguistica" class="block text-gray-700 dark:text-gray-400">Comunidad Lingüística</label>
                                <input type="text" name="comunidad_linguistica" id="comunidad_linguistica" value="{{ $formulario->comunidad_linguistica }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="escolaridad" class="block text-gray-700 dark:text-gray-400">Escolaridad</label>
                                <input type="text" name="escolaridad" id="escolaridad" value="{{ $formulario->escolaridad }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="profesion_oficio" class="block text-gray-700 dark:text-gray-400">Profesión u Oficio</label>
                                <input type="text" name="profesion_oficio" id="profesion_oficio" value="{{ $formulario->profesion_oficio }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Residencia -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Datos de Residencia</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="comunidad_direccion" class="block text-gray-700 dark:text-gray-400">Comunidad Dirección</label>
                                <input type="text" name="comunidad_direccion" id="comunidad_direccion"
                                       value="{{ old('comunidad_direccion', $formulario->residencia->comunidad_direccion ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="municipio_residencia" class="block text-gray-700 dark:text-gray-400">Municipio Residencia</label>
                                <input type="text" name="municipio_residencia" id="municipio_residencia"
                                       value="{{ old('municipio_residencia', $formulario->residencia->municipio_residencia ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="agricola_migrante" class="block text-gray-700 dark:text-gray-400">Agrícola Migrante</label>
                                <input type="checkbox" name="agricola_migrante" id="agricola_migrante"
                                       value="1" {{ old('agricola_migrante', $formulario->residencia->agricola_migrante ?? false) ? 'checked' : '' }}
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md">
                            </div>

                            <div class="mb-4">
                                <label for="embarazada" class="block text-gray-700 dark:text-gray-400">Embarazada</label>
                                <input type="checkbox" name="embarazada" id="embarazada"
                                       value="1" {{ old('embarazada', $formulario->residencia->embarazada ?? false) ? 'checked' : '' }}
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md">
                            </div>
                        </div>
                    </div>


                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Criterios de selección según vacuna administrada</h3>
                        <!-- Select para la vacuna -->
                        <div class="mb-4">
                            <!-- Select para la vacuna en la vista de edición -->
                            <td class="border border-black dark:border-white p-0">
                                <select name="vacuna_id" id="vacuna_id"
                                        class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                    <option value="">Seleccione una vacuna</option>
                                    @foreach($vacunas as $vacuna)
                                        <option value="{{ $vacuna->id }}" {{ old('vacuna_id', optional($formulario->criteriosVacuna->first())->vacuna_id) == $vacuna->id ? 'selected' : '' }}>
                                            {{ $vacuna->nombre_vacuna }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- Grupo priorizado -->
                        <div class="mb-4">
                            <label for="grupo_priorizado" class="block text-gray-700 dark:text-gray-400">Grupo Priorizado</label>
                            <input type="text" name="grupo_priorizado" id="grupo_priorizado"
                                   value="{{ optional($formulario->criteriosVacuna->first())->grupo_priorizado ?? '' }}"
                                   class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full"
                                   placeholder="Código grupo priorizado">
                        </div>

                        <!-- Fecha de administración -->
                        <div class="mb-4">
                            <label for="fecha_administracion" class="block text-gray-700 dark:text-gray-400">Fecha de Administración</label>
                            <input type="date" name="fecha_administracion" id="fecha_administracion"
                                   value="{{ optional($formulario->criteriosVacuna->first())->fecha_administracion ?? '' }}"
                                   class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <!-- Dosis -->
                        <div class="mb-4">
                            <label for="dosis" class="block text-gray-700 dark:text-gray-400">Dosis</label>
                            <input type="number" step="0.01" name="dosis" id="dosis"
                                   value="{{ optional($formulario->criteriosVacuna->first())->dosis ?? '' }}"
                                   class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full"
                                   placeholder="Dosis">
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

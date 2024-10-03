<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Formulario FOR-SIGSA-5b') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Formulario de edición -->
                <form action="{{ route('for-sigsa-5b.update', $formulario->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Directiva para actualizar -->

                    <!-- Sección de Información del Formulario -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Select de vacuna -->
                        <div class="mb-4">
                            <label for="vacuna" class="block text-gray-700 dark:text-gray-400">Vacuna</label>
                            <select name="vacuna" id="vacuna" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                @foreach ($vacunas as $vacuna)
                                    <option value="{{ $vacuna->nombre_vacuna }}" {{ $formulario->vacuna === $vacuna->nombre_vacuna ? 'selected' : '' }}>
                                        {{ $vacuna->nombre_vacuna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

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



                    <!-- Sección de Vacunas -->
                    <!-- Campos relacionados con las vacunas para mujer de 15-49 años -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Mujer de 15 a 49</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="vacuna_mujer_15_49_1a" class="block text-gray-700 dark:text-gray-400">Vacuna Mujer 15-49 (1a)</label>
                                <input type="date" name="vacuna_mujer_15_49_1a" id="vacuna_mujer_15_49_1a"
                                       value="{{ old('vacuna_mujer_15_49_1a', $formulario->mujer15a49yOtrosGrupos->vacuna_mujer_15_49_1a ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="vacuna_mujer_15_49_2a" class="block text-gray-700 dark:text-gray-400">Vacuna Mujer 15-49 (2a)</label>
                                <input type="date" name="vacuna_mujer_15_49_2a" id="vacuna_mujer_15_49_2a"
                                       value="{{ old('vacuna_mujer_15_49_2a', $formulario->mujer15a49yOtrosGrupos->vacuna_mujer_15_49_2a ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="vacuna_mujer_15_49_3a" class="block text-gray-700 dark:text-gray-400">Vacuna Mujer 15-49 (3a)</label>
                                <input type="date" name="vacuna_mujer_15_49_3a" id="vacuna_mujer_15_49_3a"
                                       value="{{ old('vacuna_mujer_15_49_3a', $formulario->mujer15a49yOtrosGrupos->vacuna_mujer_15_49_3a ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="vacuna_mujer_15_49_r1" class="block text-gray-700 dark:text-gray-400">Refuerzo Mujer 15-49 (R1)</label>
                                <input type="date" name="vacuna_mujer_15_49_r1" id="vacuna_mujer_15_49_r1"
                                       value="{{ old('vacuna_mujer_15_49_r1', $formulario->mujer15a49yOtrosGrupos->vacuna_mujer_15_49_r1 ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="vacuna_mujer_15_49_r2" class="block text-gray-700 dark:text-gray-400">Refuerzo Mujer 15-49 (R2)</label>
                                <input type="date" name="vacuna_mujer_15_49_r2" id="vacuna_mujer_15_49_r2"
                                       value="{{ old('vacuna_mujer_15_49_r2', $formulario->mujer15a49yOtrosGrupos->vacuna_mujer_15_49_r2 ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>
                        </div>
                    </div>

                    <!-- Campos vacunas para otros grupos -->
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Otros Grupos</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Campos relacionados con las vacunas para otros grupos -->
                                    <div class="mb-4">
                                        <label for="vacuna_otros_grupos_1a" class="block text-gray-700 dark:text-gray-400">Vacuna Otros Grupos (1a)</label>
                                        <input type="date" name="vacuna_otros_grupos_1a" id="vacuna_otros_grupos_1a"
                                               value="{{ old('vacuna_otros_grupos_1a', $formulario->mujer15a49yOtrosGrupos->vacuna_otros_grupos_1a ?? '') }}"
                                               class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    </div>

                                    <div class="mb-4">
                                        <label for="vacuna_otros_grupos_2a" class="block text-gray-700 dark:text-gray-400">Vacuna Otros Grupos (2a)</label>
                                        <input type="date" name="vacuna_otros_grupos_2a" id="vacuna_otros_grupos_2a"
                                               value="{{ old('vacuna_otros_grupos_2a', $formulario->mujer15a49yOtrosGrupos->vacuna_otros_grupos_2a ?? '') }}"
                                               class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    </div>

                                    <div class="mb-4">
                                        <label for="vacuna_otros_grupos_3a" class="block text-gray-700 dark:text-gray-400">Vacuna Otros Grupos (3a)</label>
                                        <input type="date" name="vacuna_otros_grupos_3a" id="vacuna_otros_grupos_3a"
                                               value="{{ old('vacuna_otros_grupos_3a', $formulario->mujer15a49yOtrosGrupos->vacuna_otros_grupos_3a ?? '') }}"
                                               class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    </div>

                                    <div class="mb-4">
                                        <label for="vacuna_otros_grupos_r1" class="block text-gray-700 dark:text-gray-400">Refuerzo Otros Grupos (R1)</label>
                                        <input type="date" name="vacuna_otros_grupos_r1" id="vacuna_otros_grupos_r1"
                                               value="{{ old('vacuna_otros_grupos_r1', $formulario->mujer15a49yOtrosGrupos->vacuna_otros_grupos_r1 ?? '') }}"
                                               class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    </div>

                                    <div class="mb-4">
                                        <label for="vacuna_otros_grupos_r2" class="block text-gray-700 dark:text-gray-400">Refuerzo Otros Grupos (R2)</label>
                                        <input type="date" name="vacuna_otros_grupos_r2" id="vacuna_otros_grupos_r2"
                                               value="{{ old('vacuna_otros_grupos_r2', $formulario->mujer15a49yOtrosGrupos->vacuna_otros_grupos_r2 ?? '') }}"
                                               class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    </div>
                                </div>
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

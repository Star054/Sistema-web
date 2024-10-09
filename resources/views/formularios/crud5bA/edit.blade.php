<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Formulario FOR-SIGSA-5bA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario de edición -->
                <form action="{{ route('for-sigsa-5bA.update', $formulario->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Directiva para actualizar -->

                    <!-- Sección de Información del Formulario -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Información adicional -->
                        <div class="mb-4">
                            <label for="area_salud" class="block text-gray-700 dark:text-gray-400">Área de Salud</label>
                            <input type="text" name="area_salud" id="area_salud" value="{{ old('area_salud', $formulario->area_salud) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="distrito_salud" class="block text-gray-700 dark:text-gray-400">Distrito de Salud</label>
                            <input type="text" name="distrito_salud" id="distrito_salud" value="{{ old('distrito_salud', $formulario->distrito_salud) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="municipio" class="block text-gray-700 dark:text-gray-400">Municipio</label>
                            <input type="text" name="municipio" id="municipio" value="{{ old('municipio', $formulario->municipio) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="servicio_salud" class="block text-gray-700 dark:text-gray-400">Servicio de Salud</label>
                            <input type="text" name="servicio_salud" id="servicio_salud" value="{{ old('servicio_salud', $formulario->servicio_salud) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="responsable_informacion" class="block text-gray-700 dark:text-gray-400">Responsable de la Información</label>
                            <input type="text" name="responsable_informacion" id="responsable_informacion" value="{{ old('responsable_informacion', $formulario->responsable_informacion) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="cargo_responsable" class="block text-gray-700 dark:text-gray-400">Cargo del Responsable</label>
                            <input type="text" name="cargo_responsable" id="cargo_responsable" value="{{ old('cargo_responsable', $formulario->cargo_responsable) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="anio" class="block text-gray-700 dark:text-gray-400">Año</label>
                            <input type="text" name="anio" id="anio" value="{{ old('anio', $formulario->anio) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>
                    </div>

                    <!-- Sección de Datos del Paciente -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Datos del Paciente</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="no_orden" class="block text-gray-700 dark:text-gray-400">No. Orden</label>
                                <input type="text" name="no_orden" id="no_orden" value="{{ old('no_orden', $formulario->no_orden) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>
                            <div class="mb-4">
                                <label for="nombre_paciente" class="block text-gray-700 dark:text-gray-400">Nombre del Paciente</label>
                                <input type="text" name="nombre_paciente" id="nombre_paciente" value="{{ old('nombre_paciente', $formulario->nombre_paciente) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="cui" class="block text-gray-700 dark:text-gray-400">CUI</label>
                                <input type="text" name="cui" id="cui" value="{{ old('cui', $formulario->cui) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="fecha_nacimiento" class="block text-gray-700 dark:text-gray-400">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $formulario->fecha_nacimiento) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
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
                                <input type="text" name="pueblo" id="pueblo" value="{{ old('pueblo', $formulario->pueblo) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="comunidad_linguistica" class="block text-gray-700 dark:text-gray-400">Comunidad Lingüística</label>
                                <input type="text" name="comunidad_linguistica" id="comunidad_linguistica" value="{{ old('comunidad_linguistica', $formulario->comunidad_linguistica) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="escolaridad" class="block text-gray-700 dark:text-gray-400">Escolaridad</label>
                                <input type="text" name="escolaridad" id="escolaridad" value="{{ old('escolaridad', $formulario->escolaridad) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="profesion_oficio" class="block text-gray-700 dark:text-gray-400">Profesión u Oficio</label>
                                <input type="text" name="profesion_oficio" id="profesion_oficio" value="{{ old('profesion_oficio', $formulario->profesion_oficio) }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
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

                    <!-- Sección de Criterios de selección según vacuna administrada -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Criterios de selección según vacuna administrada</h3>

                        <!-- Select para la vacuna -->
                        <div class="mb-4">
                            <label for="vacuna_id" class="block text-gray-700 dark:text-gray-400">Vacuna</label>
                            <select name="vacuna" id="vacuna" required
                                    class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                                @foreach($vacunas as $vacuna)
                                    <option value="{{ $vacuna->nombre_vacuna }}" {{ optional($formulario->criteriosVacuna->first())->vacuna == $vacuna->nombre_vacuna ? 'selected' : '' }}>
                                        {{ $vacuna->nombre_vacuna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Grupo priorizado -->
                        <div class="mb-4">
                            <label for="grupo_priorizado" class="block text-gray-700 dark:text-gray-400">Grupo Priorizado</label>
                            <input type="text" name="grupo_priorizado" id="grupo_priorizado"
                                   value="{{ old('grupo_priorizado', optional($formulario->criteriosVacuna->first())->grupo_priorizado) }}"
                                   class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full"
                                   placeholder="Grupo priorizado">
                        </div>

                        <!-- Fecha de administración -->
                        <div class="mb-4">
                            <label for="fecha_administracion" class="block text-gray-700 dark:text-gray-400">Fecha de Administración</label>
                            <input type="date" name="fecha_administracion" id="fecha_administracion"
                                   value="{{ old('fecha_administracion', optional($formulario->criteriosVacuna->first())->fecha_administracion) }}"
                                   class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>


                        <div class="mb-4">
                            <label for="dosis" class="block text-gray-700 dark:text-gray-400">Dosis</label>
                            <input type="text" name="dosis" id="dosis"
                                   value="{{ old('dosis', optional($formulario->criteriosVacuna->first())->dosis) }}"
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

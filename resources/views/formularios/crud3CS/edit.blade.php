<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Formulario 3CS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('formularios-3cs.update', $formulario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo Nombre Paciente -->
                    <div class="mb-4">
                        <label for="nombre_paciente" class="block text-sm font-medium text-gray-700">Nombre Paciente</label>
                        <input type="text" name="nombre_paciente" id="nombre_paciente" value="{{ old('nombre_paciente', $formulario->nombre_paciente) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Campo CUI -->
                    <div class="mb-4">
                        <label for="cui" class="block text-sm font-medium text-gray-700">CUI</label>
                        <input type="text" name="cui" id="cui" value="{{ old('cui', $formulario->cui) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Campo Sexo -->
                    <div class="mb-4">
                        <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                        <input type="text" name="sexo" id="sexo" value="{{ old('sexo', $formulario->sexo) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Campo Día de Consulta -->
                    <div class="mb-4">
                        <label for="dia_consulta" class="block text-sm font-medium text-gray-700">Día de Consulta</label>
                        <input type="date" name="dia_consulta" id="dia_consulta" value="{{ old('dia_consulta', $formulario->dia_consulta) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Campo No. Historia Clínica -->
                    <div class="mb-4">
                        <label for="no_historia_clinica" class="block text-sm font-medium text-gray-700">No. Historia Clínica</label>
                        <input type="text" name="no_historia_clinica" id="no_historia_clinica" value="{{ old('no_historia_clinica', $formulario->no_historia_clinica) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Otros Campos -->
                    <div class="mb-4">
                        <label for="area_salud" class="block text-sm font-medium text-gray-700">Área de Salud</label>
                        <input type="text" name="area_salud" id="area_salud" value="{{ old('area_salud', $formulario->area_salud) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="distrito_salud" class="block text-sm font-medium text-gray-700">Distrito de Salud</label>
                        <input type="text" name="distrito_salud" id="distrito_salud" value="{{ old('distrito_salud', $formulario->distrito_salud) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="municipio" class="block text-sm font-medium text-gray-700">Municipio</label>
                        <label for="municipio" class="block text-sm font-medium text-gray-700">Municipio</label>
                        <input type="text" name="municipio" id="municipio" value="{{ old('municipio', $formulario->municipio) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="servicio_salud" class="block text-sm font-medium text-gray-700">Servicio de Salud</label>
                        <input type="text" name="servicio_salud" id="servicio_salud" value="{{ old('servicio_salud', $formulario->servicio_salud) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="responsable_informacion" class="block text-sm font-medium text-gray-700">Responsable de Información</label>
                        <input type="text" name="responsable_informacion" id="responsable_informacion" value="{{ old('responsable_informacion', $formulario->responsable_informacion) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="cargo_responsable" class="block text-sm font-medium text-gray-700">Cargo del Responsable</label>
                        <input type="text" name="cargo_responsable" id="cargo_responsable" value="{{ old('cargo_responsable', $formulario->cargo_responsable) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="anio" class="block text-sm font-medium text-gray-700">Año</label>
                        <input type="number" name="anio" id="anio" value="{{ old('anio', $formulario->anio) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="pueblo" class="block text-sm font-medium text-gray-700">Pueblo</label>
                        <input type="text" name="pueblo" id="pueblo" value="{{ old('pueblo', $formulario->pueblo) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $formulario->fecha_nacimiento) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="comunidad_linguistica" class="block text-sm font-medium text-gray-700">Comunidad Lingüística</label>
                        <input type="text" name="comunidad_linguistica" id="comunidad_linguistica" value="{{ old('comunidad_linguistica', $formulario->comunidad_linguistica) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="orientacion_sexual" class="block text-sm font-medium text-gray-700">Orientación Sexual</label>
                        <input type="text" name="orientacion_sexual" id="orientacion_sexual" value="{{ old('orientacion_sexual', $formulario->orientacion_sexual) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="escolaridad" class="block text-sm font-medium text-gray-700">Escolaridad</label>
                        <input type="text" name="escolaridad" id="escolaridad" value="{{ old('escolaridad', $formulario->escolaridad) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="profesion_oficio" class="block text-sm font-medium text-gray-700">Profesión u Oficio</label>
                        <input type="text" name="profesion_oficio" id="profesion_oficio" value="{{ old('profesion_oficio', $formulario->profesion_oficio) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="comunidad_direccion" class="block text-sm font-medium text-gray-700">Dirección de Comunidad</label>
                        <input type="text" name="comunidad_direccion" id="comunidad_direccion" value="{{ old('comunidad_direccion', $formulario->residencia->comunidad_direccion ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="municipio_residencia" class="block text-sm font-medium text-gray-700">Municipio de Residencia</label>
                        <input type="text" name="municipio_residencia" id="municipio_residencia" value="{{ old('municipio_residencia', $formulario->residencia->municipio_residencia ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="agricola_migrante" class="block text-sm font-medium text-gray-700">Agrícola Migrante</label>
                        <input type="checkbox" name="agricola_migrante" id="agricola_migrante" {{ old('agricola_migrante', $formulario->residencia->agricola_migrante ?? false) ? 'checked' : '' }}>
                    </div>

                    <!-- Campos de Consulta -->
                    <div class="mb-4">
                        <label for="consulta" class="block text-sm font-medium text-gray-700">Consulta</label>
                        <input type="text" name="consulta" id="consulta" value="{{ old('consulta', $formulario->consulta->consulta ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="control" class="block text-sm font-medium text-gray-700">Control</label>
                        <input type="text" name="control" id="control" value="{{ old('control', $formulario->consulta->control ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="semana_gestacion" class="block text-sm font-medium text-gray-700">Semana de Gestación</label>
                        <input type="number" name="semana_gestacion" id="semana_gestacion" value="{{ old('semana_gestacion', $formulario->consulta->semana_gestacion ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="referido_a" class="block text-sm font-medium text-gray-700">Referido a</label>
                        <input type="text" name="referido_a" id="referido_a" value="{{ old('referido_a', $formulario->consulta->referido_a ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="diagnostico" class="block text-sm font-medium text-gray-700">Diagnóstico</label>
                        <textarea name="diagnostico" id="diagnostico" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('diagnostico', $formulario->consulta->diagnostico ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="codigo_cie" class="block text-sm font-medium text-gray-700">Código CIE</label>
                        <input type="text" name="codigo_cie" id="codigo_cie" value="{{ old('codigo_cie', $formulario->consulta->codigo_cie ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="tratamiento_descripcion" class="block text-sm font-medium text-gray-700">Descripción del Tratamiento</label>
                        <textarea name="tratamiento_descripcion" id="tratamiento_descripcion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('tratamiento_descripcion', $formulario->consulta->tratamiento_descripcion ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="tratamiento_presentacion" class="block text-sm font-medium text-gray-700">Presentación del Tratamiento</label>
                        <input type="text" name="tratamiento_presentacion" id="tratamiento_presentacion" value="{{ old('tratamiento_presentacion', $formulario->consulta->tratamiento_presentacion ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="cantidad_recetada" class="block text-sm font-medium text-gray-700">Cantidad Recetada</label>
                        <input type="number" name="cantidad_recetada" id="cantidad_recetada" value="{{ old('cantidad_recetada', $formulario->consulta->cantidad_recetada ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="notificacion_lugar" class="block text-sm font-medium text-gray-700">Lugar de Notificación</label>
                        <input type="text" name="notificacion_lugar" id="notificacion_lugar" value="{{ old('notificacion_lugar', $formulario->consulta->notificacion_lugar ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="notificacion_numero" class="block text-sm font-medium text-gray-700">Número de Notificación</label>
                        <input type="text" name="notificacion_numero" id="notificacion_numero" value="{{ old('notificacion_numero', $formulario->consulta->notificacion_numero ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="nombre_acompanante" class="block text-sm font-medium text-gray-700">Nombre del Acompañante</label>
                        <input type="text" name="nombre_acompanante" id="nombre_acompanante" value="{{ old('nombre_acompanante', $formulario->consulta->nombre_acompanante ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mt-8">
                        <x-primary-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-opacity-50 text-white font-semibold rounded-lg py-2 px-4 transition-all duration-300 ease-in-out">
                            {{ __('Actualizar') }}
                        </x-primary-button>
                    </div>
                </form>


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

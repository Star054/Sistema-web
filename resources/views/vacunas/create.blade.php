<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Requisiciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenedor principal con el mismo color de fondo -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Sección superior -->
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="mt-8 text-2xl text-gray-800 dark:text-gray-100">
                        Formulario para registrar una nueva vacuna
                    </div>

                    <div class="mt-6 text-gray-500 dark:text-gray-400">
                        Completa los datos para registrar una nueva vacuna en el sistema.
                    </div>
                </div>

                <!-- Contenedor interior con el mismo color que el contenedor exterior -->
                <div class="p-6 bg-white dark:bg-gray-800">
                    <!-- Mostrar mensajes de éxito -->
                    @if (session('status') === 'form-saved')
                        <div class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 mb-4" role="alert">
                            <p>{{ __('Vacuna guardada exitosamente.') }}</p>
                        </div>
                    @endif

                    <!-- Mostrar errores de validación -->
                    @if ($errors->any())
                        <div class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 text-red-700 dark:text-red-300 p-4 mb-4" role="alert">
                            <p><strong>¡Error!</strong> Por favor corrige los siguientes errores:</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario -->
                    <form action="{{ route('vacunas.store') }}" method="POST">
                        @csrf

                        <!-- Nombre de la vacuna -->
                        <div class="mb-4">
                            <label for="nombre_vacuna" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nombre de la Vacuna:</label>
                            <input type="text" name="nombre_vacuna" id="nombre_vacuna" value="{{ old('nombre_vacuna') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nombre_vacuna') border-red-500 @enderror" required>

                            <!-- Mostrar errores específicos del campo 'nombre_vacuna' -->
                            @error('nombre_vacuna')
                            <p class="text-red-500 dark:text-red-300 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Descripción (Opcional):</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>

                            <!-- Mostrar errores específicos del campo 'descripcion' -->
                            @error('descripcion')
                            <p class="text-red-500 dark:text-red-300 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botón de guardar -->
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

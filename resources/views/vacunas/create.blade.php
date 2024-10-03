<!-- resources/views/vacunas/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar nueva vacuna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Formulario para registrar una nueva vacuna
                    </div>

                    <div class="mt-6 text-gray-500">
                        Completa los datos para registrar una nueva vacuna en el sistema.
                    </div>
                </div>

                <div class="p-6">
                    <!-- Mostrar mensajes de éxito -->
                    @if (session('status') === 'form-saved')
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ __('Vacuna guardada exitosamente.') }}</p>
                        </div>
                    @endif

                    <!-- Mostrar errores de validación -->
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p><strong>¡Error!</strong> Por favor corrige los siguientes errores:</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li> <!-- Aquí se listarán todos los errores -->
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario -->
                    <form action="{{ route('vacunas.store') }}" method="POST">
                        @csrf

                        <!-- Nombre de la vacuna -->
                        <div class="mb-4">
                            <label for="nombre_vacuna" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Vacuna:</label>
                            <input type="text" name="nombre_vacuna" id="nombre_vacuna" value="{{ old('nombre_vacuna') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nombre_vacuna') border-red-500 @enderror" required>

                            <!-- Mostrar errores específicos del campo 'nombre_vacuna' -->
                            @error('nombre_vacuna')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción (Opcional):</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>

                            <!-- Mostrar errores específicos del campo 'descripcion' -->
                            @error('descripcion')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
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

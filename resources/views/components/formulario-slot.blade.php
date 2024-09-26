<div class="container mx-auto px-4 py-6">
    <!-- Encabezado del Formulario -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse mb-6 border border-black dark:border-white">
            <tr>
                <!-- Logos -->

                <td class="border-2 border-black dark:border-white p-2">
                    <div class="flex items-center">
                        <img src="{{ asset('logos/logo.jpg') }}" alt="Logo 1" style="width: 64px; height: auto;" class="mr-4"> <!-- Tamaño forzado -->
                        <img src="{{ asset('logos/logo2.jpg') }}" alt="Logo 2" style="width: 64px; height: auto;"> <!-- Tamaño forzado -->
                    </div>
                </td>

                <!-- Título y selección de vacuna -->
                <th class="border border-black dark:border-white p-6 text-2xl text-center w-3/5 text-gray-900 dark:text-gray-100">
                    <strong>{{ $slot }}</strong>

                </th>


                <!-- Información del formulario -->
                <td class="w-1/5 border border-black dark:border-white p-4 text-sm text-gray-600 dark:text-gray-400">
                    <ul class="list-none p-0 m-0">
                        <li><strong>Código:</strong> {{ $codigo }}</li>
                        <li><strong>Versión:</strong> {{ $version }}</li>
                        <li><strong>Vigente a partir de:</strong> {{ $vigencia }}</li>
                    </ul>
                </td>
        </table>
    </div>

    <!-- Área de Salud y detalles -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse mb-6 border border-black dark:border-white">
            <tr>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Área de Salud:</label>
                    <input type="text" name="area_salud" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </td>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Distrito de Salud:</label>
                    <input type="text" name="distrito_salud" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </td>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Municipio:</label>
                    <input type="text" name="municipio" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </td>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Servicio de Salud:</label>
                    <input type="text" name="servicio_salud" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </td>
            </tr>

            <tr>
                <td colspan="2" class="p-2">
                    <label class="text-gray-700 dark:text-gray-300">Responsable de la Información:</label>
                    <input type="text" name="responsable_informacion" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </td>
                <td class="p-2">
                    <label class="text-gray-700 dark:text-gray-300">Cargo:</label>
                    <input type="text" name="cargo_responsable" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </td>
                <td class="p-2">
                    <label class="text-gray-700 dark:text-gray-300">Firma:</label>
                    <div class="text-center">  </div>
                </td>
                <td class="p-2">
                    <label class="text-gray-700 dark:text-gray-300">Año:</label>
                    <input type="text" name="anio" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </td>
            </tr>
        </table>
    </div>
</div>

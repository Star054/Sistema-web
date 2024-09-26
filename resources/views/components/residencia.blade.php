<div class="container mx-auto px-4 py-6">
    <!-- Encabezado del Formulario -->
    <div class="w-3/4 overflow-x-auto">
        <table class="able-auto w-3/4 border-collapse mb-6 border border-black dark:border-white">
            <thead>
            <tr>
                <th colspan="2" class="border border-black dark:border-white p-2 text-center text-black dark:text-white">
                    Residencia
                </th>
                <th rowspan="2" class="border border-black dark:border-white p-2 text-center text-black dark:text-white">
                    9/ Agrícola Migrante
                </th>
                <th rowspan="2" class="border border-black dark:border-white p-2 text-center text-black dark:text-white">
                    10/ Embarazada?
                </th>
            </tr>
            <tr>
                <th class="border border-black dark:border-white p-2 text-black dark:text-white">
                    Comunidad y/o dirección exacta
                </th>
                <th class="border border-black dark:border-white p-2 text-black dark:text-white">
                    Municipio
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <!-- Campo de entrada para Comunidad y/o dirección exacta -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="comunidad_direccion" id="comunidad_direccion"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                </td>

                <!-- Campo de entrada para Municipio -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="municipio_residencia" id="municipio_residencia"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                </td>

                <!-- Selector para Agrícola Migrante -->
                <td class="border border-black dark:border-white p-0">
                    <select name="agricola_migrante" id="agricola_migrante"
                            class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </td>

                <!-- Selector para Embarazada -->
                <td class="border border-black dark:border-white p-0">
                    <select name="embarazada" id="embarazada"
                            class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

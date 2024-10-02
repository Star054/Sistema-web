<div class="container mx-auto px-4 py-6">
    <!-- Motivo de consulta y tratamiento -->
    <div class="overflow-x-auto">
        <!-- Tratamiento y medicación formulada -->
        <table class="table-auto w-full border-collapse mb-6 border border-black dark:border-white">
            <thead>
            <t>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Descripción</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Presentación</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Cantidad Recetada</th>

                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Lugar</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Número</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Nombres y apellidos del acompañante</th>
            </t>
            </thead>
            <tbody>
            <tr>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="tratamiento_descripcion"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="tratamiento_presentacion"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="cantidad_recetada"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>

                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="notificacion_lugar"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="notificacion_numero"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="nombre_acompanante" c
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="container mx-auto px-4 py-6">
    <!-- Tabla principal para Consulta, Control, etc. -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse mb-6 border border-black dark:border-white">
            <thead>
            <tr>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Consulta</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Control</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Semana de gestación</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Vive</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Fue</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Referido a</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Descripción de diagnóstico/control</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Código CIE-10</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="consulta"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="control"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="semana_gestacion"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="vive"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="fue"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="referido_a"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="diagnostico_control"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <td class="border border-black dark:border-white p-0">
                    <textarea type="text" name="codigo_cie"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           rows="1"
                           oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

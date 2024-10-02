@props(['mostrarNoOrden' => true, 'mostrarDiaConsulta' => false, 'mostrarHistoriaClinica' => false])

<div class="container mx-auto px-4 py-6">
    <!-- Tabla de datos del paciente -->
    <div class="overflow-x-auto">
        <table class="table-auto h-8 border-collapse mb-6 border border-black dark:border-white">
            <thead>
            <tr>
                <!-- Mostrar No. Orden solo si está habilitado -->
                @if($mostrarNoOrden)
                    <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">No. Orden</th>
                @endif
                <!-- Mostrar Día de la Consulta solo si está habilitado -->
                @if($mostrarDiaConsulta)
                    <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Día de la Consulta</th>
                @endif
                <!-- Mostrar No. Historia Clínica solo si está habilitado -->
                @if($mostrarHistoriaClinica)
                    <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">No. Historia Clínica</th>
                @endif
                <th class="w-full border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100 w-1/3">
                    Nombres y apellidos del paciente
                </th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">CUI Código Único de Identificación</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">Sexo</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">Pueblo</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">4/ Fecha de nacimiento o edad</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">Comunidad lingüística</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">6/ Orientación Sexual</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">7/ Escolaridad</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">8/ Profesión u oficio</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <!-- Mostrar No. Orden solo si está habilitado -->
                @if($mostrarNoOrden)
                    <td class="border border-black dark:border-white p-0">
                        <input type="text" name="no_orden"
                               class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    </td>
                @endif

                <!-- Mostrar Día de la Consulta solo si está habilitado -->
                @if($mostrarDiaConsulta)
                    <td class="border border-black dark:border-white p-0">
                        <input type="date" name="dia_consulta"
                               class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    </td>
                @endif

                <!-- Mostrar No. Historia Clínica solo si está habilitado -->
                @if($mostrarHistoriaClinica)
                    <td class="border border-black dark:border-white p-0">
                        <textarea name="no_historia_clinica"
                                  class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                  rows="1"
                                  oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                    </td>
                @endif

                <!-- Nombres y apellidos del paciente -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="nombre_paciente" maxlength="40"
                              class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <!-- CUI Código Único de Identificación -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="cui" maxlength="13" pattern="\d{13}"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                </td>
                <!-- Sexo -->
                <td class="border border-black dark:border-white p-0">
                    <select name="sexo" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                        <option value="">Seleccione el sexo</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </td>

                <!-- Pueblo -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="pueblo" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <!-- Fecha de nacimiento o edad -->
                <td class="w-3/4 border border-black dark:border-white p-0">
                    <input type="date" name="fecha_nacimiento"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                </td>
                <!-- Comunidad lingüística -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="comunidad_linguistica" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>

                <!-- Orientación Sexual -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="orientacion_sexual" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <!-- Escolaridad -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="escolaridad" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
                <!-- Profesión u oficio -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="profesion_oficio" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

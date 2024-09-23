<div class="container">
    <!-- Encabezado del Formulario -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="width: 15%; border: 2px solid black; padding: 1px;">
                <div style="display: flex; align-items: center;">
                    <img src="{{ asset('logos/logo.jpg') }}" alt="Logo 1" style="width: 100px; margin-right: 10px;">
                    <img src="{{ asset('logos/logo2.jpg') }}" alt="Logo 2" style="width: 100px;">
                </div>
            </td>

            <th style="border: 1px solid black; padding: 15px; font-size: 24px; text-align: center; width: 70%;">
                <strong>REGISTRO DE VACUNACIÓN PARA LA MUJER DE 15 A 49 AÑOS Y OTROS GRUPOS</strong>
                <!-- Campo de selección de vacuna agregado dentro del mismo th -->
                <br>
                <label for="vacuna" style="font-size: 12px;">Seleccione la vacuna:</label>
                <select id="id_vacuna" name="id_vacuna" style="border: 1px solid black; padding: 5px; width: 200px; font-size: 12px;">
                    <option value="" disabled selected>Seleccione una vacuna</option>
                    {{-- @foreach($vacunas as $vacuna) --}}
                    {{--     <option value="{{ $vacuna->id }}">{{ $vacuna->nombre_vacuna }}</option> --}}
                    {{-- @endforeach --}}
                </select>
            </th>

            <td style="width: 15%; border: 1px solid black;">
                <ul style="list-style-type: none; padding: 10px; margin: 0;">
                    <li><strong>Código:</strong> FOR-SIGSA-5b</li>
                    <li><strong>Versión:</strong> 3.0</li>
                    <li><strong>Vigente a partir de:</strong> Noviembre 2017</li>
                </ul>
            </td>
        </tr>
    </table>

    <!-- Área de Salud y detalles -->

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 17px;">
        <tr>
            <td style="width: 25%; padding: 2px;">
                <label>Área de Salud:</label>
                <input type="text" style="border:none; border-bottom:1px solid black; width:100%; height: 17px;">
            </td>
            <td style="width: 25%; padding: 2px;">
                <label>Distrito de Salud:</label>
                <input type="text" style="border:none; border-bottom:1px solid black; width:100%; height: 17px;">
            </td>
            <td style="width: 25%; padding: 2px;">
                <label>Municipio:</label>
                <input type="text" style="border:none; border-bottom:1px solid black; width:100%; height: 17px;">
            </td>
            <td style="width: 25%; padding: 2px;">
                <label>Servicio de Salud:</label>
                <input type="text" style="border:none; border-bottom:1px solid black; width:100%; height: 17px;">
            </td>
        </tr>

        <tr>
            <td colspan="2" style="padding: 2px;">
                <label>Responsable de la Información:</label>
                <input type="text" style="border:none; border-bottom:1px solid black; width:100%; height: 17px;">
            </td>
            <td style="padding: 2px;">
                <label>Cargo:</label>
                <input type="text" style="border:none; border-bottom:1px solid black; width:100%; height: 17px;">
            </td>
            <td style="padding: 2px; width: 15%;">
                <label>Firma:</label>
                <div style="text-align: -webkit-center;">__________________________</div> <!-- Línea en lugar de input -->
            </td>
            <td style="padding: 2px; width: 20%; min-width: 150px;">
                <label>Año:</label>
                <input type="text" style="border:none; border-bottom:1px solid black; width:100%; height: 17px;">
            </td>
        </tr>
    </table>

    <!-- Componentes alineados horizontalmente con Flexbox -->
    <div class="form-container">
        <div class="grid">
            <!-- Componente de datos del paciente -->
            <div class="component">
                <x-datosPaciente5b />
            </div>

            <!-- Componente de residencia -->
            <div class="component">
                <x-residencia />
            </div>

            <!-- Componente de mujer 15 a 49 años -->
            <div class="component">
                <x-mujer15a49yOtrosGrupos />
            </div>
        </div>
    </div>


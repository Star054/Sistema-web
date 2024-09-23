<div class="container">
    <!-- Tabla de datos del paciente -->/
    <table class="table table-bordered" style="width: 100%;  border: 1px solid black; border-collapse: collapse;">
        <thead>
        <tr>
            <th style="border: 1px solid black; padding: 5px; width: 0.1%;">No. Orden</th>
            <th style="border: 1px solid black; padding: 5px; width: 14%;">Nombres y apellidos del paciente</th>
            <th style="border: 1px solid black; padding: 5px; width: 6.5%;">CUI Código Único de Identificación</th>
            <th class="vertical-text" style="border: 1px solid black; padding: 5px; width: 2%;">Sexo</th>
            <th class="vertical-text" style="border: 1px solid black; padding: 5px; width: 2.5%;">Pueblo</th>

            <th style="border: 1px solid black; padding: 5px; width: 2.5%;">4/ Fecha de nacimiento o edad</th>
            <th class="vertical-text" style="border: 1px solid black; padding: 2px; width: 5%;">Comunidad lingüística</th>

            <th class="vertical-text" style="border: 1px solid black; padding: 4px; width: 5%;">6/ Orientación Sexual</th>
            <th class="vertical-text" style="border: 1px solid black; padding: 4px; width: 5%;">7/ Escolaridad</th>
            <th class="vertical-text" style="border: 1px solid black; padding: 4px; width: 5%;">8/ Profesión u oficio</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <!-- No. Orden -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="no_orden" style="width:100%; border:none; border-bottom:1px solid black;">
            </td>
            <!-- Nombres y apellidos del paciente -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="nombres_apellidos" style="width:100%; border:none; border-bottom:1px solid black;">
            </td>
            <!-- CUI Código Único de Identificación -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="cui" maxlength="13" pattern="\d{13}" style="width:100%; border:none; border-bottom:1px solid black;" title="El CUI debe contener exactamente 13 dígitos">
            </td>
            <!-- Sexo -->
            <td style="border: 1px solid black; padding: 5px;">
                <select name="sexo" style="width:100%; border:none; border-bottom:1px solid black;">
                    <option>M</option>
                    <option>F</option>
                </select>
            </td>
            <!-- Pueblo -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="pueblo" style="width:100%; border:none; border-bottom:1px solid black;">
            </td>
            <!-- 4/ Fecha de nacimiento o edad -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="date" name="fecha_nacimiento" style="width:100%; border:none; border-bottom:1px solid black;">
            </td>
            <!-- Comunidad lingüística -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="comunidad_linguistica" style="width:100%; border:none; border-bottom:1px solid black;">
            </td>
            <!-- Orientación Sexual -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="orientacion_sexual" style="width:100%; border:none; border-bottom:1px solid black;">
            </td>
            <!-- Escolaridad -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="escolaridad" style="width:100%; border:none; border-bottom:1px solid black;">
            </td>
            <!-- Profesión u oficio -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="profesion_oficio" style="width:100%; border:none; border-bottom:1px solid black;">
            </td>
        </tr>
        </tbody>
    </table>
</div>

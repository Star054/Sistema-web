<div class="container">
    <!-- Tabla de datos de Residencia, Agrícola Migrante y Embarazada -->
    <table class="table table-bordered" style="width: 50%;border: 1px solid black; border-collapse: collapse;">
        <thead>
        <tr>
            <th colspan="2" style="border: 1px solid black; padding: 5px; text-align: center;">Residencia</th>
            <th rowspan="2" style="border: 1px solid black; padding: 5px; text-align: center;">9/ Agrícola Migrante</th>
            <th rowspan="2" style="border: 1px solid black; padding: 5px; text-align: center;">10/ Embarazada?</th>
        </tr>
        <tr>
            <th style="border: 1px solid black; padding: 5px;">Comunidad y/o dirección exacta</th>
            <th style="border: 1px solid black; padding: 5px;">Municipio</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <!-- Comunidad y/o dirección exacta -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="comunidad_direccion" style="width: 100%; border: none; border-bottom: 1px solid black;">
            </td>
            <!-- Municipio -->
            <td style="border: 1px solid black; padding: 5px;">
                <input type="text" name="municipio" style="width: 100%; border: none; border-bottom: 1px solid black;">
            </td>
            <!-- Agrícola Migrante -->
            <td style="border: 1px solid black; padding: 5px;">
                <select name="agricola_migrante" style="width: 100%; border: none; border-bottom: 1px solid black;">
                    <option value="Sí">Sí</option>
                    <option value="No">No</option>
                </select>
            </td>
            <!-- Embarazada -->
            <td style="border: 1px solid black; padding: 5px;">
                <select name="embarazada" style="width: 100%; border: none; border-bottom: 1px solid black;">
                    <option value="Sí">Sí</option>
                    <option value="No">No</option>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<x-app-layout>
    <div class="container">
        <h3>Filtrar Pacientes Vacunados</h3>
        <form method="GET" action="{{ route('vacunas.resultados') }}">
            <!-- Campo para seleccionar el tipo de formulario -->
            <label for="tipo_formulario">Seleccionar tipo de formulario:</label>
            <select name="tipo_formulario" id="tipo_formulario" required>
                <option value="SIGSA5b">SIGSA5b</option>
                <option value="SIGSA3CS">SIGSA3CS</option>
                <!-- Agrega más opciones si tienes otros tipos de formularios -->
            </select>

            <!-- Campo para seleccionar la vacuna -->
            <label for="vacuna">Seleccionar vacuna:</label>
            <select name="vacuna" id="vacuna" required>
                @foreach($vacunas as $vacunaItem)
                    <option value="{{ $vacunaItem->nombre_vacuna }}">{{ $vacunaItem->nombre_vacuna }}</option>
                @endforeach
            </select>

            <!-- Campo para seleccionar el mes -->
            <label for="mes">Seleccionar mes:</label>
            <input type="month" name="mes" id="mes" required>

            <button type="submit">Filtrar</button>
        </form>
    </div>
</x-app-layout>

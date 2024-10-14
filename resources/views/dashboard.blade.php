<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Información') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-center items-center h-full">
                        <strong>FOR-SIGSA-5b</strong>
                    </div>

                    <!-- Contenido replicado -->
                    <div class="grid grid-cols-3 gap-4">


                        <!-- Columna 1 -->
                        <div>
                            <strong>1/ Sexo:</strong><br>
                            M = Masculino<br>
                            F = Femenino
                        </div>

                        <!-- Columna 2 -->
                        <div>
                            <strong>2/ Pueblo:</strong><br>
                            1. Mestizo, Ladino<br>
                            2. Maya<br>
                            3. Garífuna<br>
                            4. Xinca<br>
                            5. Otros<br>
                            6. No indica
                        </div>

                        <!-- Columna 3 -->
                        <div>
                            <strong>3/ Comunidad lingüística:</strong> <em>(Si es pueblo 2 - Maya)</em><br>
                            1. Achi´<br>
                            2. Akateka<br>
                            3. Awakateka<br>
                            4. Ch’orti’<br>
                            5. Chalchiteka<br>
                            6. Chuj<br>
                            7. Itza’<br>
                            8. Ixil<br>
                            9. Jakalteka<br>
                            10. Kaqchikel<br>
                            11. K´iche´<br>
                            12. Mam<br>
                            13. Mopan<br>
                            14. Poqomam<br>
                            15. Pocomchi’<br>
                            16. Q’anjob’al<br>
                            17. Q’eqchi’<br>
                            18. Sakapulteka<br>
                            19. Sipakapensa<br>
                            20. Tektiteka<br>
                            21. Tz’utujil<br>
                            22. Uspanteka<br>
                            23. No indica
                        </div>
                    </div>

                    <!-- Segunda fila -->
                    <div class="grid grid-cols-3 gap-4 mt-6">
                        <!-- Columna 1 -->
                        <div>
                            <strong>4/ Fecha de nacimiento o edad:</strong><br>
                            <strong>Fecha de nacimiento:</strong><br>
                            Registre la fecha de nacimiento en formato dd/mm/aaaa.<br><br>
                            <strong>Edad:</strong><br>
                            Estas casillas son excluyentes:<br>
                            Si el paciente es menor de un mes, anotar la edad en días.<br>
                            Si el paciente es menor de un año, anotar la edad en meses.<br>
                            Si el paciente es mayor de un año, anotar la edad en años.
                        </div>

                        <!-- Columna 2 -->
                        <div>
                            <strong>5/ Discapacidad:</strong><br>
                            0. No aplica<br>
                            1. Física<br>
                            2. Mental<br>
                            3. Visual<br>
                            4. Auditiva<br>
                            5. Otro
                        </div>

                        <!-- Columna 3 -->
                        <div>
                            <strong>6/ Orientación Sexual:</strong><br>
                            0. No aplica<br>
                            1. Heterosexual<br>
                            2. Bisexual<br>
                            3. Homosexual<br>
                            4. Trans<br>
                            5. Otro
                        </div>
                    </div>

                    <!-- Tercera fila -->
                    <div class="grid grid-cols-3 gap-4 mt-6">
                        <!-- Columna 1 -->
                        <div>
                            <strong>7/ Escolaridad:</strong><br>
                            0. No aplica<br>
                            1. Pre Primaria<br>
                            2. Primaria<br>
                            3. Básicos<br>
                            4. Diversificado<br>
                            5. Universidad<br>
                            6. Ninguno<br>
                            7. Otro
                        </div>

                        <!-- Columna 2 -->
                        <div>
                            <strong>8/ Profesión u oficio o condición:</strong><br>
                            0. No aplica<br>
                            1. Ama de Casa<br>
                            2. Mujer Trabajadora Sexual<br>
                            3. Hombre trabajador sexual<br>
                            4. Persona Privada de Libertad<br>
                            5. Joven en riesgo social<br>
                            6. Uniformados<br>
                            7. Migrantes<br>
                            8. Otros
                        </div>

                        <!-- Columna 3 -->
                        <div>
                            <strong>9/ Agrícola Migrante:</strong><br>
                            Si es trabajador agrícola migrante, marque con una "X".<br><br>
                            <strong>10/ Embarazada:</strong><br>
                            Si la paciente está embarazada, marque con una "X".
                        </div>
                    </div>

                    <!-- Cuarta fila -->
                    <div class="grid grid-cols-3 gap-4 mt-6">
                        <!-- Columna 1 -->
                        <div>
                            <strong>Mujer de 15 a 49 años:</strong><br>
                            T.d.a. Toxoide tetánico diftérico para adulto.<br>
                            Registre la fecha de aplicación de dosis en formato dd/mm/aaaa.
                        </div>

                        <!-- Columna 2 -->
                        <div>
                            <strong>Otros grupos:</strong><br>
                            T.d.a. Toxoide tetánico diftérico para adulto.<br>
                            Registre la fecha de aplicación de dosis en formato dd/mm/aaaa.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

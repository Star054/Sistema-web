<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormularioSigsaBaseTable extends Migration
{
    public function up()
    {
        Schema::create('formulario_sigsa_base', function (Blueprint $table) {
            $table->id();  // Llave primaria
            // Campos del componente <x-formulario-slot>
            $table->string('vacuna')->nullable();  // Vacuna seleccionada
            $table->string('area_salud')->nullable();  // Área de salud
            $table->string('distrito_salud')->nullable();  // Distrito de salud
            $table->string('municipio')->nullable();  // Municipio
            $table->string('servicio_salud')->nullable();  // Servicio de salud
            $table->string('responsable_informacion')->nullable();  // Responsable de la información
            $table->string('cargo_responsable')->nullable();  // Cargo del responsable
            $table->year('anio')->nullable();  // Año

            // Campos de datos del paciente
            $table->string('no_orden')->nullable();  // Número de orden
            $table->string('cui')->nullable();  // Código Único de Identificación
            $table->string('nombre_paciente');  // Nombre del paciente
            $table->enum('sexo', ['M', 'F']);  // Sexo ('M' o 'F')
            $table->string('pueblo')->nullable();  // Pueblo (opcional)
            $table->date('fecha_nacimiento')->nullable();  // Fecha de nacimiento
            $table->string('comunidad_linguistica')->nullable();  // Comunidad lingüística (opcional)
            $table->string('escolaridad')->nullable();  // Escolaridad (opcional)
            $table->string('profesion_oficio')->nullable();  // Profesión u oficio (opcional)

            $table->timestamps();  // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('formulario_sigsa_base');
    }
}

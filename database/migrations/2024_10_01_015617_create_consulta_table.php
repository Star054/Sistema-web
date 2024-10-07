<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->id();

            // Relación con formulario_sigsa_base
            $table->unsignedBigInteger('formulario_sigsa_base_id');  // Agregar clave foránea
            $table->foreign('formulario_sigsa_base_id')
                ->references('id')->on('formulario_sigsa_base')
                ->onDelete('cascade');

            // Campos relacionados con la consulta
            $table->string('consulta')->nullable();                 // Consulta
                $table->String('control')->nullable();
            $table->integer('semana_gestacion')->nullable();
            $table->string('vive')->nullable();
            $table->string('fue')->nullable();

            // Campos relacionados con motivo de consulta
            $table->string('referido_a')->nullable();
            $table->text('diagnostico')->nullable();
            $table->string('codigo_cie')->nullable();                // Código CIE-10

            // Campos relacionados con el tratamiento
            $table->text('tratamiento_descripcion')->nullable();     // Descripción del tratamiento o medicamento
            $table->string('tratamiento_presentacion')->nullable();  // Presentación del tratamiento
            $table->double('cantidad_recetada')->nullable();         // Cantidad recetada

            // Campos relacionados con la notificación
            $table->string('notificacion_lugar')->nullable();        // Lugar de notificación
            $table->string('notificacion_numero')->nullable();       // Número de notificación

            // Campo relacionado con los datos del acompañante
            $table->string('nombre_acompanante')->nullable();

            $table->timestamps();                                    // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consulta');
    }
}

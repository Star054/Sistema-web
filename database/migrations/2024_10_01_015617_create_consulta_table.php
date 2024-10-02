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
                ->references('id')->on('formulario_sigsa_base')  // Referencia a la tabla base
                ->onDelete('cascade');

            // Campos relacionados con la consulta
            $table->string('consulta')->nullable();                 // Consulta
                $table->String('control')->nullable();                  // Control
            $table->integer('semana_gestacion')->nullable();         // Semana de gestación
            $table->string('vive')->nullable();                      // Vive
            $table->string('fue')->nullable();                       // Fue

            // Campos relacionados con motivo de consulta
            $table->string('referido_a')->nullable();                // Referido a
            $table->text('diagnostico')->nullable();                 // Descripción del diagnóstico/control
            $table->string('codigo_cie')->nullable();                // Código CIE-10

            // Campos relacionados con el tratamiento
            $table->text('tratamiento_descripcion')->nullable();     // Descripción del tratamiento o medicamento
            $table->string('tratamiento_presentacion')->nullable();  // Presentación del tratamiento
            $table->double('cantidad_recetada')->nullable();         // Cantidad recetada

            // Campos relacionados con la notificación
            $table->string('notificacion_lugar')->nullable();        // Lugar de notificación
            $table->string('notificacion_numero')->nullable();       // Número de notificación

            // Campo relacionado con los datos del acompañante
            $table->string('nombre_acompanante')->nullable();        // Nombres y apellidos del acompañante

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

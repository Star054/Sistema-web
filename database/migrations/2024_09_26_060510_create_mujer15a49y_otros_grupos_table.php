<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mujer15a49y_otros_grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formulario_base_id'); // Relación con formulario base

            // Campos para mujeres de 15 a 49 años
            $table->date('vacuna_mujer_15_49_1a')->nullable();  // 1a vacuna mujer 15 a 49 años
            $table->date('vacuna_mujer_15_49_2a')->nullable();  // 2a vacuna mujer 15 a 49 años
            $table->date('vacuna_mujer_15_49_3a')->nullable();  // 3a vacuna mujer 15 a 49 años
            $table->date('vacuna_mujer_15_49_r1')->nullable();  // Refuerzo 1 mujer 15 a 49 años
            $table->date('vacuna_mujer_15_49_r2')->nullable();  // Refuerzo 2 mujer 15 a 49 años

            // Campos para otros grupos
            $table->date('vacuna_otros_grupos_1a')->nullable();  // 1a vacuna otros grupos
            $table->date('vacuna_otros_grupos_2a')->nullable();  // 2a vacuna otros grupos
            $table->date('vacuna_otros_grupos_3a')->nullable();  // 3a vacuna otros grupos
            $table->date('vacuna_otros_grupos_r1')->nullable();  // Refuerzo 1 otros grupos
            $table->date('vacuna_otros_grupos_r2')->nullable();  // Refuerzo 2 otros grupos

            $table->timestamps();

            // Clave foránea hacia formulario_sigsa_base
            $table->foreign('formulario_base_id')->references('id')->on('formulario_sigsa_base')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mujer15a49y_otros_grupos');
    }
};

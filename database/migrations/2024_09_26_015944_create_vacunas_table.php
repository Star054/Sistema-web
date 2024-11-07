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
        Schema::create('vacunas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_vacuna');
            $table->string('descripcion')->nullable();
            $table->integer('cantidad_autorizada')->default(0);
            $table->integer('cantidad_solicitada')->nullable();
            $table->integer('cantidad_despachada')->nullable();
            $table->string('unidad_medida')->default('mL');
            $table->time('hora_recepcion')->nullable();
            $table->date('fecha_recepcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacunas');
    }
};

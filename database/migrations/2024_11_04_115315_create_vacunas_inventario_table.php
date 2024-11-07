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
        Schema::create('vacunas_inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacuna_id')->constrained('vacunas')->onDelete('cascade');
            $table->string('nombre_vacuna');
            $table->integer('cantidad_disponible')->default(0); // Cantidad actual en inventario
            $table->integer('cantidad_cambiada')->default(0); // Añadir un valor por defecto aquí
            $table->enum('tipo_operacion', ['suma', 'resta']); // Tipo de operación realizada
            $table->text('observaciones')->nullable(); // Observaciones sobre el cambio, si es necesario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacunas_inventario');
    }
};

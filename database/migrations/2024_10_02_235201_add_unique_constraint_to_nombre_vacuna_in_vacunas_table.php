<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('vacunas', function (Blueprint $table) {
            // Cambiar la columna 'nombre_vacuna' para que sea única e insensible a mayúsculas/minúsculas
            $table->string('nombre_vacuna')
                ->collation('utf8mb4_unicode_ci') // Collation que ignora mayúsculas/minúsculas
                ->unique()
                ->change();
        });
    }

    public function down()
    {
        Schema::table('vacunas', function (Blueprint $table) {
            $table->string('nombre_vacuna')
                ->collation('utf8mb4_unicode_ci') // Asegurar que el collation se mantenga
                ->unique(false)
                ->change();
        });
    }
};

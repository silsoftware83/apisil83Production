<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            // Agregamos la nueva columna después de id_departamento
            $table->unsignedBigInteger('id_puesto')->nullable()->after('id_departamento');

            // Clave foránea hacia puestos
            $table->foreign('id_puesto')
                ->references('id')
                ->on('puestos')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropForeign(['id_puesto']);
            $table->dropColumn('id_puesto');
        });
    }
};

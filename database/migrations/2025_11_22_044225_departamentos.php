<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();

            // Jefe de área (relación con tabla personal)
            $table->unsignedBigInteger('id_jefe_area')->nullable();
            $table->foreign('id_jefe_area')
                ->references('id')
                ->on('personal')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};

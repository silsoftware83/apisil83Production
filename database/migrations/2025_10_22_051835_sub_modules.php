<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submodules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->string('name');
            $table->string('slug', 191)->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('route')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            // Columna para hacer submódulos anidados (submódulo padre)
            $table->foreignId('parent_submodule_id')->nullable()
                ->constrained('submodules')->onDelete('cascade');

            // Nivel de profundidad dentro del módulo
            $table->integer('level')->default(1);

            $table->timestamps();
            $table->softDeletes();

            $table->index('module_id');
            $table->index('parent_submodule_id');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submodules');
    }
};

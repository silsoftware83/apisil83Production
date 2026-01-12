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
        Schema::create('user_module_access', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('submodule_id')->nullable();
            $table->unsignedBigInteger('subsubmodule_id')->nullable();
            
            // Permisos específicos
            $table->boolean('can_view')->default(false);
            $table->boolean('can_create')->default(false);
            $table->boolean('can_edit')->default(false);
            $table->boolean('can_delete')->default(false);
            
            $table->timestamps();
            
            // Definir las foreign keys manualmente
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->foreign('module_id')
                  ->references('id')
                  ->on('modules')
                  ->onDelete('cascade');
                  
            $table->foreign('submodule_id')
                  ->references('id')
                  ->on('submodules')
                  ->onDelete('cascade');
       
            
            // Índices para mejorar rendimiento
            $table->index(['user_id', 'module_id']);
            $table->index(['user_id', 'submodule_id']);
            $table->index(['user_id', 'subsubmodule_id']);
            
            // Evitar duplicados
            $table->unique(['user_id', 'module_id', 'submodule_id', 'subsubmodule_id'], 'unique_user_module_access');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_module_access');
    }
};
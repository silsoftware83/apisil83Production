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
        Schema::create('files_users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->string('file_name');
            $table->string('file_url');
            $table->boolean('current')->default(0);
            $table->timestamps();

            // Si quieres relacionar con tabla users descomenta esto:
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files_users');
    }
};

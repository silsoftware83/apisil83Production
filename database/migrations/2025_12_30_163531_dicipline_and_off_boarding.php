<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dicipline_and_off_boardings', function (Blueprint $table) {
            $table->id();

            $table->string('city');
            $table->date('date');

            $table->unsignedBigInteger('employee_name');
            $table->string('position');
            $table->string('department');
            $table->unsignedBigInteger('employee_number');

            $table->text('description')->nullable();
            $table->date('incident_date');

            $table->string('location');
            $table->text('full_details');
            $table->string('regulation')->nullable();
            $table->text('employee_statement')->nullable();

            $table->string('type_of_document');

            $table->json('sanctions')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dicipline_and_off_boardings');
    }
};

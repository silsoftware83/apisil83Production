<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacation_requests', function (Blueprint $table) {
            $table->id();

            // Empleado que solicita
            $table->unsignedBigInteger('personal_id');

            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days_requested')->nullable();

            // Estado general
            $table->string('status')->default('pending');
            $table->check("status IN ('pending','in_review','approved','rejected')");

            /** --------------------------------------
             * Jefe inmediato
             * --------------------------------------*/
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->string('manager_status')->default('pending');
            $table->text('manager_feedback')->nullable();
            $table->timestamp('manager_acted_at')->nullable();
            $table->timestamp('manager_approved_at')->nullable();

            /** --------------------------------------
             * Coordinador
             * --------------------------------------*/
            $table->unsignedBigInteger('coordinator_id')->nullable();
            $table->string('coordinator_status')->default('pending');
            $table->text('coordinator_feedback')->nullable();
            $table->timestamp('coordinator_acted_at')->nullable();
            $table->timestamp('coordinator_approved_at')->nullable();

            /** --------------------------------------
             * RH
             * --------------------------------------*/
            $table->unsignedBigInteger('hr_id')->nullable();
            $table->string('hr_status')->default('pending');
            $table->text('hr_feedback')->nullable();
            $table->timestamp('hr_acted_at')->nullable();
            $table->timestamp('hr_approved_at')->nullable();

            $table->timestamps();

            // FKs
            $table->foreign('personal_id')->references('id')->on('personal')->cascadeOnDelete();
            $table->foreign('manager_id')->references('id')->on('personal')->nullOnDelete();
            $table->foreign('coordinator_id')->references('id')->on('personal')->nullOnDelete();
            $table->foreign('hr_id')->references('id')->on('personal')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacation_requests');
    }
};

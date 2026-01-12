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
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string('actualContract', 20)->default('Prueba');
            $table->date('dateContractFinish')->nullable();
            $table->string('name', 30)->nullable();
            $table->string('lastName', 50)->nullable();
            $table->integer('activo')->default(1);
            $table->date('id_check')->nullable();
            $table->timestamps(); // Crea created_at y updated_at
            $table->string('direction', 200)->nullable();
            $table->integer('cp')->nullable();
            $table->string('phone', 15)->nullable();
            $table->date('birthday')->nullable();
            $table->string('rfc', 20)->nullable();
            $table->string('curp', 20)->nullable();
            $table->string('nss', 20)->nullable();
            $table->string('school', 20)->nullable();
            $table->string('ine', 50)->nullable();
            $table->string('alergist', 100)->nullable();
            $table->string('personalContact', 200)->nullable();
            $table->string('phoneContact', 30)->nullable();
            $table->string('empresa', 25)->nullable();
            $table->string('puesto', 250)->nullable();
            $table->date('ingreso')->nullable();
            $table->integer('id_empleado')->default(0);
            $table->integer('id_jefe_inmediato')->nullable();
            $table->integer('id_departamento')->nullable();
            $table->string('inmBoss', 250)->default('No especificado');
            $table->string('wArea', 250)->nullable();
            $table->string('infonavit', 50)->nullable();
            $table->string('numCart', 35)->nullable();
            $table->string('company', 30)->nullable();
            $table->string('idLicNum', 50)->nullable();
            $table->string('documents', 220)->nullable();
            $table->string('contracts', 500)->default('[]');
            $table->string('documentsCompany', 220)->nullable();
            $table->string('removeColaborator', 300)->nullable();
            $table->string('img', 100)->default('https://th.bing.com/th/id/OIP.4-g8iHzmoxK1nsA0zc0oXwHaHa?pid=ImgDet&rs=1');
            $table->string('numExt', 50)->nullable();
            $table->string('utalla', 100)->nullable();
            $table->string('numCarttwo', 50)->nullable();
            $table->string('email', 50)->default('email@email.com');
            $table->string('emailCompany', 60)->nullable();
            $table->string('checkCode', 10)->nullable();
            $table->string('ext_tel', 20)->nullable();
            
            // Índices
            $table->index('activo');
            $table->index('id_empleado');
            $table->index('empresa');
            $table->index('ingreso');
            $table->index('id_jefe_inmediato');
            $table->index('id_departamento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personaltalentsoft');
    }
};
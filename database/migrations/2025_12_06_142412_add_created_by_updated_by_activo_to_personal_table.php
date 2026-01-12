<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByUpdatedByActivoToPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('ext_tel');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            // $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal', function (Blueprint $table) {
            // Primero elimina las relaciones si las creaste:
            // $table->dropForeign(['created_by']);
            // $table->dropForeign(['updated_by']);

            $table->dropColumn(['created_by', 'updated_by', 'activo']);
        });
    }
}

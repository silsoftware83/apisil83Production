<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dicipline_and_off_boardings', function (Blueprint $table) {
            $table->enum('status', ['abierto', 'cerrado', 'seguimiento'])
                ->default('abierto')
                ->after('sanctions');
        });
    }

    public function down(): void
    {
        Schema::table('dicipline_and_off_boardings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

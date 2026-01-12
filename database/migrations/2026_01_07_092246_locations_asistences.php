<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('locations_asistences', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('id');
            $table->unsignedTinyInteger('id_user'); // int(2)
            $table->string('comments', 200)->nullable();
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->timestamp('time');
            $table->unsignedTinyInteger('type')->default(1); // int(1)
            $table->boolean('isweb')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations_asistences');
    }
};

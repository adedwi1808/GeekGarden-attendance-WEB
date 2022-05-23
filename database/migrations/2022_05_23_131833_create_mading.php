<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mading', function (Blueprint $table) {
            $table->id();
            $table->string('judul_mading');
            $table->string('body_mading');
            $table->string('foto_mading')->unique();
            $table->timestamp('tanggal_mading');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mading');
    }
};

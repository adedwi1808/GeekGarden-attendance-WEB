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
        Schema::create('jam_kerja', function (Blueprint $table) {
            $table->id('id_jam_kerja');
            $table->foreignId('id_admin')
                ->references('id_admin')
                ->on('admin')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->time("jam_mulai");
            $table->time("jam_selesai");
            $table->dateTime('tanggal_dibuat')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jam_kerja');
    }
};

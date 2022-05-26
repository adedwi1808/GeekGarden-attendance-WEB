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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->nullable();
            $table->string('tempat_absensi_datang');
            $table->string('status_absensi_datang');
            $table->string('longitude_datang');
            $table->string('latitude_datang');
            $table->string('foto_absensi_datang')->nullable();
            $table->dateTime('tanggal_absensi_datang')->useCurrent();

            $table->string('tempat_absensi_pulang')->nullable();
            $table->string('status_absensi_pulang')->nullable();
            $table->string('longitude_pulang')->nullable();
            $table->string('latitude_pulang')->nullable();
            $table->string('foto_absensi_pulang')->nullable();
            $table->dateTime('tanggal_absensi_pulang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
};

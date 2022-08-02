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
        Schema::create('laporan_absensi', function (Blueprint $table) {
            $table->id('id_laporan_absensi');
            $table->foreignId('id_pegawai')->references('id_pegawai')->on('pegawai');
            $table->date('tanggal_absen');
            $table->text('keterangan_laporan');
            $table->dateTime('tanggal_laporan')->useCurrent();
            $table->enum('status_laporan',['Diajukan', 'Ditolak', 'Diterima'])->default('Diajukan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_absensi');
    }
};

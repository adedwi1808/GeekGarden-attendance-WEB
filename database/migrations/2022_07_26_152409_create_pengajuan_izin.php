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
        Schema::create('pengajuan_izin', function (Blueprint $table) {
            $table->id('id_pengajuan_izin');
            $table->foreignId('id_pegawai');
            $table->enum('jenis_izin', ['Sakit', 'Cuti','Keperluan Lainnya']);
            $table->date('tanggal_mulai_izin');
            $table->date('tanggal_selesai_izin');
            $table->text('alasan_izin');
            $table->string('surat_izin')->nullable();
            $table->enum('status_izin', ['Diajukan','Diterima', 'Ditolak']);
            $table->timestamp('tanggal_mengajukan_izin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_izin');
    }
};

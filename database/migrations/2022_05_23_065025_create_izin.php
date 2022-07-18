<?php

use App\Models\Pegawai;
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
        Schema::create('izin', function (Blueprint $table) {
            $table->id("id_izin");
            $table->foreignIdFor(Pegawai::class,'id_pegawai');
            $table->enum("jenis_izin", ["Sakit","Cuti", "Keperluan Lain"]);
            $table->dateTime("tanggal_mulai_izin");
            $table->dateTime("tanggal_akhir_izin");
            $table->String("alasan_izin");
            $table->String("surat_izin")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('izin');
    }
};

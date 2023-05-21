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
        Schema::create('lembur', function (Blueprint $table) {
            $table->id('id_lembur');
            $table->foreignId('id_absensi')
                ->references('id_absensi')
                ->on('absensi')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('id_admin')
                ->nullable()
                ->references('id_admin')
                ->on('admin')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->enum('status_lembur', ['Diajukan','Diterima', 'Ditolak'])
                ->default('Diajukan');
            $table->dateTime('tanggal_dibuat')
                ->useCurrent();
            $table->dateTime('tanggal_konfirm')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lembur');
    }
};

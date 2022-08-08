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
            $table->dateTime('tanggal_dibuat')
                ->useCurrent();
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

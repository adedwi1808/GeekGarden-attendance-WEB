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
        Schema::create('tanggal_libur', function (Blueprint $table) {
            $table->id("id_tanggal_libur");
            $table->foreignId('id_admin')
                ->references('id_admin')
                ->on('admin')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string("nama");
            $table->date("tanggal");
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
        Schema::dropIfExists('tanggal_libur');
    }
};

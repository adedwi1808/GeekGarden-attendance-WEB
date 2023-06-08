<?php
//
//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;
//
//return new class extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('pegawai', function (Blueprint $table) {
//            $table->id('id_pegawai');
//            $table->string('nama');
//            $table->enum('jenis_kelamin',["Laki-laki", "Perempuan"]);
//            $table->string('nomor_hp')->unique();
//            $table->string('email')->unique();
//            $table->string('jabatan');
//            $table->string('foto_profile')->nullable();
//            $table->timestamp('email_verified_at')->nullable();
//            $table->string('password');
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::dropIfExists('pegawai');
//    }
//};

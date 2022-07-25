<?php

use App\Http\Controllers\Web\KelolaAbsensi\KelolaHasilAbsensiController;
use App\Http\Controllers\Web\KelolaAbsensi\EditHasilAbsensiController;
use App\Http\Controllers\Web\KelolaMading\KelolaMadingController;
use App\Http\Controllers\Web\KelolaUser\KelolaAdminController;
use App\Http\Controllers\Web\KelolaUser\KelolaPegawaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('admin.login');
});

//Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/do-register',[RegisterController::class,'register'])->name('doregister');

//Guest
Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function (){
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/do-login',[LoginController::class,'login'])->name('dologin');
});

//Logined
Route::prefix('admin')->name('admin.')->middleware('auth.admin')->group(function (){
//    Dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

//    Mading
    Route::get('/mading', [KelolaMadingController::class, 'index'])->name('halaman.mading');
    //Kelola Absensi
    Route::get('/kelola-asbensi', [KelolaHasilAbsensiController::class, 'index'])->name('halaman.kelola.hasil.absensi');
    Route::get('/cari-hasil-absensi',[KelolaHasilAbsensiController::class, 'cariHasilAbsensi'])->name('cari.hasil.absensi');
    Route::get('/edit-absensi/{id}',[EditHasilAbsensiController::class,'index'])->name('halaman.edit.absensi');
    Route::post('/edit-absensi/{id}',[EditHasilAbsensiController::class,'editAbsensi'])->name('edit.absensi');
    Route::post('/hapus-absensi/{id}',[EditHasilAbsensiController::class,'hapus'])->name('hapus.absensi');

//    Kelola User
    //Pegawai
    Route::get('/kelola-pegawai',[KelolaPegawaiController::class,'index'])->name('kelola.pegawai');
    Route::get('/cari-pegawai',[KelolaPegawaiController::class,'cariPegawai'])->name('cari.pegawai');
    Route::get('/edit-pegawai/{id}',[KelolaPegawaiController::class,'editpage'])->name('halaman.edit.pegawai');
    Route::post('/edit-pegawai/{id}',[KelolaPegawaiController::class,'editpegawai'])->name('edit.pegawai');
    Route::get('/tambah-pegawai',[KelolaPegawaiController::class,'tambahpage'])->name('halaman.tambah.pegawai');
    Route::post('/tambahkan-pegawai',[KelolaPegawaiController::class,'tambahkan'])->name('tambahkan.pegawai');
    Route::post('/hapus-pegawai/{id}',[KelolaPegawaiController::class,'hapus'])->name('hapus.pegawai');

    //Admin
    Route::get('/kelola-admin',[KelolaAdminController::class,'index'])->name('kelola.admin');
    Route::post('/hapus-admin/{email}',[KelolaAdminController::class,'hapus'])->name('hapus.admin');
    Route::post('/edit-admin/{id}',[KelolaAdminController::class,'editadmin'])->name('edit.admin');
    Route::get('/tambah-admin',[KelolaAdminController::class,'tambahpage'])->name('halaman.tambah.admin');
    Route::get('/edit-admin/{id}',[KelolaAdminController::class,'editpage'])->name('halaman.edit.admin');

    //    Logout
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
});

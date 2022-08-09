<?php

use App\Http\Controllers\Api\Absen\CheckAbsensiController;
use App\Http\Controllers\Api\Auth\AuthPegawaiController;
use App\Http\Controllers\Api\Auth\LupaPasswordPegawaiController;
use App\Http\Controllers\Api\EditProfilePegawai\EditProfilePegawaiController;
use App\Http\Controllers\Api\Mading\MadingController;
use App\Http\Controllers\Api\PengajuanIzin\PengajuanIzinController;
use App\Http\Controllers\Api\RiwayatAbsensi\RiwayatAbsensiController;
use App\Http\Controllers\Api\Absen\AbsenController;
use App\Http\Controllers\Api\LaporAbsen\LaporAbsensiController;
use App\Http\Controllers\Api\RiwayatLaporanAbsensi\RiwayatLaporanAbsensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Pegawai
Route::post('/login-pegawai', [AuthPegawaiController::class, 'pegawailogin'])->name('pegawailogin');
Route::post('/lupa-password',[LupaPasswordPegawaiController::class, 'lupapassword'])->name('lupa.password.pegawai');
Route::group(['middleware' => ['assign.guard:pegawai-api', 'jwt.verify']], function () {
    //Auth
    Route::post('/me-pegawai', [AuthPegawaiController::class, 'me'])->name('me');
    Route::post('/logout-pegawai', [AuthPegawaiController::class, 'logout']);

    //Attendance
    Route::post('/absensi-hadir',[AbsenController::class, 'absensihadir']);
    Route::post('/upload-bukti-absensi/{id}', [AbsenController::class, 'uploadbuktiabsensi']);
    Route::post('/absensi-pulang',[AbsenController::class, 'absensipulang']);
    Route::get( '/riwayat-absensi',[RiwayatAbsensiController::class, 'riwayatAbsensi']);

    //Pengajuan Izin
    Route::post('/pengajuan-izin', [PengajuanIzinController::class, 'mengajukanIzin']);
    Route::post('/upload-pengajuan-izin/{id}',  [PengajuanIzinController::class, 'uploadSuratizin']);

    //Laporkan Absensi
    Route::post('/laporkan-absensi', [LaporAbsensiController::class, 'melaporkanAbsen']);
    Route::get( '/riwayat-laporan-absensi',[RiwayatLaporanAbsensiController::class, 'riwayatlaporanabsensi']);

    //Other
    Route::get('/madings', [MadingController::class, 'selectAllMading']);
    Route::get('/cek-absensi', [CheckAbsensiController::class, 'checkabsensi']);

    //Edit Profile
    Route::post('/foto-pegawai/{id}', [EditProfilePegawaiController::class, 'editfotoprofile']);
    Route::put('/update-pegawai/{id}', [EditProfilePegawaiController::class, 'updatepegawai']);
});


<?php

use App\Http\Controllers\Api\Absen\AbsensiHadirController;
use App\Http\Controllers\Api\Absen\AbsensiPulangController;
use App\Http\Controllers\Api\Absen\CheckAbsensiController;
use App\Http\Controllers\Api\Absen\UploadBuktiAbsensiController;
use App\Http\Controllers\Api\Auth\AuthPegawaiController;
use App\Http\Controllers\Api\Auth\LupaPasswordPegawaiController;
use App\Http\Controllers\Api\DataAbsensiPegawai\DataAbsensiPegawaiController;
use App\Http\Controllers\Api\EditProfilePegawai\EditProfilePegawaiController;
use App\Http\Controllers\Api\Mading\MadingController;
use App\Http\Controllers\Api\PengaduanAbsensi\PengaduanAbsensiController;
use App\Http\Controllers\Api\PengajuanIzin\PengajuanIzinController;
use App\Http\Controllers\Api\RiwayatAbsensi\RiwayatAbsensiController;
use App\Http\Controllers\Api\Absen\AbsenController;
use App\Http\Controllers\Api\LaporAbsen\LaporAbsensiController;
use App\Http\Controllers\Api\RiwayatLaporanAbsensi\RiwayatLaporanAbsensiController;
use App\Http\Controllers\Api\RiwayatPengaduanAbsensi\RiwayatPengaduanAbsensiController;
use App\Http\Controllers\Api\RiwayatPengajuanIzin\RiwayatPengajuanIzinController;
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
    Route::post('/absensi-hadir',[AbsensiHadirController::class, 'absensihadir']);
    Route::post('/absensi-hadir-ios',[AbsensiHadirController::class, 'absensiHadiriOS']);
    Route::post('/upload-bukti-absensi/{id}', [UploadBuktiAbsensiController::class, 'uploadbuktiabsensi']);
    Route::post('/absensi-pulang',[AbsensiPulangController::class, 'absensipulang']);
    Route::post('/absensi-pulang-ios',[AbsensiPulangController::class, 'absensipulangios']);
    Route::get( '/riwayat-absensi',[RiwayatAbsensiController::class, 'riwayatAbsensi']);

    //Pengajuan Izin
    Route::post('/pengajuan-izin', [PengajuanIzinController::class, 'mengajukanIzin']);
    Route::post('/pengajuan-izin-ios', [PengajuanIzinController::class, 'mengajukanIzinIos']);
    Route::post('/upload-pengajuan-izin/{id}',  [PengajuanIzinController::class, 'uploadSuratizin']);
    Route::get( '/riwayat-pengajuan-izin',[RiwayatPengajuanIzinController::class, 'riwayatPengajuanIzin']);


    //Pengaduan Absensi
    Route::post('/pengaduan-absensi', [PengaduanAbsensiController::class, 'mengadukanAbsen']);
    Route::get( '/riwayat-pengaduan-absensi',[RiwayatPengaduanAbsensiController::class, 'riwayatPengaduanAbsensi']);

    //Other
    Route::get('/madings', [MadingController::class, 'selectAllMading']);
    Route::get('/cek-absensi', [CheckAbsensiController::class, 'checkabsensi']);
    Route::get('/data-absensi', [DataAbsensiPegawaiController::class, 'dataabsensi']);

    //Edit Profile
    Route::post('/foto-pegawai/{id}', [EditProfilePegawaiController::class, 'editfotoprofile']);
    Route::put('/update-pegawai/{id}', [EditProfilePegawaiController::class, 'updatepegawai']);

    Route::post('/foto-pegawai-ios', [EditProfilePegawaiController::class, 'editfotoprofileios']);
    Route::post('/update-pegawai-ios', [EditProfilePegawaiController::class, 'updatepegawaiios']);
});


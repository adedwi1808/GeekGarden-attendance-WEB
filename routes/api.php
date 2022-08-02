<?php

use App\Http\Controllers\Api\PengajuanIzin\PengajuanIzinController;
use App\Http\Controllers\Api\RiwayatAbsensi\RiwayatAbsensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Auth\AuthPegawaiController;

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
Route::post('/register-pegawai', [AuthPegawaiController::class, 'pegawairegister'])->name('pegawairegister');
Route::post('/login-pegawai', [AuthPegawaiController::class, 'pegawailogin'])->name('pegawailogin');
Route::group(['middleware' => ['assign.guard:pegawai-api', 'jwt.verify']], function () {
    //Auth
    Route::post('/me-pegawai', [AuthPegawaiController::class, 'me'])->name('me');
    Route::put('/update-pegawai/{id}', [AuthPegawaiController::class, 'updatepegawai']);
    Route::post('/logout-pegawai', [AuthPegawaiController::class, 'logout']);

    //Attendance
    Route::post('/absensi-hadir',[\App\Http\Controllers\Api\AbsenController::class, 'absensihadir']);
    Route::post('/upload-bukti-absensi/{id}', [\App\Http\Controllers\Api\AbsenController::class, 'uploadbuktiabsensi']);
    Route::post('/absensi-pulang',[\App\Http\Controllers\Api\AbsenController::class, 'absensipulang']);
    Route::get( '/riwayat-absensi',[RiwayatAbsensiController::class, 'riwayatAbsensi']);

    //Pengajuan Izin
    Route::post('/pengajuan-izin', [PengajuanIzinController::class, 'mengajukanIzin']);
    Route::post('/upload-pengajuan-izin/{id}',  [PengajuanIzinController::class, 'uploadSuratizin']);


    //Other
    Route::get('/madings', [\App\Http\Controllers\Api\MadingController::class, 'selectAllMading']);
    Route::post('/foto-pegawai/{id}', [AuthPegawaiController::class, 'editfotoprofile']);
    Route::get('/cek-absensi', [\App\Http\Controllers\Api\AbsenController::class, 'checkabsensi']);
});


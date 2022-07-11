<?php

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



Route::post('/upload-attendance-image/{id}', [\App\Http\Controllers\Api\PegawaiController::class, 'uploadbuktiabsensi']);
Route::post('/upload-complete-attendance-image/{id}', [\App\Http\Controllers\Api\PegawaiController::class, 'uploadCompleteAttendanceImage']);
Route::put('/complete-attendance/{id}',[\App\Http\Controllers\Api\PegawaiController::class, 'completeAttendance']);
Route::post('/upload-mading', [\App\Http\Controllers\Api\MadingController::class, 'uploadMading']);


//Pegawai
Route::post('/register-pegawai', [AuthPegawaiController::class, 'pegawairegister'])->name('pegawairegister');
Route::post('/login-pegawai', [AuthPegawaiController::class, 'pegawailogin'])->name('pegawailogin');
Route::group(['middleware' => ['assign.guard:pegawai-api', 'jwt.verify']], function () {
    //Auth
    Route::post('/me-pegawai', [AuthPegawaiController::class, 'me'])->name('me');
    Route::put('/update-pegawai/{id}', [AuthPegawaiController::class, 'updatepegawai']);
    Route::post('/logout-pegawai', [AuthPegawaiController::class, 'logout']);
    //Other
    Route::get('/madings', [\App\Http\Controllers\Api\MadingController::class, 'selectAllMading']);
    Route::post('/foto-pegawai/{id}', [AuthPegawaiController::class, 'editfotoprofile']);

    //Attendance
    Route::post('/absensi-hadir/{id}',[\App\Http\Controllers\Api\PegawaiController::class, 'absensihadir']);
    Route::post('/upload-bukti-absensi/{id}', [\App\Http\Controllers\Api\PegawaiController::class, 'uploadbuktiabsensi']);


});



//AUTH Admin
//Route::post('/register-admin', [AdminController::class, 'adminregister'])->name('adminregister');
//Route::post('/login-admin', [AdminController::class, 'adminlogin'])->name('adminlogin');
//Route::view('login-admin','Admin/login')->name('adminlogin');
//Route::group(['middleware' => 'admin:admin-api'], function ($router) {
//    Route::post('/me-pegawai', [AuthPegawaiController::class, 'me'])->name('me');
//    Route::put('/update-pegawai/{id}', [AuthPegawaiController::class, 'updatepegawai']);
//    Route::post('logout', 'AuthPegawaiController@logout');
//    Route::post('refresh', 'AuthPegawaiController@refresh');
//});

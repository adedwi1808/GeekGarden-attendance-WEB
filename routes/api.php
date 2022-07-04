<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Auth\PegawaiController;
use \App\Http\Controllers\Api\Auth\AdminController;

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


Route::post('/upload-user/{id}', [\App\Http\Controllers\Api\AuthController::class, 'upload'])->middleware('jwt.verify');

Route::post('/upload-attendance-image/{id}', [\App\Http\Controllers\Api\AttendanceController::class, 'uploadAttendanceImage']);
Route::post('/upload-complete-attendance-image/{id}', [\App\Http\Controllers\Api\AttendanceController::class, 'uploadCompleteAttendanceImage']);
Route::post('/fill-attendance/{id}',[\App\Http\Controllers\Api\AttendanceController::class, 'fillAttendance']);
Route::put('/complete-attendance/{id}',[\App\Http\Controllers\Api\AttendanceController::class, 'completeAttendance']);


Route::post('/upload-mading', [\App\Http\Controllers\Api\MadingController::class, 'uploadMading']);
Route::get('/madings', [\App\Http\Controllers\Api\MadingController::class, 'selectAllMading'])->middleware('jwt.verify');


//AUTH Pegawai
Route::post('/register-pegawai', [PegawaiController::class, 'pegawairegister'])->name('pegawairegister');
Route::post('/login-pegawai', [PegawaiController::class, 'pegawailogin'])->name('pegawailogin');
Route::group(['middleware' => 'auth:pegawai-api'], function () {
    Route::post('/me-pegawai', [PegawaiController::class, 'me'])->name('me');
    Route::put('/update-pegawai/{id}', [PegawaiController::class, 'updatepegawai']);
    Route::post('/logout-pegawai', [PegawaiController::class, 'logout']);
});


//AUTH Admin
//Route::post('/register-admin', [AdminController::class, 'adminregister'])->name('adminregister');
//Route::post('/login-admin', [AdminController::class, 'adminlogin'])->name('adminlogin');
//Route::view('login-admin','Admin/login')->name('adminlogin');
//Route::group(['middleware' => 'admin:admin-api'], function ($router) {
//    Route::post('/me-pegawai', [PegawaiController::class, 'me'])->name('me');
//    Route::put('/update-pegawai/{id}', [PegawaiController::class, 'updatepegawai']);
//    Route::post('logout', 'PegawaiController@logout');
//    Route::post('refresh', 'PegawaiController@refresh');
//});

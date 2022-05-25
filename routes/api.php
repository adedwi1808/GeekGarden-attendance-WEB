<?php

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

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::put('/update-user/{id}', [\App\Http\Controllers\Api\AuthController::class, 'update'])->middleware('jwt.verify');
Route::post('/upload-user/{id}', [\App\Http\Controllers\Api\AuthController::class, 'upload'])->middleware('jwt.verify');

Route::post('/upload-mading', [\App\Http\Controllers\Api\MadingController::class, 'uploadMading']);
Route::get('/madings', [\App\Http\Controllers\Api\MadingController::class, 'selectAllMading']);

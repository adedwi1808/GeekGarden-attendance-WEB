<?php

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
    return view('welcome');
});

Route::get('/register', function () {
    return view('Auth.Register.register',
        ['title' => 'Register Page'
        ]);
})->name('register');
Route::post('/do-register',[RegisterController::class,'register'])->name('doregister');

//Guest
Route::prefix('admin')->name('admin.')->group(function (){
Route::get('/login', function () {
    return view('Auth.Login.login', ['title' => 'Login Page']);
})->name('login');
Route::post('/do-login',[LoginController::class,'login'])->name('dologin');
});

//Logined
Route::prefix('admin')->name('admin.')->middleware('auth.admin:admin')->group(function (){
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
});

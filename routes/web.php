<?php

use App\Http\Controllers\Mockup\DashboardController;
use App\Http\Controllers\Mockup\PegawaiController;
use App\Http\Controllers\Mockup\JsonController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('login/submit',[LoginController::class,'onSubmit'])->name('login.submit');

Route::get('logout', [LogoutController::class,'onSubmitLogout'])->name('logout');

Route::middleware('auth')
->group(function(){
    Route::get('dashboard',[DashboardController::class, 'viewDashboard'])->name('dashboard');
    Route::get('pegawai',[PegawaiController::class, 'viewDashboard'])->name('pegawai');
});

Route::get('stpkau/{id}', [JsonController::class,'viewStPkau']);



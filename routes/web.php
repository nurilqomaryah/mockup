<?php

use App\Http\Controllers\Mockup\DashboardController;
use App\Http\Controllers\Mockup\KeuanganController;
use App\Http\Controllers\Mockup\PegawaiController;
use App\Http\Controllers\Mockup\LaporanController;
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
    Route::get('keuangan',[KeuanganController::class, 'viewDashboard'])->name('keuangan');
    Route::get('pegawai',[PegawaiController::class, 'viewDashboard'])->name('pegawai');
    Route::get('laporan',[LaporanController::class, 'viewDashboard'])->name('laporan');
    Route::get('syncpeg',[PegawaiController::class, 'syncPegawai'])->name('syncpeg');
});

Route::get('stpkau/{id}', [JsonController::class,'viewStPkau']);
Route::get('stsatker/{mulai}/{selesai}', [JsonController::class,'listStSatker']);
Route::get('stbidang/{id}/{mulai}/{selesai}', [JsonController::class,'listStBidang']);
Route::get('stpeg/{id}/{mulai}/{selesai}', [JsonController::class,'viewStPeg']);
Route::get('serapbid/{id}', [JsonController::class,'viewPenyerapanBidang']);
Route::get('serapsatker', [JsonController::class,'viewPenyerapanSatker']);
Route::get('perjadinbid/{id}', [JsonController::class,'viewPerjadinBidang']);
Route::get('statuscsd/{id}', [JsonController::class,'viewStatusCsDraft']);
Route::get('statuscso/{id}', [JsonController::class,'viewStatusCsOutstand']);
Route::get('statuscsr/{id}', [JsonController::class,'viewStatusCsRealisasi']);
Route::get('statuslap/{id}', [JsonController::class,'viewStatusLaporan']);
Route::get('rekapstatlap', [JsonController::class,'viewRekapStatus']);
Route::get('stat1bid/{id}', [JsonController::class,'viewStatus1Bidang']);
Route::get('stat7bid/{id}', [JsonController::class,'viewStatus7Bidang']);
Route::get('dlsatker', [JsonController::class,'listDlSatker']);




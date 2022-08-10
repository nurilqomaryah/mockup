<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MockupController;
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
Route::resource('logins','LoginController');
Route::post('login/submit',[LoginController::class,'onSubmit'])->name('login.submit');

Route::get('syncadmin',[MockupController::class, 'viewSyncData'])->name('syncadmin');
Route::get('syncdata',[MockupController::class,'syncData'])->name('syncdata');
Route::get('bagipagu',[MockupController::class, 'bagipagu']);
Route::get('costsheet',[MockupController::class, 'costsheet']);
Route::get('pagu',[MockupController::class, 'pagu']);
Route::get('surattugas',[MockupController::class, 'surattugas']);
Route::get('gaji',[MockupController::class, 'gaji']);
Route::get('gajidetail',[MockupController::class, 'gajidetail']);
Route::get('permintaanpbj',[MockupController::class, 'permintaanpbj']);
Route::get('simast',[MockupController::class, 'simast']);

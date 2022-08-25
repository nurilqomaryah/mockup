<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RealIKKController;
use App\Http\Controllers\AsyncRequest\RefIkkAsyncRequest;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SyncController;
use App\Http\Controllers\Admin\UserController;
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
Route::resource('logins','LoginController');
Route::post('login/submit',[LoginController::class,'onSubmit'])->name('login.submit');

Route::controller(RegisterController::class)
    ->group(function(){
        Route::get('/register','viewRegisterUser')->name('register');
        Route::post('/register/submit','onSubmitRegisterUser')->name('register.submit');
    });

Route::get('logout', [LogoutController::class,'onSubmitLogout'])->name('logout');

Route::get('dashboard',[DashboardController::class, 'viewDashboard'])->name('dashboard');

//Route Sync Data
Route::get('syncadmin',[SyncController::class, 'viewSyncData'])->name('syncadmin');
Route::get('syncdata',[SyncController::class,'syncData'])->name('syncdata');
Route::get('bagipagu',[SyncController::class, 'bagipagu']);
Route::get('costsheet',[SyncController::class, 'costsheet']);
Route::get('pagu',[SyncController::class, 'pagu']);
Route::get('surattugas',[SyncController::class, 'surattugas']);
Route::get('gaji',[SyncController::class, 'gaji']);
Route::get('gajidetail',[SyncController::class, 'gajidetail']);
Route::get('permintaanpbj',[SyncController::class, 'permintaanpbj']);
Route::get('simast',[SyncController::class, 'simast']);

//Route CRUD
Route::middleware('sessionCheck')
    ->prefix('users')
    ->group(function(){
        Route::get('/', [UserController::class,'index'])->name('users.index');
        Route::get('/create',[UserController::class,'create'])->name('users.create');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');

        Route::post('/create/submit',[UserController::class,'store'])->name('users.store');
        Route::post('/update/submit',[UserController::class,'update'])->name('users.update');
        Route::post('/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');
    });

Route::middleware('sessionCheck')
    ->prefix('realisasi-ikk')
    ->group(function(){
        Route::get('/', [RealIKKController::class,'index'])->name('realikk.index');
        Route::get('/create',[RealIKKController::class,'create'])->name('realikk.create');
        Route::get('/edit',[RealIKKController::class,'edit'])->name('realikk.edit');

        Route::post('/create/submit',[RealIKKController::class,'store'])->name('realikk.store');
        Route::post('/update/submit',[RealIKKController::class,'update'])->name('realikk.update');
        Route::post('/destroy/{id}',[RealIKKController::class,'destroy'])->name('realikk.destroy');

    });

Route::post('/async-request/ref-ikk',
    [RefIkkAsyncRequest::class,'onRequestRefIkk']);

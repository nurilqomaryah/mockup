<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MappingAnggaran\DeleteMappingAnggaran;
use App\Http\Controllers\Admin\MappingAnggaran\IndexMappingAnggaran;
use App\Http\Controllers\Admin\MappingAnggaran\MappingAnggaranPKAU;
use App\Http\Controllers\Admin\MappingPBJ\CreateMappingPBJ;
use App\Http\Controllers\Admin\MappingPBJ\DeleteMappingPBJ;
use App\Http\Controllers\Admin\MappingPBJ\IndexMappingPBJ;
use App\Http\Controllers\Admin\MappingPBJ\UpdateMappingPBJ;
use App\Http\Controllers\Admin\MappingST\CreateMappingST;
use App\Http\Controllers\Admin\MappingST\DeleteMappingST;
use App\Http\Controllers\Admin\MappingST\IndexMappingST;
use App\Http\Controllers\Admin\MappingST\UpdateMappingST;
use App\Http\Controllers\Admin\RealIKK\CreateRealIKK;
use App\Http\Controllers\Admin\RealIKK\DeleteRealIKK;
use App\Http\Controllers\Admin\RealIKK\IndexRealIKK;
use App\Http\Controllers\Admin\RealIKK\UpdateRealIKK;
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

Route::middleware('sessionCheck')
    ->group(function(){
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

        //Route User
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

        // Route Realisasi IKK
        Route::middleware('sessionCheck')
            ->prefix('realisasi-ikk')
            ->group(function(){
                Route::get('/', [IndexRealIKK::class,'viewIndexRealIKK'])->name('realikk.index');
                Route::get('/create',[CreateRealIKK::class,'viewCreateRealIKK'])->name('realikk.create');
                Route::get('/edit/{idRealisasiIKK}',[UpdateRealIKK::class,'viewUpdateRealIKK'])->name('realikk.edit');

                Route::post('/create/submit',[CreateRealIKK::class,'onSubmitCreateRealIKK'])->name('realikk.store');
                Route::post('/update/submit',[UpdateRealIKK::class,'onSubmitUpdateRealIKK'])->name('realikk.update');
                Route::post('/destroy/{idRealisasiIKK}',[DeleteRealIKK::class,'onSubmitDeleteRealIKK'])->name('realikk.destroy');
            });

        Route::post('/async-request/ref-ikk',
            [RefIkkAsyncRequest::class,'onRequestRefIkk']);

        //Route Mapping Anggaran PKAU
        Route::middleware('sessionCheck')
            ->prefix('mapping-anggaran')
            ->group(function(){
                Route::get('/', [IndexMappingAnggaran::class,'viewIndexMappingAnggaran'])->name('mapping_anggaran.index');
                Route::get('/mapping/{idReferensiIndex}',[MappingAnggaranPKAU::class,'viewMappingAnggaran'])->name('mapping_anggaran.mapping');

                Route::post('/mapping/submit',[App\Http\Controllers\Admin\MappingAnggaran\MappingAnggaranPKAU::class,'onSubmitMappingAnggaran'])->name('mapping_anggaran.store');
                Route::post('/destroy/{idAnggaranPKAU}',[DeleteMappingAnggaran::class,'onSubmitDeleteMappingAnggaran'])->name('mapping_anggaran.destroy');
            });


        //Route Mapping ST
        Route::middleware('sessionCheck')
            ->prefix('mapping-st')
            ->group(function() {
                Route::get('/', [IndexMappingST::class,'viewIndexMappingST'])->name('mappingst.index');
                Route::get('/create', [CreateMappingST::class, 'viewCreateMappingST'])->name('mappingst.create');
                Route::get('/edit/{idMappingST}', [UpdateMappingST::class, 'viewUpdateMappingST'])->name('mappingst.edit');

                Route::post('/create/submit', [CreateMappingST::class, 'onSubmitCreateMappingST'])->name('mappingst.store');
                Route::post('/update/submit', [UpdateMappingST::class, 'onSubmitUpdateMappingST'])->name('mappingst.update');
                Route::post('/destroy/{idMappingST}', [DeleteMappingST::class, 'onSubmitDeleteMappingST'])->name('mappingst.destroy');
            });

        //Route Mapping PBJ
        Route::middleware('sessionCheck')
            ->prefix('mapping-pbj')
            ->group(function() {
                Route::get('/', [IndexMappingPBJ::class,'viewIndexMappingPBJ'])->name('mapping_pbj.index');
                Route::get('/create', [CreateMappingPBJ::class, 'viewCreateMappingPBJ'])->name('mapping_pbj.create');
                Route::get('/edit/{idMappingPBJ}', [UpdateMappingPBJ::class, 'viewUpdateMappingPBJ'])->name('mapping_pbj.edit');

                Route::post('/create/submit', [CreateMappingPBJ::class, 'onSubmitCreateMappingPBJ'])->name('mapping_pbj.store');
                Route::post('/update/submit', [UpdateMappingPBJ::class, 'onSubmitUpdateMappingPBJ'])->name('mapping_pbj.update');
                Route::post('/destroy/{idMappingPBJ}', [DeleteMappingPBJ::class, 'onSubmitDeleteMappingPBJ'])->name('mapping_pbj.destroy');
            });
    });

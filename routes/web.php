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

Route::get('dashboardadmin',[MockupController::class, 'viewDashboard'])->name('dashboardadmin');
Route::get('syncdata',[MockupController::class, 'bagipagu'])->name('syncdata');

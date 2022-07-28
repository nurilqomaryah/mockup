<?php

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


Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
Route::resource('logins','App\Http\Controllers\Auth\LoginController');
Route::post('login/submit',[App\Http\Controllers\Auth\LoginController::class,'onSubmit'])->name('login.submit');

Route::get('dashboardadmin',[\App\Http\Controllers\Admin\DashboardCtrl::class, 'dashadmin'])->name('dashboardadmin');

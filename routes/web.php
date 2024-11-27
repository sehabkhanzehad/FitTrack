<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'adminpanel'], function () {
    // auth route start
    Route::get('/', [LoginController::class, 'LoginPage'])->name('login.index');
    Route::post('/login-check', [LoginController::class, 'loginCheck'])->name('login.check');
    Route::get('/log-out', [LogoutController::class, 'LogOut'])->name('logout');
    // auth route end    
});


Route::group(['prefix' =>'admindashboard', 'middleware'=>'jwt'],function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});


Route::get('/', function () {
    return view('welcome');
});

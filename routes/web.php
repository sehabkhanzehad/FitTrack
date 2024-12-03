<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Middleware\TokenVerificationPassMiddleware;


Route::get('/', function () {
    return view('welcome');
});






Route::get('/sign-up', [AuthController::class, 'signUpPage'])->name('auth.sign-up-page');
Route::get('/sign-in', [AuthController::class, 'signInPage'])->name('auth.sign-in-page');
Route::get('/otp-send', [AuthController::class, 'otpSendPage'])->name('auth.otp-send-page');
Route::get('/otp-verify', [AuthController::class, 'otpVerifyPage'])->name('auth.otp-verify-page');
Route::get('/password-reset', [AuthController::class, 'passwordResetPage'])->name('auth.reset-pass-page')->middleware([TokenVerificationPassMiddleware::class]);







Route::post('/sign-up', [AuthController::class, 'signUp'])->name('auth.sign-up');
Route::post('/sign-in', [AuthController::class, 'signIn'])->name('auth.sign-in');
Route::post('/otp-send', [AuthController::class, 'otpSend'])->name('auth.otp-send');
Route::post('/otp-verify', [AuthController::class, "otpVerify"])->name('auth.otp-verify');
Route::post('/password-reset', [AuthController::class, 'passwordReset'])->name('auth.reset-pass');



Route::get('/sign-out', [AuthController::class, 'signOut'])->middleware([TokenVerificationMiddleware::class]);



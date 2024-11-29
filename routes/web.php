<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Middleware\TokenVerificationPassMiddleware;


Route::get('/', function () {
    return view('welcome');
});






Route::get('/sign-up', [AuthController::class, 'signUpPage']);
Route::get('/userLogin', [AuthController::class, 'LoginPage']);
Route::get('/sendOtp', [AuthController::class, 'SendOtpPage']);
Route::get('/verifyOtp', [AuthController::class, 'VerifyOTPPage']);
Route::get('/resetPassword', [AuthController::class, 'ResetPasswordPage'])->middleware(middleware: [TokenVerificationPassMiddleware::class]);





Route::post('/sign-up', [AuthController::class, 'signUp']);
Route::post('/sign-in', [AuthController::class, 'signIn']);
Route::post('/otp-send', [AuthController::class, 'otpSend']);
Route::post('/otp-verify', [AuthController::class, "otpVerify"]);
Route::post('/password-reset', [AuthController::class, 'passwordReset'])->middleware([TokenVerificationPassMiddleware::class]);
Route::get('/sign-out', [AuthController::class, 'signOut'])->middleware([TokenVerificationMiddleware::class]);

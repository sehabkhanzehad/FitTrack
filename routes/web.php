<?php

//use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserWorkoutProgressController;

Route::prefix('user-workout-progresses')->group(function () {
    Route::get('/', [UserWorkoutProgressController::class, 'index'])->name('userWorkoutProgresses.index');
    Route::post('/', [UserWorkoutProgressController::class, 'store'])->name('userWorkoutProgresses.store');
    Route::get('/{id}', [UserWorkoutProgressController::class, 'show'])->name('userWorkoutProgresses.show');
    Route::put('/{id}', [UserWorkoutProgressController::class, 'update'])->name('userWorkoutProgresses.update');
    Route::delete('/{id}', [UserWorkoutProgressController::class, 'destroy'])->name('userWorkoutProgresses.destroy');
});


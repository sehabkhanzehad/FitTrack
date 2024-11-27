<?php

use App\Http\Controllers\Dashboard\GoalController;
use App\Http\Controllers\Dashboard\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/workouts', [WorkoutController::class, 'getAll']);
Route::get('/workouts/{id}', [WorkoutController::class, 'getOne']);
Route::get('/workouts/user/{id}', [WorkoutController::class, 'getByUser']);
Route::post('/workouts', [WorkoutController::class, 'store']);
Route::put('/workouts/{id}', [WorkoutController::class, 'edit']);
Route::delete('/workouts/{id}', [WorkoutController::class, 'destroy']);

// Goals routes
Route::get('/goals', [GoalController::class, 'getAll']);
Route::get('/goals/{id}', [GoalController::class, 'getOne']);
Route::get('/goals/user/{id}', [GoalController::class, 'getByUser']);
Route::post('/goals', [GoalController::class, 'store']);
Route::put('/goals/{id}', [GoalController::class, 'edit']);
Route::delete('/goals/{id}', [GoalController::class, 'destroy']);

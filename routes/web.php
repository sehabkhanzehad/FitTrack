<?php

use App\Http\Controllers\DietPlanController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MealController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/storefood',[FoodController::class,'store']);
Route::get('/foodlist',[FoodController::class,'index']);

Route::post('/storemeal',[MealController::class,'store']);
Route::get('/meallist',[MealController::class,'index']);

Route::post('/storedietplan',[DietPlanController::class,'store']);
Route::get('/dietplanlist',[DietPlanController::class,'index']);

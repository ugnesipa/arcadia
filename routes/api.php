<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ClimateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaintenanceRatingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route to plants with all CRUD functions
Route::apiResource('/plants', PlantController::class);
//route to categories with only read functions (read all and read by id)
Route::resource('/categories', CategoryController::class)->only(['index', 'show']);
//route to climates with only read functions (read all and read by id)
Route::resource('/climates', ClimateController::class)->only(['index', 'show']);
//route to maintenance ratings with only read functions (read all and read by id)
Route::resource('/maintenance_ratings', MaintenanceRatingController::class)->only(['index', 'show']);

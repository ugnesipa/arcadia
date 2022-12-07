<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ClimateController;
use App\Http\Controllers\CategoryController;

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

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/auth/logout',[AuthController::class, 'logout']);
    Route::get('/auth/user',[AuthController::class, 'user']);

    // You need to be logged in for all book functionality except get all and get by id
    Route::apiResource('/plants', PlantController::class)->except((['index', 'show']));
    Route::apiResource('/climates', ClimateController::class)->except((['index', 'show']));
    Route::apiResource('/categories', CategoryController::class)->except((['index', 'show']));

});

//route to plants with all CRUD functions
Route::apiResource('/plants', PlantController::class)->only(['index', 'show']);
//route to categories with only read functions (read all and read by id)
Route::resource('/categories', CategoryController::class)->only(['index', 'show']);
//route to climates with only read functions (read all and read by id)
Route::resource('/climates', ClimateController::class)->only(['index', 'show']);

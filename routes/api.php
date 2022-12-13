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

//route to register
Route::post('/auth/register', [AuthController::class, 'register']);
//route to login
Route::post('/auth/login', [AuthController::class, 'login']);

//route to auth middleware that control authorization
Route::middleware('auth:sanctum')->group(function (){
    Route::post('/auth/logout',[AuthController::class, 'logout']);
    Route::get('/auth/user',[AuthController::class, 'user']);

    // You need to be logged in for these routes to have authorization

    //routes to all plants functionalities except show all and show by id
    Route::apiResource('/plants', PlantController::class)->except((['index', 'show']));
    //routes to all climate functionalities except show all and show by id
    Route::apiResource('/climates', ClimateController::class)->except((['index', 'show']));
    //routes to all category functionalities except show all and show by id
    Route::apiResource('/categories', CategoryController::class)->except((['index', 'show']));

});

//routes without authorization to plants but only show all and show by id functionalities
Route::apiResource('/plants', PlantController::class)->only(['index', 'show']);
//routes without authorization to categories but only show all and show by id functionalities
Route::resource('/categories', CategoryController::class)->only(['index', 'show']);
//routes without authorization to climates but only show all and show by id functionalities
Route::resource('/climates', ClimateController::class)->only(['index', 'show']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\resturantController;

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

//login & register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//resturants information
Route::get('/resturants',[resturantController::class,'index']);
Route::get('/resturant/{id}',[resturantController::class,'show']);
Route::get('/resturants/{resturant_id}/foods',[resturantController::class,'food']);


//auth with sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    //address for user
    Route::get('/addresses',[AddressController::class,'index']);
    Route::post('/addresses',[AddressController::class,'store']);
    Route::post('/addresses/{address_id}',[AddressController::class,'setActiveAddress']);

//logout
    Route::post('/logout', [AuthController::class, 'logout']);
});













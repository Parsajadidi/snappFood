<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::get('/api/restaurants',[resturantController::class,'index']);
Route::get('/api/restaurant/{id}',[resturantController::class,'show']);
Route::get('/api/restaurants/{resturant_id}/foods',[resturantController::class,'food']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

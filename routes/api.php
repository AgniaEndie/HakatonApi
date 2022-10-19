<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get("/check",[\App\Http\Controllers\CheckController::class,'status']);
Route::post("/quiz",[\App\Http\Controllers\CheckController::class,'create']);
//Route::get('/user',[\App\Http\Controllers\UserController::class,'index']);
Route::post('/user-registry',[\App\Http\Controllers\UserController::class,'create']);
Route::post('/user-auth',[App\Http\Controllers\UserController::class,'show']);


Route::get('/role',[\App\Http\Controllers\RoleModelController::class,'index'])->middleware('auth:sanctum');

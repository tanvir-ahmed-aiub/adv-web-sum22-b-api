<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

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
Route::get('/student/get',[APIController::class,'get'])->middleware("logged");
Route::get('/student/get/{id}',[APIController::class,'search']);
Route::post('/student/create',[APIController::class,'create']);
Route::post('/login',[APIController::class,'login']);
Route::post('/logout',[APIController::class,'logout']);
Route::post('/file',[APIController::class,'file']);
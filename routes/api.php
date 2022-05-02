<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/properties/create',[MainController::class,'createProperty']);
Route::get('/properties',[MainController::class,'getAllProperty']);
Route::get('/locations',[MainController::class,'getLocations']);
Route::get('/properties/search/{key}',[MainController::class,'searchProperty']);
Route::post('/room-details/create',[MainController::class,'createRoom']);


Route::post('/register',[UserController::class,'processRegister']);
// Route::post('/login',[UserController::class,'processLogin']);

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard',[UserController::class,'dashboard']);
    Route::get('/logout',[UserController::class,'logout']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);

Route::group(['middleware'=>'api'],function(){
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});
<?php

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/properties/create',[MainController::class,'createProperty']);
Route::get('/properties',[MainController::class,'getAllProperty']);
Route::get('/locations',[MainController::class,'getLocations']);
Route::get('/properties/search/{key}',[MainController::class,'searchProperty']);
Route::post('/room-details/create',[MainController::class,'createRoom']);

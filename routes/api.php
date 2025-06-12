<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('hello' ,function (Request $request){
    return'test hello';

Route::post('/register', [AuthController::class, 'register']);

}
);
use App\Http\Controllers\Api\Auth\RegisterController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/profile',[AuthController::class, 'getProfile'])->middleware(middleware: 'auth:sanctum');
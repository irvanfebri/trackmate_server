<?php

use App\Http\Controllers\AuthController; 
use App\Http\Controllers\UserController; 
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/auth/login', [AuthController::class, 'login'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]); 
    Route::post('/auth/logout', [AuthController::class, 'logout'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]); 
    
    Route::get('/users',[UserController::class, 'index']); 
    Route::post('/users',[UserController::class, 'store']);
    Route::get('/users/{id}',[UserController::class, 'show']);
    Route::put('/users/{id}',[UserController::class, 'update']);
    Route::delete('/users/{id}',[UserController::class, 'destroy']);  
    });


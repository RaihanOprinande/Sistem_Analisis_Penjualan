<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard',[DashboardController::class,'index']);
Route::get('/register',[RegisterController::class,'index']);
Route::get('/login',[LoginController::class,'index']);

Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/register',[RegisterController::class,'store']);
Route::post('/logout',[LoginController::class,'logout']);

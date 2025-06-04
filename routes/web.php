<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PlatfromController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard',[DashboardController::class,'index']);
Route::get('/register',[RegisterController::class,'index']);
Route::get('/login',[LoginController::class,'index']);
//price
Route::get('/price',[PriceController::class,'index']);
Route::get('/price/{id}',[PriceController::class,'byplatfrom']);
Route::get('/create_price',[PriceController::class,'create']);
Route::get('/update_price/{id}',[PriceController::class,'edit']);
Route::post('/price/store',[PriceController::class,'store']);

Route::resource('/menu',MenuController::class);
Route::resource('/platfrom',PlatfromController::class);
Route::resource('/update_price',PriceController::class);

Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/register',[RegisterController::class,'store']);
Route::post('/logout',[LoginController::class,'logout']);
Route::post('/price/platfrom/store',[PlatfromController::class,'store']);


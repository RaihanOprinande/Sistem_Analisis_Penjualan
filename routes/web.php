<?php

use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\commissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PlatfromController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::put('/transactions/{transactionId}/status', [TransaksiController::class, 'updatestatus']);

Route::get('/dashboard',[DashboardController::class,'index']);
Route::get('/register',[RegisterController::class,'index']);
Route::get('/login',[LoginController::class,'index']);
Route::get('/komisi/{id}',[commissionController::class,'show']);
//price
Route::get('/price',[PriceController::class,'index']);
Route::get('/price/{id}',[PriceController::class,'byplatfrom']);
Route::get('/create_price',[PriceController::class,'create']);
Route::get('/update_price/{id}',[PriceController::class,'edit']);
Route::get('/transaction/detail/{tanggal_transaksi}',[TransaksiController::class,'show']);
Route::get('/analisis/sales',[AnalisisController::class,'SalesChart']);
Route::get('/analisis/platfroms',[AnalisisController::class,'PlatfromChart']);
Route::get('/analisis/menus',[AnalisisController::class,'MenuChart']);
Route::get('/transaksi/pdf', [TransaksiController::class, 'Pdf']);
// ...
// Route::get('/api/transaksi-bulan', [AnalisisController::class, 'getTransactionsByMonth'])->name('analisis.transaksi.bulan');


Route::resource('/menu',MenuController::class);
Route::resource('/platfrom',PlatfromController::class);
Route::resource('/update_price',PriceController::class);
Route::resource('/komisi',commissionController::class);
Route::resource('/transaction',TransaksiController::class);
Route::resource('/admin',RegisterController::class);

Route::post('/komisi/store',[commissionController::class,'store']);
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/register',[RegisterController::class,'store']);
Route::post('/logout',[LoginController::class,'logout']);
Route::post('/price/platfrom/store',[PlatfromController::class,'store']);
Route::post('/price/store',[PriceController::class,'store']);
Route::post('/transaction/store',[TransaksiController::class,'store']);




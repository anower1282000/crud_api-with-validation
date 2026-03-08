<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products',[ApiController::class,'index'])->name('product.list');
Route::post('/products-store',[ApiController::class,'store'])->name('product.store');
Route::get('/product-details/{id}',[ApiController::class,'show'])->name('product.details');
Route::post('/products-update/{id}',[ApiController::class,'update'])->name('product.update');
Route::delete('/products-delete/{id}',[ApiController::class,'destroy'])->name('product.delete');

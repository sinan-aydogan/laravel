<?php

Route::middleware('auth:sanctum')->group(function (){
    Route::resource('warehouse', \App\Http\Controllers\WarehouseController::class);
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    Route::resource('transaction', \App\Http\Controllers\TransactionController::class);
});

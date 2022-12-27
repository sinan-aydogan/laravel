<?php

Route::middleware('auth:sanctum')->group(function (){
    Route::resource('warehouse', \App\Http\Controllers\WarehouseController::class);
});

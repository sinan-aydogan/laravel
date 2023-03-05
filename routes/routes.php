<?php

Route::middleware('auth:sanctum')->group(function (){
    Route::resource('warehouse', \App\Http\Controllers\WarehouseController::class);
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    Route::resource('transaction', \App\Http\Controllers\TransactionController::class);

    /*Stock Card Routes*/
    Route::get('stock-card', [\App\Http\Controllers\StockCardController::class, 'index'])->name('stockCard.index');
    Route::post('stock-card/update', [\App\Http\Controllers\StockCardController::class, 'update'])->name('stockCard.update');

    /*Temp Route*/
    Route::get('stock/{product}/{warehouse}/{quantity}/{type}', function ($product, $warehouse, $quantity, $type){
        $stockCard = \App\Models\Stock::where(['product_id' => $product, 'warehouse_id' => $warehouse])->first();

        /*Update Stock*/
        if($type=='incoming'){
            /*Add*/
            $stockCard->update([
                'quantity' => $stockCard->quantity + $quantity
            ]);
        }else{
            /*Extraction*/
            if($stockCard->quantity > $quantity){
                $stockCard->update([
                    'quantity' => $stockCard->quantity - $quantity
                ]);
            }else{
                return 'Yetersiz stok';
            }

        }
        return $stockCard;
    });

    /*Roles*/
    Route::resource('role', \App\Http\Controllers\RoleController::class);
    Route::resource('permission', \App\Http\Controllers\PermissionController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
});

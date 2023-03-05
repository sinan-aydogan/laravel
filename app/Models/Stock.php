<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = "product_warehouse";
    protected $fillable = ['product_id', 'warehouse_id','quantity'];

    /*Product*/
    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    /*Warehouse*/
    public function warehouse(){
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }
}

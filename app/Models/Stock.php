<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory;

    protected $table = "product_warehouse";

    /*Product*/
    public function product():BelongsTo{
        return $this->belongsTo(Product::class);
    }

    /*Warehouse*/
    public function warehouse():BelongsTo{
        return $this->belongsTo(Warehouse::class);
    }

    /*Transactions*/
    public function transactions():HasMany{
        return $this->hasMany(Transaction::class);
    }
}

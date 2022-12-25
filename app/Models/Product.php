<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /*Warehouses*/
    public function warehouses():BelongsToMany{
        return $this->belongsToMany(Warehouse::class)->withPivot('quantity');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /*Products*/
    public function products():BelongsToMany{
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}

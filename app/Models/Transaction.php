<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['stock_id', 'quantity', 'type', 'user_id'];

    /*Stock*/
    public function stock():BelongsTo{
        return $this->belongsTo(Stock::class);
    }
}

<?php

namespace App\Models;

use App\Traits\FillAuthor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory, FillAuthor;

    protected $fillable = ['stock_id', 'quantity', 'type', 'user_id'];

    /*Created Date*/
    protected function createdAt():Attribute{
        return Attribute::make(
            get: fn($value)=> Carbon::make($value)->diffForHumans()
        );
    }

    /*Stock*/
    public function stock():BelongsTo{
        return $this->belongsTo(Stock::class);
    }
}

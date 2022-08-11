<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'summary',
        'status'
    ];

    // protected $guarded = [
    //     'id'
    // ];

    // protected $table = 'yazilar';
    // protected $primaryKey = 'yazilar_id';
    // public $timestamps = false;
    // const CREATED_AT = 'olusturulma_tarihi';
    // const UPDATED_AT = 'guncelleme_tarihi';
    // protected $connection = 'sqlite';

    protected $attributes = [
        'status' => true,
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function authors(){
        return $this->belongsToMany(User::class);
    }
}

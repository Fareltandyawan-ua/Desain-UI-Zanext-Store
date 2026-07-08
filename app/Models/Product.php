<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'brand', 'price', 'old_price',
        'rating', 'image', 'tag', 'category', 'description', 'stock',
    ];

    protected $casts = [
        'price' => 'integer',
        'old_price' => 'integer',
        'rating' => 'float',
        'stock' => 'integer',
    ];
}

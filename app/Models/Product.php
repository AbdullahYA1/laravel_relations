<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'description', 'image', 'category', 'stock', 'active'];

    function orders()
    {
        return $this->belongsToMany(Order::class, 'pivot_product_and_order')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}


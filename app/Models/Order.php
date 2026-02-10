<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'total_amount', 'status'];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function products()
    {
        return $this->belongsToMany(Product::class, 'pivot_product_and_order')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}

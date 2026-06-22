<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'brand_id',
        'image',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale',
    ];

    // For JSON images to convert into array
    protected $casts = [
        'image' => 'array', 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems() // Fixed: 'orederItems' -> 'orderItems'
    {
        return $this->hasMany(OrderItem::class);
    }
}

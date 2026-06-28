<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'notes',
    ];
      protected $casts = [
        'total_amount' => 'decimal:2',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
  public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

     public function address(){
        return $this->hasOne(Address::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'placed_by',
        'fulfilled_by',
        'coffee_bean_id',
        'quantity_kg',
        'price_total',
        'status',
    ];

    public function placedBy()
    {
        return $this->belongsTo(User::class, 'placed_by');
    }

    public function fulfilledBy()
    {
        return $this->belongsTo(User::class, 'fulfilled_by');
    }

    public function coffeeBean()
    {
        return $this->belongsTo(CoffeeBean::class);
    }
}

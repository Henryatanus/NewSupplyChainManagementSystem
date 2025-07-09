<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SupplyCenter;


class Inventory extends Model
{
    protected $fillable = [
        'supply_center_id',
        'coffee_bean_id',
        'quantity_kg',
    ];

    public function supplyCenter()
    {
        return $this->belongsTo(SupplyCenter::class);
    }

    public function coffeeBean()
    {
        return $this->belongsTo(CoffeeBean::class);
    }

}

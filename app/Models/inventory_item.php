<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory_item extends Model
{
    use HasFactory;

     protected $fillable = [
        'inventory_id',
        'product_id',
        'quantity',
        'unit_amount',
        'total_amount',
    ];

    public function inventory()
    {
        return $this->belongsTo(inventory::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;


     protected $fillable = [
        'name',
        'slug',
        'price',
        'wholesale_price',
        'buying_price',
        'is_active',
    ];



    public function salesItems()
    {
        return $this->hasMany(sales_item::class);
    }

    public function sales()
    {
        return $this->hasMany(sales::class);
    }
    public function inventories()
    {
        return $this->hasMany(inventory::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_item extends Model
{
    use HasFactory;

     protected $fillable = [
        'sales_id',
        'product_id',
        'quantity',
        'unit_amount',
        'total_amount',
    ];

    public function sale()
    {
        return $this->belongsTo(sales::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function sales()
    {
        return $this->belongsTo(sales::class, 'sales_id');
    }

    public function products()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock_movement extends Model
{
    use HasFactory;

     protected $fillable = [
        'product_id',
        'quantity',
        'type',
        'reference',
        'notes'
    ];

    public function product()
    {
        return $this->belongsTo(product::class);
    }


}

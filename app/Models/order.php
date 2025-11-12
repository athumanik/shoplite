<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'grand_total',
        'payment_method',
        'status',
        'receipt',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(order_item::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}

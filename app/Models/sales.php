<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class sales extends Model
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
        return $this->hasMany(sales_item::class);
    }

    public function sales_items()
    {
        return $this->hasMany(sales_item::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public static function generateReceipt(): string
    {
        $prefix = 'R';
        $date = now()->format('d'); // e.g., 20250623
        $random = strtoupper(Str::random(2)); // e.g., XZQ
        $number = mt_rand(10, 99); // 4-digit random number

        return "{$prefix}-{$date}-{$random}{$number}";
    }
}

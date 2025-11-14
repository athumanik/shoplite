<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class inventory extends Model
{
    use HasFactory;


    protected $fillable = [
        'supplier',
        'grand_total',
        'payment_method',
        'batch_no',
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
        return $this->hasMany(inventory_item::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }

          // CALCULATIONS

    public static function generateReceipt(): string
    {
        $prefix = 'S';
        $date = now()->format('md'); // e.g., 20250623
        $random = strtoupper(Str::random(2)); // e.g., XZQ
        $number = mt_rand(10, 99); // 4-digit random number

        return "{$prefix}-{$date}-{$random}{$number}";
    }

    public static function generateBatch(): string
    {
        $prefix = 'B';
        $date = now()->format('md'); // Shorter date: 250623
        $random = strtoupper(Str::random(2)); // e.g., KU
        $number = mt_rand(10, 99); // 3-digit random number

        return "{$prefix}-{$random}{$number}";
    }
}

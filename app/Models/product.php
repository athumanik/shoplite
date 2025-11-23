<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;


     protected $fillable = [
        'name',
        'slug',
        'stock',
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

    // Ui

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:0',
        'wholesale_price' => 'decimal:0',
        'buying_price' => 'decimal:0',
        'stock' => 'decimal:0',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to search products by name or slug.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        });
    }



    /**
     * Reduce stock when sale is done
     */
    public function reduceStock(int $quantity)
    {
        if (!$this->hasEnoughStock($quantity)) {
            throw new Exception("Not enough stock for {$this->name}");
        }

        $this->decrement('stock', $quantity);
    }

    /**
     * Increase stock when new stock is added
     */
    public function addStock(int $quantity)
    {
        $this->increment('stock', $quantity);
    }

    /**
     * how to use the function
     * $product = Product::findOrFail($request->product_id);
     * $product->addStock($request->quantity);
     */
}

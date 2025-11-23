<?php

namespace App\Services;

use App\Models\stock_movement;

class StockMovementService
{
    public function record($productId, $quantity, $type, $reference = null, $notes = null)
    {
        return stock_movement::create([
            'product_id' => $productId,
            'quantity' => $quantity,
            'type' => $type,
            'reference' => $reference,
            'notes' => $notes
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
     public function index()
    {
        $products = product::select(
            'id',
            'name',
            'slug',
            'price',
            'wholesale_price',
            'buying_price',
            'is_active',
            'created_at'
        )
            ->where('is_active', true)
            ->get();

        return response()->json([
            "status" => true,
            "message" => "Products loaded successfully",
            "data" => $products
        ]);
    }
}

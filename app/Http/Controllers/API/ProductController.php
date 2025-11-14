<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function index()
    {
        // return only fields the frontend needs
        $products = product::select('id','name','slug','price','wholesale_price','buying_price','is_active','created_at')->where('is_active', true)->get();
        return response()->json($products);
    }

    public function show(product $product)
    {
        return response()->json($product);
    }
}

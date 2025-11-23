<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
   public function product(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('price', 'like', "%{$search}%")
              ->orWhere('wholesale_price', 'like', "%{$search}%");
        });
    }

    $products = $query->orderBy('created_at', 'desc')->paginate(10);

    return response()->json($products);
}

    public function index()
    {
        $products = Product::select(
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


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:0',
            'buying_price' => 'nullable|numeric|min:0',
            // 'is_active' => 'boolean'
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $product = product::create($validated);

        return response()->json([
            "message" => "Product saved successfully",
            "data" => $product
        ], 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'price' => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:0',
            'buying_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function stats()
    {
        $totalProducts = product::count();
        $activeProducts = product::where('is_active', true)->count();
        $avgRetailPrice = product::avg('price');

        // Get product with highest margin
        $topProduct = product::select('name')
            ->whereNotNull('buying_price')
            ->orderByRaw('(price - buying_price) / buying_price DESC')
            ->first();

        return response()->json([
            'total_products' => $totalProducts,
            'active_products' => $activeProducts,
            'avg_retail_price' => $avgRetailPrice,
            'top_product' => $topProduct ? $topProduct->name : null
        ]);
    }

}

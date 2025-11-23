<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

      public function main()
    {
            if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('products.main', [

        ]);
    }
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
            if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('product.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product,slug',
            'price' => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:0',
            'buying_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Ensure slug is unique
        if (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $this->generateUniqueSlug($validated['slug']);
        }

        $product = Product::create($validated);

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product')->ignore($product->id),
            ],
            'price' => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:0',
            'buying_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Ensure slug is unique if changed
        if ($product->slug !== $validated['slug'] && Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $this->generateUniqueSlug($validated['slug']);
        }

        $product->update($validated);

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Generate a unique slug if the provided one already exists
     */
    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

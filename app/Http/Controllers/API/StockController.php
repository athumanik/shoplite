<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\inventory;
use App\Models\inventory_item;
use App\Models\product;
use App\Models\sales;
use App\Models\sales_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\order;

class StockController extends Controller
{
    public function index()
    {
        // return only fields the frontend needs
        $products = product::select('id', 'name', 'slug', 'stock', 'price', 'wholesale_price', 'buying_price', 'is_active', 'created_at')->where('is_active', true)->get();
        return response()->json($products);
    }

    public function show(product $product)
    {
        return response()->json($product);
    }


    public function sale(Request $request)
    {
        $request->validate([
            'customer' => 'nullable|string|max:255',
            'customer_type' => 'nullable|string',
            'payment_method' => 'required|string|max:50',
            'grand_total' => 'nullable|numeric',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_amount' => 'required|numeric',
            'items.*.total_amount' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {

            // AUTO-DETECT STATUS BASED ON PAYMENT METHOD
            $payment = strtolower($request->payment_method);
            $receipt = sales::generateReceipt();

            $status = match ($payment) {
                'cash', 'mpesa', 'tigo', 'airtel', 'card' => 'paid',
                'credit', 'loan' => 'pending',
                default => 'pending',
            };

            $noting = $request->notes ?? 'Sales made by ' . (Auth::check() ? Auth::user()->name : 'Guest')
                . ' at ' . now()->format('H:i');


            // Create Sale
            $sale = sales::create([
                'customer' => $request->customer ?? 'Regular',
                'customer_type' => $request->customer_type ?? 'regular',
                'payment_method' => $request->payment_method,
                'status' => $status,
                'receipt' => $receipt,
                'notes' => $noting,
                'grand_total' => 0
            ]);

            $grandTotal = 0;

            foreach ($request->items as $item) {
                $total = $item['quantity'] * $item['unit_amount'];

                sales_item::create([
                    'sales_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $total
                ]);

                $grandTotal += $total;
            }

            $sale->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();
            return response()->json(['success' => true, 'sale' => $sale->load('sales_items')], 201);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Could not save sale', 'error' => $e->getMessage()], 500);
        }
    }


    // finest sales logic

    public function stock(Request $request)
    {
        $request->validate([

            'supplier' => 'nullable|string|max:255',
            'payment_method' => 'required|string|max:50',
            'grand_total' => 'nullable|numeric',
            'items' => 'required|array|min:1',

            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_amount' => 'required|numeric',
            'items.*.total_amount' => 'required|numeric',

            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();



        try {

            // AUTO-DETECT STATUS BASED ON PAYMENT METHOD
            $payment = strtolower($request->payment_method);
            $receipt = inventory::generateReceipt();
            $batch = inventory::generateBatch();

            $status = match ($payment) {
                'cash', 'mpesa', 'tigo', 'airtel', 'card' => 'paid',
                'credit', 'loan' => 'pending',
                default => 'pending',
            };
            $noting = 'Inventory made by ' . (Auth::check() ? Auth::user()->name : 'Guest')
                . ' at ' . now()->format('H:i');


            /** ---------------------------------
             * 1️⃣ Create Inventory Record
             * ----------------------------------*/
            $inventory = inventory::create([
                'supplier' => $request->supplier ?? 'WholeSaler',
                'payment_method' => $request->payment_method,
                'batch_no' => $batch,
                'status' => $status,
                'grand_total' => 0,
                'notes' => $request->notes ?? 'Stock added by ' . (Auth::user()->name ?? 'Guest')
            ]);

            $grandTotal = 0;

            /** ---------------------------------
             * 2️⃣ Loop through items & increment stock
             * ----------------------------------*/
            foreach ($request->items as $item) {

                $product = product::lockForUpdate()->findOrFail($item['product_id']);

                $total = $item['quantity'] * $item['unit_amount'];

                // Increment stock using model function
                $product->addStock(
                    $item['quantity'],
                    "Stock Ref: {$inventory->receipt}"
                );

                $productCode = strtoupper(substr($product->name, 0, 3)); // First 3 letters of name
                $sku = $productCode . '-' . str_pad($product->id, 3, '0', STR_PAD_LEFT) . '-' . $$inventory->batch;

                inventory_item::create([
                    'inventory_id' => $inventory->id,
                    'product_id' => $item['product_id'],
                    'sku' => $sku,
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $total,
                ]);

                $grandTotal += $total;
            }

            /** ---------------------------------
             * 3️⃣ Update Final Total
             * ----------------------------------*/
            $inventory->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'inventory' => $inventory->load('items')
            ], 201);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier' => 'required|string',
            'payment_method' => 'required|string',
            'grand_total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_amount' => 'required|numeric',
            'items.*.total_amount' => 'required|numeric',
        ]);

        // 1️⃣ Create inventory record
        $inventory = inventory::create([
            'supplier' => $validated['supplier'],
            'payment_method' => $validated['payment_method'],
            'grand_total' => $validated['grand_total'],
            'status' => 'paid',
            'notes' => $request->notes ?? "Stock added by System",
            'receipt' => "S-" . rand(1000, 9999) . "-Q" . rand(100, 999),
        ]);

        // 2️⃣ Insert inventory items
        foreach ($validated['items'] as $item) {
            inventory_item::create([
                'inventory_id' => $inventory->id,
                'product_id' => $item['product_id'],
                'sku' => "SKU-" . strtoupper(uniqid()),
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['total_amount'],
            ]);

            // 3️⃣ Update Product Stock
            Product::where('id', $item['product_id'])->increment('stock', $item['stock']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inventory added successfully',
            'inventory' => $inventory,
        ], 201);
    }


}

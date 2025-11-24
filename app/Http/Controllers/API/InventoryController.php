<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\inventory;
use App\Models\inventory_item;
use App\Services\StockMovementService;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = inventory::with(['items.product']);

        // Optional: search by customer, invoice, etc.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('supplier', 'like', "%{$search}%")
                    ->orWhere('grand_total', 'like', "%{$search}%")
                    ->orWhere('batch_no', 'like', "%{$search}%");
            });
        }

        // Order latest and paginate
        $sales = $query->latest()->paginate(10);

        return response()->json($sales);
    }
    public function store(Request $request, StockMovementService $stock)
    {
        $validated = $request->validate([
            'supplier' => 'required|string',
            'payment_method' => 'required|string|max:50',

            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',

            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Status based on payment method
            $payment = strtolower($validated['payment_method']);
            $status = in_array($payment, ['cash', 'mpesa', 'tigo', 'airtel', 'card']) ? 'paid' : 'pending';

            // Create inventory record first
            $inventory = inventory::create([
                'supplier' => $validated['supplier'],
                'payment_method' => $validated['payment_method'],
                'status' => $status,
                'notes' => $validated['notes'] ?? null,
            ]);

            // Generate batch + receipt
            $batch = 'B' . $inventory->id . strtoupper(Str::random(3));
            $receipt = 'R-' . strtoupper(Str::random(3)) . str_pad($inventory->id, 4, '0', STR_PAD_LEFT);

            $inventory->update([
                'batch_no' => $batch,
                'receipt' => $receipt,
            ]);

            $grandTotal = 0;

            foreach ($validated['items'] as $item) {

                $product = Product::findOrFail($item['product_id']);

                $unit_amount = $product->price;
                // $unit_amount = $product->buying_price;
                $total = $unit_amount * $item['quantity'];

                $sku = strtoupper(substr($product->name, 0, 3))
                    . '-' . str_pad($product->id, 3, '0', STR_PAD_LEFT)
                    . '-' . $batch;

                inventory_item::create([
                    'inventory_id' => $inventory->id,
                    'product_id' => $product->id,
                    'sku' => $sku,
                    'quantity' => $item['quantity'],
                    'unit_amount' => $unit_amount,
                    'total_amount' => $total,
                ]);

                // Update product stock
                $product->increment('stock', $item['quantity']);

                $grandTotal += $total;

                $stock->record(
                    $product->id,
                    +$item['quantity'],
                    'inventory',
                    'INV-' . $inventory->id,
                    'Stock add via todays purchases at ' . now()->format('H:i')
                );
            }

            // Save total
            $inventory->update(['grand_total' => $grandTotal]);

            DB::commit();

            return response()->json([
                'message' => 'Inventory stored successfully',
                'data' => $inventory->load('items.product')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Inventory Error: " . $e->getMessage());

            return response()->json([
                'message' => 'Failed to store inventory',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $inventory = inventory::with('items.product')->find($id);
        if (!$inventory) {
            return response()->json(['message' => 'Stock not found'], 404);
        }
        return response()->json($inventory);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'supplier' => 'required|string',
            'grand_total' => 'required|numeric',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_amount' => 'required|numeric|min:0',
            'items.*.total_amount' => 'required|numeric|min:0',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        try {
            DB::beginTransaction();

            $inventory = inventory::findOrFail($id);
            // Update main inventory fields
            $inventory->update([
                'supplier' => $validated['supplier'],
                'grand_total' => $validated['grand_total'],
                'notes' => $validated['notes'] ?? 'Stock updated @ ' . now(),
                'created_at' => $inventory->created_at,
                // 'created_at' => $validated['created_at'] ?? $inventory->created_at,
                // 'updated_at' => $validated['updated_at'] ?? now(),
            ]);

            // You can regenerate batch here if you want a new one on update:
            $batch = $inventory->batch_no;
            //—or uncomment below to force a fresh batch:
            // $batch = 'B' . $inventory->id . strtoupper(Str::random(3));
            // $inventory->update(['batch_no' => $batch]);

            // Delete old items and re-create
            $inventory->items()->delete();

            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                $sku = strtoupper(substr($product->name, 0, 3))
                    . '-'
                    . str_pad($product->id, 3, '0', STR_PAD_LEFT)
                    . '-'
                    . $batch;

                inventory_item::create([
                    'inventory_id' => $inventory->id,
                    'product_id' => $product->id,
                    'sku' => $sku,
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $item['total_amount'],
                    'created_at' => $validated['created_at'] ?? $inventory->created_at,
                    'updated_at' => $validated['updated_at'] ?? now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Stock updated successfully',
                'inventory' => $inventory->load('items.product'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Stock Update Error: " . $e->getMessage());

            return response()->json([
                'message' => 'Failed to update inventory',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $inventory = inventory::find($id);
        if (!$inventory) {
            return response()->json(['message' => 'Stock not found'], 404);
        }
        $inventory->delete();
        return response()->json(['message' => 'Stock deleted successfully']);
    }
}

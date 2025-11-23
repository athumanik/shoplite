<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\sales;
use App\Models\sales_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function sales(Request $request)
    {
        $query = Sales::with(['items.product']);

        // Optional: search by customer, invoice, etc.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('customer', 'like', "%{$search}%")
                    ->orWhere('grand_total', 'like', "%{$search}%")
                    ->orWhere('customer_type', 'like', "%{$search}%");
            });
        }

        // Order latest and paginate
        $sales = $query->latest()->paginate(10);

        return response()->json($sales);
    }

    /**
     * Get all sales with items
     */
    public function index()
    {
        $sales = sales::with('items.product')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $sales
        ]);
    }

    public function stats()
    {
        $today = now()->toDateString();

        $totalSales = sales::sum('grand_total');

        $todaySales = sales::whereDate('created_at', $today)
            ->sum('grand_total');

        $todayTransactions = sales::whereDate('created_at', $today)
            ->count();

        $pendingOrders = sales::where('status', 'pending')->count();

        $avgSale = sales::avg('grand_total');

        return response()->json([
            'status' => true,
            'stats' => [
                'total_sales' => $totalSales,
                'today_sales' => $todaySales,
                'today_transactions' => $todayTransactions,
                'pending_orders' => $pendingOrders,
                'avg_sale' => round($avgSale, 2),
            ]
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'nullable|string',
            'customer_type' => 'nullable|string',
            'payment_method' => 'required|string',
            'status' => 'nullable|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_amount' => 'required|numeric|min:0',
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
                $product = product::findOrFail($item['product_id']);
                $total = $item['quantity'] * $item['unit_amount'];

                sales_item::create([
                    'sales_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $total
                ]);

                // Decrement stock
                $product->decrement('stock', $item['quantity']);

                $grandTotal += $total;

            }

            $sale->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Sale created successfully',
                'data' => $sale->load('items.product')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Show single sale
     */
    public function show($id)
    {
        $sale = sales::with('items.product')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $sale
        ]);
    }

    /**
     * Update sale and items
     */
    public function update(Request $request, $id)
    {
        $sale = sales::findOrFail($id);

        DB::beginTransaction();

        try {

            $sale->update([
                'customer' => $request->customer ?? $sale->customer,
                'payment_method' => $request->payment_method ?? $sale->payment_method,
                'status' => $request->status ?? $sale->status,
                'notes' => $request->notes ?? $sale->notes,
            ]);

            // Delete old items
            $sale->items()->delete();

            $grandTotal = 0;

            foreach ($request->items as $item) {
                $total = $item['quantity'] * $item['unit_amount'];

                sales_item::create([
                    'sales_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $total,
                ]);

                $grandTotal += $total;
            }

            $sale->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Sale updated successfully',
                'data' => $sale->load('items.product')
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete sale
     */
    public function destroy($id)
    {
        $sale = sales::findOrFail($id);
        $sale->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sale deleted successfully'
        ]);
    }
}

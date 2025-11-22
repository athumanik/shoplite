<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\sales;
use App\Models\sales_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\order;

class PosController extends Controller
{
    public function index()
    {
        // return only fields the frontend needs
        $products = product::select('id', 'name', 'slug','stock', 'price', 'wholesale_price', 'buying_price', 'is_active', 'created_at')->where('is_active', true)->get();
        return response()->json($products);
    }

    public function show(product $product)
    {
        return response()->json($product);
    }

    public function order(Request $req)
    {
        $data = $req->validate([
            'customer' => 'nullable|string|max:255',
            'payment_method' => 'required|string|max:50',
            'grand_total' => 'nullable|numeric',
            'status' => 'nullable|string|max:50',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_amount' => 'required|numeric',
            'items.*.total_amount' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $receipt = sales::generateReceipt();

            $noting = $data['notes'] ?? 'Sales made by ' . (Auth::check() ? Auth::user()->name : 'Guest')
                . ' at ' . now()->format('H:i');

            $order = order::create([
                'customer' => $data['customer'] ?? 'Regular',
                'grand_total' => $data['grand_total'] ?? 0,
                'payment_method' => $data['payment_method'],
                'status' => $data['status'] ?? 'pending',
                'notes' => $noting,
                'receipt' => $receipt,
            ]);

            foreach ($data['items'] as $it) {
                $order->order_items()->create([
                    'product_id' => $it['product_id'],
                    'quantity' => $it['quantity'],
                    'unit_amount' => $it['unit_amount'],
                    'total_amount' => $it['total_amount'],
                ]);
            }

            DB::commit();
            return response()->json(['success' => true, 'order' => $order->load('order_items')], 201);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Could not save order', 'error' => $e->getMessage()], 500);
        }
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


    public function sales(Request $request)
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

            /** ---------------------------------
             *  1. FIRST: Check stock before saving anything
             * ----------------------------------*/
            foreach ($request->items as $item) {

                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                if (!$product->hasEnoughStock($item['quantity'])) {
                    throw new \Exception("Out of stock: {$product->name}");
                }
            }

            /** ---------------------------------
             *  2. Create Sale
             * ----------------------------------*/
            $payment = strtolower($request->payment_method);
            $receipt = sales::generateReceipt();

            $status = match ($payment) {
                'cash', 'mpesa', 'tigo', 'airtel', 'card' => 'paid',
                'credit', 'loan' => 'pending',
                default => 'pending',
            };

            $noting = $request->notes ?? 'Sales made by '
                . (Auth::check() ? Auth::user()->name : 'Guest')
                . ' at ' . now()->format('H:i');

            $sale = sales::create([
                'customer' => $request->customer ?? 'Regular',
                'customer_type' => $request->customer_type ?? 'regular',
                'payment_method' => $request->payment_method,
                'status' => $status,
                'receipt' => $receipt,
                'notes' => $noting,
                'grand_total' => 0
            ]);

            /** ---------------------------------
             *  3. Add items + decrement stock
             * ----------------------------------*/
            $grandTotal = 0;

            foreach ($request->items as $item) {

                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                // Reduce stock using model function
                $product->reduceStock($item['quantity']);

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

            /** ---------------------------------
             *  4. Update final total
             * ----------------------------------*/
            $sale->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'sale' => $sale->load('sales_items')
            ], 201);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}

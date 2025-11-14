<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\order;
use App\Models\orderItem;
use App\Models\product;

class OrderController extends Controller
{
    public function store(Request $req)
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
            $order = order::create([
                'customer' => $data['customer'] ?? 'Regular',
                'grand_total' => $data['grand_total'] ?? 0,
                'payment_method' => $data['payment_method'],
                'status' => $data['status'] ?? 'pending',
                'notes' => $data['notes'] ?? null,
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
}

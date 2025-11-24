<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sales;
use App\Models\sales_item;
use Illuminate\Support\Facades\DB;

class WholeSaleController extends Controller
{
    /**
     * Get all sales with items
     */
      public function index(Request $request)
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
}

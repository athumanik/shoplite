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
    public function index()
    {
        $sales = sales::with('items.product')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $sales
        ]);
    }
}

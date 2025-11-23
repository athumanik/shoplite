<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sales;
use App\Models\sales_item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
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

}

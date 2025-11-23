<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

        public function main()
    {
            if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('shops.main', [

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

        $stats = [
            "count" => product::count(),
            "total_sales" => product::sum('price'),
            "this_month" => product::whereMonth('created_at', now()->month)->sum('price'),
            "avg_monthly" => product::selectRaw("AVG(price) as avg")->value('avg'),
            // "top_customer" => product::selectRaw("custome, SUM(price) as total")
            //     ->groupBy("customer")
            //     ->orderByDesc("total")
            //     ->first(),
        ];
        return view(
            'shop.index',
            [
                'stats' => $stats,
            ]
        );
    }
}

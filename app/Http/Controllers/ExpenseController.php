<?php

namespace App\Http\Controllers;

use App\Models\expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{

    public function main()
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('expenses.main', [

        ]);
    }
    public function index()
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        $expenses = Expense::orderBy('created_at', 'desc')->paginate(20);
        $stats = [
            "count" => expense::count(),
            "total_expenses" => expense::sum('amount'),
            "this_month" => expense::whereMonth('created_at', now()->month)->sum('amount'),
            "avg_monthly" => expense::selectRaw("AVG(amount) as avg")->value('avg'),
            "top_category" => expense::selectRaw("category, SUM(amount) as total")
                ->groupBy("category")
                ->orderByDesc("total")
                ->first(),
        ];
        return view('expense.index', [
            'stats' => $stats,
            'expenses' => $expenses
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = expense::query();

        // Search
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('category', 'like', "%{$request->search}%")
                ->orWhere('receipt', 'like', "%{$request->search}%");
        }

        $expenses = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($expenses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "amount" => "required|numeric",
            "category" => "nullable|string",
            "receipt" => "nullable|string",
            "notes" => "nullable|string",
        ]);

        $expense = expense::create($validated);

        return response()->json([
            "message" => "Expense saved successfully",
            "data" => $expense
        ], 201);
    }

    public function show($id)
    {
        return expense::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $expense = expense::findOrFail($id);

        $expense->update($request->all());

        return response()->json([
            "message" => "Expense updated successfully",
            "data" => $expense
        ]);
    }

    public function destroy($id)
    {
        expense::findOrFail($id)->delete();

        return response()->json(["message" => "Expense deleted"]);
    }

    // 📌 Real-time stats
    public function stats()
    {
        return [
            "total_expenses" => expense::sum('amount'),
            "this_month" => expense::whereMonth('created_at', now()->month)->sum('amount'),
            "avg_monthly" => expense::selectRaw("AVG(amount) as avg")->value('avg'),
            "top_category" => expense::selectRaw("category, SUM(amount) as total")
                ->groupBy("category")
                ->orderByDesc("total")
                ->first(),
        ];
    }
}

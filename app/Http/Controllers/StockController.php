<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        // if (!Auth::check()) {
        //     return redirect(route('login'));
        // }
        $user = Auth::user();

        return view('stock.index', [
            'user' => $user,
        ]);
    }
    public function guest()
    {
        return view('stock.guest', [

        ]);
    }
}

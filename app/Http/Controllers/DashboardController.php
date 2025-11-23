<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            return redirect(route('login'));
        }
        $users = User::count();
        $products = product::count();
        return view('dashboard', [
            'users' => $users,
            'products' => $products,
        ]);
    }
}

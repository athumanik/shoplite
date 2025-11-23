<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('salez.index', [

        ]);
    }
    public function sales()
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('sale.main', [

        ]);
    }
}

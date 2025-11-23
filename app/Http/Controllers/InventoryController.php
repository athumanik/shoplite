<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function main()
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('inventories.main', [

        ]);
    }
    public function index()
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('inventory.index', [

        ]);
    }
}

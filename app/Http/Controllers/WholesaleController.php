<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WholesaleController extends Controller
{
        public function main()
    {
            if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('wholesales.main', [

        ]);
    }
    public function index()
    {
            if (!Auth::check()) {
            return redirect(route('login'));
        }

        $user = Auth::user();
        return view('wholesale.index', [
            'user' => $user,
        ]);
    }
}

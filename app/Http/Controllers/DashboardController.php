<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index(){

        $users= User::count();
        $products= product::count();
        return view('dashboard',[
            'users' => $users,
            'products' => $products,
        ]);
    }
}

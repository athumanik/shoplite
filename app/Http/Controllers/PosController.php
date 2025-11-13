<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pos.index', [
            'user' => $user,
        ]);
    }
    public function guest()
    {
        return view('pos.guest', [

        ]);
    }
}

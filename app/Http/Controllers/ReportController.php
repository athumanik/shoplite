<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
        public function index()
    {
            if (!Auth::check()) {
            return redirect(route('login'));
        }

        return view('report.index', [

        ]);
    }
}

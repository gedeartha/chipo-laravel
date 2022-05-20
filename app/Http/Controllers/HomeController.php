<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->get('login') == null) {
            return view('auth.login');
        }
        
        $orders = DB::table('orders')
            ->where('status', '!=', 'Pending')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        return view('home', 
            [
                'orders' => $orders
            ]
        );
    }
}

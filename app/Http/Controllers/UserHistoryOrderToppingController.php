<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserHistoryOrderToppingController extends Controller
{
    public function index()
    {
        if (session()->get('login') == null) {
            return view('auth.login');
        }
   
        $orders = DB::table('order_toppings')
            ->where('user_id', session()->get('user_id'))
            ->where('status', '!=', 'Pending')
            ->get();

        return view('history-order-topping', ['orders' => $orders, 'invoice' => '']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserHistoryOrderController extends Controller
{
    public function index()
    {
        if (session()->get('login') == null) {
            return view('auth.login');
        }
   
        $orders = DB::table('orders')
            ->where('user_id', session()->get('user_id'))
            ->where('status', '!=', 'Pending')
            ->get();

        return view('history-order', ['orders' => $orders, 'invoice' => '']);
    }

    public function search(Request $request)
    {
        if ($request->invoice) {
            $orders = DB::table('orders')
                ->where('user_id', session()->get('user_id'))
                ->where('status', '!=', 'Pending')
                ->where('invoice', $request->invoice)
                ->get();
        } else {
            $orders = DB::table('orders')
                ->where('user_id', session()->get('user_id'))
                ->where('status', '!=', 'Pending')
                ->get();
        }
        
        
        return view('history-order', ['orders' => $orders, 'invoice' => $request->invoice]);
    }
}

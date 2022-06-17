<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderToppingController extends Controller
{
    public function index()
    {
        if (session()->get('login') == null) {
            return view('admin.login');
        } else {
            $orders = DB::table('order_toppings')
                ->where('status', '!=', 'Pending')
                ->get();
                
            return view('admin.history-order-topping', ['orders' => $orders]);
        }
    }

    public function detail($invoice)
    {
        $order = DB::table('orders')->where('invoice', $invoice)->first();
        
        $order = DB::table('order_toppings')
            ->where('invoice', $invoice)
            ->first();
        
        $orderItems = DB::table('order_topping_items')
            ->where('invoice', $invoice)
            ->get();
            
        $orderItemsCount = DB::table('order_topping_items')
            ->where('invoice', $order->invoice)
            ->count();
        
        return view('admin.detail-order-topping', [
            'order' => $order, 
            'order_items' => $orderItems,
            'quantity' => $orderItemsCount,
        ]);
    }

    public function update(Request $request, $invoice)
    {
        $update = DB::table('order_toppings')->where('invoice', $invoice)->update([
            'status' => $request->status,
            'updated_at' =>now()]);

        if ($update) {
            return back()
            ->with([
                    'success' => 'Status berhasil dirubah.'
            ]);
        } else {
            return back()
            ->withInput()
            ->with([
                    'error' => 'Status gagal dirubah.'
            ]);
        }
    }

    public function export(Request $request)
    {
        
        if (isset($request->date_start) && isset($request->date_end)) {
            $req_date_start = str_replace('/', '-', $request->date_start);
            $req_date_end = str_replace('/', '-', $request->date_end);
            
            $date_start = date("Y-m-d", strtotime($req_date_start));
            $date_end = date("Y-m-d", strtotime($req_date_end));
            
            session([
                'date_start' => $date_start,
                'date_end' => $date_end,
            ]);

            $orders = DB::Table('order_toppings')
                ->where('created_at', '>=', $date_start)
                ->where('created_at', '<', $date_end)
                ->where('status', '!=', 'Pending')
                ->get();
        } else {
            $req_date_start = '';
            $req_date_end = '';
            
            session([
                'date_start' => $req_date_start,
                'date_end' => $req_date_end,
            ]);
            
            $orders = DB::table('orders')
                ->where('created_at', '>=', $req_date_start)
                ->where('created_at', '<', $req_date_end)
                ->where('status', '!=', 'Pending')
                ->get();
        }
        
        return view('admin.export.history-order-topping', ['orders' => $orders, 'date_start' => $req_date_start, 'date_end' => $req_date_end]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function index()
    {
        if (session()->get('login') == null) {
            return view('admin.login');
        } else {
            $orders = DB::table('orders')
                ->where('status', '!=', 'Pending')
                ->get();
                
            return view('admin.history-order', ['orders' => $orders]);
        }
    }

    public function detail($invoice)
    {
        $order = DB::table('orders')->where('invoice', $invoice)->first();
        $orderMenu = DB::table('order_menus')->where('invoice', $invoice)->first();
        $orderMenus = DB::table('order_menus')->where('invoice', $invoice)->get();

        $orderItemsCount = DB::table('order_items')->where('menu_id', $orderMenu->menu_id)->count();

        return view('admin.detail-order', [
            'order' => $order, 
            'orderMenus' => $orderMenus,
            'quantity' => $orderItemsCount
        ]);
    }
    
    public function update(Request $request, $invoice)
    {
        $update = DB::table('orders')->where('invoice', $invoice)->update([
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

            $orders = DB::Table('orders')
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
        
        return view('admin.export.history-order', ['orders' => $orders, 'date_start' => $req_date_start, 'date_end' => $req_date_end]);
    }
}

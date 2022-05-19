<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCheckout extends Controller
{
    public function index(Request $request)
    {
        
        $invoice = session()->get('invoice');
        $data = DB::table('order_menus')
            ->where('invoice', $invoice)
            ->count();
        
        if ($data == 0) {
            return redirect()
            ->route('menu')
            ->with([
                'success' => 'Pesanan kosong silahkan pesan menu terlebih dahulu!'
            ]);
        }

        $list_menus = DB::table('orders')
            ->join('order_menus', 'orders.invoice', '=', 'order_menus.invoice')
            ->where('orders.invoice', '=', $invoice)
            ->get();

        $toppings = DB::table('order_items')
            ->join('toppings', 'order_items.topping', '=', 'toppings.name')
            ->where('menu_id', $list_menus[0]->menu_id)
            ->get();
        
        // dd($list_menus, $toppings);

        return view('checkout', ['order_menus' => $list_menus, 'toppings' => $toppings]);
    }
    
    public function destroy($id)
    {
        $order_menus = DB::table('order_menus')->where('id', $id)->first();
        // dd($order_menus);
        $menu_id = $order_menus->menu_id;

        $order_items = DB::table('order_items')->where('menu_id', $menu_id);
        $order_items->delete();
        
        $order_menu = DB::table('order_menus')->where('id', $id);
        $order_menu->delete();

        return redirect()
            ->back()
            ->with([
                    'success' => 'Pesanan berhasil dihapus.'
            ]);
        
    }

    public function update(Request $request)
    {

        $invoice = session()->get('invoice');
        
        $update = DB::table('orders')
            ->where('invoice', $invoice)
            ->update([
                'status' => 'Belum Dibayar',
                'total' => $request->total,
            ]);
        
        if ($update) {
            return redirect()
            ->route('invoice-order', $invoice)
            ->with([
                'success' => 'Topping berhasil ditambahkan.'
            ]);
            
        }
        
    }
}

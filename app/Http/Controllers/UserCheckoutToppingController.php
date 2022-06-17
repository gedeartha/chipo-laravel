<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCheckoutToppingController extends Controller
{
    public function index()
    {
        $invoice = session()->get('invoice');
        $data = DB::table('order_topping_items')
            ->where('invoice', $invoice)
            ->count();
        
        if ($data == 0) {
            return redirect()
            ->route('order-topping')
            ->with([
                'success' => 'Pesanan kosong silahkan pesan topping terlebih dahulu!'
            ]);
        }
        
        $order_topping_items = DB::table('order_topping_items')
            ->where('invoice', '=', $invoice)
            ->get();
        
        return view('checkout-topping', ['order_topping_items' => $order_topping_items]);
    }
    
    public function destroy($id)
    {
        $invoice = session()->get('invoice');
        
        $order_topping_item = DB::table('order_topping_items')
            ->where('invoice', $invoice)
            ->where('topping', $id)
            ->delete();

        return redirect()
            ->back()
            ->with([
                    'success' => 'Pesanan berhasil dihapus.'
            ]);
    }

    public function update(Request $request)
    {
        $invoice = session()->get('invoice');
        
        $update = DB::table('order_toppings')
            ->where('invoice', $invoice)
            ->update([
                'status' => 'Belum Dibayar',
                'total' => $request->total,
            ]);
        
        if ($update) {
            return redirect()
            ->route('invoice-topping', $invoice)
            ->with([
                'success' => 'Topping berhasil ditambahkan.'
            ]);
            
        }
        
    }
}

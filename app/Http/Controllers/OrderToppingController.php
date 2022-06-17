<?php

namespace App\Http\Controllers;

use App\Models\OrderTopping;
use App\Models\OrderToppingItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderToppingController extends Controller
{
    public function index()
    {

        if (session()->get('login') == null) {
            return view('auth.login');
        }

        $now = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));

        $invoiceGet = DB::table('order_toppings')
            ->where('user_id', session()->get('user_id'))
            ->where('updated_at', '>=', $now)
            ->where('updated_at', '<', $tomorrow)
            ->where('status', 'Pending')
            // ->latest()->first();
            ->count();
        
        $invoiceValue = DB::table('order_toppings')
            ->where('user_id', session()->get('user_id'))
            ->where('updated_at', '>=', $now)
            ->where('updated_at', '<', $tomorrow)
            ->latest()->first();
        
        if (!$invoiceValue) {
            return redirect()
            ->route('index')
            ->with([
                'error' => 'Akun tidak tercatat pada Meja manapun, silahkan hubungi pelayanan untuk mencatat Meja Anda.'
            ]);
        } else {
            session([
                'table' => $invoiceValue->table,
            ]);
        }

        if ($invoiceGet == 0) {
            $invoice = random_int(1000, 9999);
            
            session([
                'invoice' => $invoice,
            ]);
        } else {
            session([
                'invoice' => $invoiceValue->invoice,
            ]);
        }

        $toppings = DB::table('toppings')->where('status', 'Tersedia')->get();
        
        return view('order-topping', ['toppings' => $toppings]);
    }

    public function store(Request $request)
    {
        // dd(session()->all());
        // dd($request);
        
        $invoice = session()->get('invoice');
        $table = session()->get('table');
        
        $topping_id = $request->input('topping_id');
        $topping_price = $request->input('topping_price');
        $topping_qty = $request->input('qty');
        
        $total = $topping_price + $topping_qty;
        
        OrderTopping::create([
            'invoice' => $invoice,
            'user_id' => session()->get('user_id'),
            'table' => $table,
            'status' => 'Pending',
            'total' => $total,
            'payment' => '-',
        ]);
        
        OrderToppingItems::insert([
            'invoice' => $invoice,
            'topping' => $topping_id,
            'topping_price' => $topping_price,
            'qty' => $topping_qty,
        ]);
        
        return redirect()
            ->route('checkout-topping');
    }
    
    public function update(Request $request)
    {
        // dd(session()->all());
        // dd($request);
        
        $invoice = $request->session()->get('invoice');

        $topping_id = $request->input('topping_id');
        $topping_price = $request->input('topping_price');
        $topping_qty = $request->input('qty');
        
        $order_topping_item = DB::table('order_topping_items')
            ->where('invoice', $invoice)
            ->where('topping', $topping_id)
            ->first();
        
        if ($order_topping_item) {
            $update_qty = $order_topping_item->qty + $topping_qty;

            $update = DB::table('order_topping_items')
                ->where('invoice', $invoice)
                ->where('topping', $topping_id)
                ->update([
                    'qty' => $update_qty,
            ]);
        } else {
            OrderToppingItems::insert([
                'invoice' => $invoice,
                'topping' => $topping_id,
                'topping_price' => $topping_price,
                'qty' => $topping_qty,
            ]);
        }
        
        return redirect()
            ->route('checkout-topping');
    }
}

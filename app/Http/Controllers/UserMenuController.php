<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderMenu;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserMenuController extends Controller
{
    public function index()
    {
        
        if (session()->get('login') == null) {
            return view('auth.login');
        }

        $now = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));

        $invoiceGet = DB::table('orders')
            ->where('user_id', session()->get('user_id'))
            ->where('updated_at', '>=', $now)
            ->where('updated_at', '<', $tomorrow)
            ->where('status', 'Pending')
            // ->latest()->first();
            ->count();
        
        $invoiceValue = DB::table('orders')
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

        $menus = DB::table('menus')->where('status', 'Tersedia')->get();
        
        return view('menu', ['menus' => $menus]);
    }

    public function topping(Request $request)
    {
        $menu = DB::table('menus')
            ->where('id', $request->menu)
            ->first();

        $toppings = DB::table('toppings')
            ->where('status', 'Tersedia')
            ->get();

        return view('topping', ['menu' => $menu, 'toppings' => $toppings]);
    }

    public function store(Request $request)
    {
        // dd(session()->all());

        $invoice = session()->get('invoice');
        $table = session()->get('table');

        $menu_id = random_int(1, 9999);
        $sum_topping = Topping::count();
        
        $menu_price =$request->input('menu_price');

        $name = $request->input('name', []);
        $toggle = $request->input('toggleValue', []);
        $price = $request->input('price', []);
        
        $topping = [];
        $total_topping = 0;

        for ($i=1; $i <= $sum_topping; $i++) {
            if ($toggle[$i] == '1') {
                $topping[] = [
                    'menu_id' => $menu_id,
                    'topping' => $name[$i],
                    'topping_price' => $price[$i],
                ];
                
                $total_topping = $total_topping + $price[$i];
            }

        }

        $total = $menu_price + $total_topping;

        Order::create([
            'invoice' => $invoice,
            'user_id' => session()->get('user_id'),
            'table' => $table,
            'status' => 'Pending',
            'total' => $total,
            'payment' => '-',
            'proof' => '-',
        ]);
        
        OrderMenu::insert([
            'invoice' => $invoice,
            'menu_id' => $menu_id,
            'menu' => $request->bubur_id,
            'menu_price' => $menu_price,
        ]);

        // if topping not null -> save
        if ($topping) {
            OrderItem::insert($topping);
        }

        return redirect()
            ->route('checkout');
    }
    
    public function update(Request $request)
    {
        $invoice = $request->session()->get('invoice');

        $menu_id = random_int(1, 9999);
        $sum_topping = Topping::count();
        
        $menu_price =$request->input('menu_price');

        $name = $request->input('name', []);
        $toggle = $request->input('toggleValue', []);
        $price = $request->input('price', []);
        
        $topping = [];
        $total_topping = 0;

        for ($i=1; $i <= $sum_topping; $i++) {
            if ($toggle[$i] == '1') {
                $topping[] = [
                    'menu_id' => $menu_id,
                    'topping' => $name[$i],
                    'topping_price' => $price[$i],
                ];
                
                $total_topping = $total_topping + $price[$i];
            }

        }

        $total = $menu_price + $total_topping;

        OrderMenu::insert([
            'invoice' => $invoice,
            'menu_id' => $menu_id,
            'menu' => $request->bubur_id,
            'menu_price' => $menu_price,
        ]);

        // if topping not null -> save
        if ($topping) {
            OrderItem::insert($topping);
        }

        return redirect()
            ->route('checkout');
    }
    
}

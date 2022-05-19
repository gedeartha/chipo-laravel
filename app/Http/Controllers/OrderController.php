<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Topping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $invoice = random_int(1000, 9999);

        $sum_topping = Topping::count();
        $quantity = 0;

        $post = Order::create([
            'invoice' => $invoice,
            'order_by' => 'User',
            'seat' => '12',
            'quantity' => '1',
            'status' => 'Pending',
            'total' => '0',
            'payment' => 'cash',
            'proof' => '-',
        ]);
    }
}

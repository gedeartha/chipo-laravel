<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;

class OrdersExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $date_start = session()->get('date_start');
        $date_end = session()->get('date_end');

        $orders = DB::Table('orders')
            ->where('created_at', '>=', $date_start)
            ->where('created_at', '<', $date_end)
            ->where('status', '!=', 'Pending')
            ->get();
            
        $download = [];
        foreach ($orders as $order) {
            $order = DB::Table('orders')
                ->where('id', $order->id)
                ->first();
                    
            $user = DB::Table('users')
                ->where('id', $order->user_id)
                ->first();
                
            $order_menus = DB::Table('order_menus')
                ->where('invoice', $order->invoice)
                ->count();

            $download[] = [
                'created_at' => $order->created_at,
                'invoice' =>  $order->invoice,
                'user' => $user->name,
                'table' => $order->table,
                'jumlah' => $order_menus,
                'total' => $order->total,
                'status' => $order->status,
            ];
        }
        
        return $download;
    }
}

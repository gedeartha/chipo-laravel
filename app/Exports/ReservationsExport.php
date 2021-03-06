<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;

class ReservationsExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $date_start = session()->get('date_start');
        $date_end = session()->get('date_end');

        $orders = DB::Table('reservations')
            ->where('created_at', '>=', $date_start)
            ->where('created_at', '<', $date_end)
            ->where('status', '!=', 'Pending')
            ->get();
            
        $download = [];
        foreach ($orders as $order) {
            $order = DB::Table('reservations')
                ->where('id', $order->id)
                ->first();
                    
            $user = DB::Table('users')
                ->where('id', $order->user_id)
                ->first();
                
            $download[] = [
                'created_at' => $order->created_at,
                'invoice' =>  $order->invoice,
                'user' => $user->name,
                'reservation_date' => $order->reservation_date,
                'reservation_time' => $order->reservation_time,
                'total' => $order->total,
                'status' => $order->status,
            ];
        }
        
        return $download;
    }
}

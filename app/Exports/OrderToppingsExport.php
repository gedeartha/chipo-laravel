<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderToppingsExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Tanggal',
            'Invoice',
            'Pembeli',
            'No. Meja',
            'Jumlah',
            'Total',
            'Status',
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function array(): array
    {
        $date_start = session()->get('date_start');
        $date_end = session()->get('date_end');

        $orders = DB::Table('order_toppings')
            ->where('created_at', '>=', $date_start)
            ->where('created_at', '<', $date_end)
            ->where('status', '!=', 'Pending')
            ->get();
            
        $download = [];
        foreach ($orders as $order) {
            $order = DB::Table('order_toppings')
                ->where('id', $order->id)
                ->first();
                    
            $user = DB::Table('users')
                ->where('id', $order->user_id)
                ->first();
                
            $totalQty = DB::Table('order_topping_items')
                ->where('invoice', $order->invoice)
                ->count();

            $download[] = [
                'created_at' => $order->created_at,
                'invoice' =>  $order->invoice,
                'user' => $user->name,
                'table' => $order->table,
                'jumlah' => $totalQty,
                'total' => $order->total,
                'status' => $order->status,
            ];
        }
        
        return $download;
    }
}


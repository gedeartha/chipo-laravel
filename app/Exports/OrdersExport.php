<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $date_start = session()->get('date_start');
        $date_end = session()->get('date_end');

        $export = DB::Table('orders')
            ->where('created_at', '>=', $date_start)
            ->where('created_at', '<', $date_end)
            ->get();

        return $export;
    }
}

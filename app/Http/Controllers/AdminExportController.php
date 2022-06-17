<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Exports\OrderToppingsExport;
use App\Exports\ReservationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminExportController extends Controller
{
    public function order()
    {
        if (session()->get('date_start') == '') {
            return back()
            ->with([
                    'warning' => 'Silahkan pilih tanggal terlebih dahulu!'
            ]);
        } else {
            return Excel::download(new OrdersExport, 'history-order.xlsx');
        }
    }

    public function reservation()
    {        
        if (session()->get('date_start') == '') {
            return back()
            ->with([
                    'warning' => 'Silahkan pilih tanggal terlebih dahulu!'
            ]);
        } else {
            return Excel::download(new ReservationsExport, 'history-reservasi.xlsx');
        }
    }

    public function topping()
    {        
        if (session()->get('date_start') == '') {
            return back()
            ->with([
                    'warning' => 'Silahkan pilih tanggal terlebih dahulu!'
            ]);
        } else {
            return Excel::download(new OrderToppingsExport, 'history-order-topping.xlsx');
        }
    }
}

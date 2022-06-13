<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Exports\ReservationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminExportController extends Controller
{
    public function order(Request $request)
    {
        $req_date_start = str_replace('/', '-', $request->date_start);
        $req_date_end = str_replace('/', '-', $request->date_end);
        
        $date_start = date("Y-m-d", strtotime($req_date_start));
        $date_end = date("Y-m-d", strtotime($req_date_end));

        session([
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);

        return Excel::download(new OrdersExport, 'history-order.xlsx');
    }

    public function reservation(Request $request)
    {
        $req_date_start = str_replace('/', '-', $request->date_start);
        $req_date_end = str_replace('/', '-', $request->date_end);
        
        $date_start = date("Y-m-d", strtotime($req_date_start));
        $date_end = date("Y-m-d", strtotime($req_date_end));

        session([
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);

        return Excel::download(new ReservationsExport, 'history-reservasi.xlsx');
    }
}

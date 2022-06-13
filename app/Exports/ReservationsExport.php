<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReservationsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $date_start = session()->get('date_start');
        $date_end = session()->get('date_end');

        $export = DB::Table('reservations')
            ->where('created_at', '>=', $date_start)
            ->where('created_at', '<', $date_end)
            ->get();

        return $export;
    }
}

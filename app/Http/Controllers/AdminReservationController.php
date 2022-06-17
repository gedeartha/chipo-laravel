<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReservationController extends Controller
{
    public function index()
    {
        if (session()->get('login') == null) {
            return view('admin.login');
        } else {
            $reservations = DB::table('reservations')
                ->where('status', '!=', 'Pending')
                ->get();
            return view('admin.history-reservation', ['reservations' => $reservations]);
        }
    }

    public function detail($invoice)
    {
        $reservation = DB::table('reservations')->where('invoice', $invoice)->first();
        
        $reservationTables = DB::table('reservation_tables')
            ->where('invoice', $invoice)
            ->get();

        return view('admin.detail-reservation', 
            [
                'reservation' => $reservation,
                'reservationTables' => $reservationTables
            ]);
    }
    
    public function update(Request $request, $invoice)
    {
        $update = DB::table('reservations')->where('invoice', $invoice)->update([
            'status' => $request->status,
            'updated_at' =>now()]);

        if ($update) {
            return back()
            ->with([
                    'success' => 'Status berhasil dirubah.'
            ]);
        } else {
            return back()
            ->withInput()
            ->with([
                    'error' => 'Status gagal dirubah.'
            ]);
        } 
    }
    
    public function export(Request $request)
    {        
        if (isset($request->date_start) && isset($request->date_end)) {
            $req_date_start = str_replace('/', '-', $request->date_start);
            $req_date_end = str_replace('/', '-', $request->date_end);
            
            $date_start = date("Y-m-d", strtotime($req_date_start));
            $date_end = date("Y-m-d", strtotime($req_date_end));
            
            session([
                'date_start' => $date_start,
                'date_end' => $date_end,
            ]);

            $reservations = DB::Table('reservations')
                ->where('created_at', '>=', $date_start)
                ->where('created_at', '<', $date_end)
                ->where('status', '!=', 'Pending')
                ->get();
        } else {
            $req_date_start = '';
            $req_date_end = '';
            
            session([
                'date_start' => $req_date_start,
                'date_end' => $req_date_end,
            ]);
            
            $reservations = DB::table('reservations')
                ->where('created_at', '>=', $req_date_start)
                ->where('created_at', '<', $req_date_end)
                ->where('status', '!=', 'Pending')
                ->get();
        }
        
        return view('admin.export.history-reservation', ['reservations' => $reservations, 'date_start' => $req_date_start, 'date_end' => $req_date_end]);
    }
}

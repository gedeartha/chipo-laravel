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
            $reservations = Reservation::latest()->get();
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
}

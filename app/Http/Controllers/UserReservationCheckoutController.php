<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserReservationCheckoutController extends Controller
{
    public function index()
    {   
        if (session()->get('login') == null) {
            return view('auth.login');
        } else {

            // dd(session()->all());

            $reservationTables = DB::table('reservation_tables')
            ->where('invoice', session()->get('invoiceReservation'))
            ->get();
            
            $totalReservation = DB::table('reservation_tables')
            ->where('invoice', session()->get('invoiceReservation'))
            ->count();
            
            $totalPayment = $totalReservation * 5500;
            
            return view('reservasi-checkout', [
                'reservationTables' => $reservationTables,
                'totalPayment' => $totalPayment
            ]);
        }
    }

    public function update()
    {
        $invoice = session()->get('invoiceReservation');

        $totalReservation = DB::table('reservation_tables')
        ->where('invoice', session()->get('invoiceReservation'))
        ->count();
        
        $totalPayment = $totalReservation * 5500;

        DB::table('reservations')
        ->where('invoice', $invoice)
        ->update([
            'status' => 'Belum Dibayar',
            'total' => $totalPayment,
        ]);

        session()->forget(['invoiceReservation', 'reservation_date', 'reservation_time']);

        // dd(session()->all());
        return redirect()
            ->route('invoice.reservation', $invoice);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserHistoryReservationController extends Controller
{
    public function index()
    {
        
        if (session()->get('login') == null) {
            return view('auth.login');
        }
   
        $reservations = DB::table('reservations')
            ->where('user_id', session()->get('user_id'))
            ->where('status', '!=', 'Pending')
            ->get();
            
        return view('history-reservation', [
            'reservations' => $reservations,
            'invoice' => ''
        ]);
    }
    
    public function search(Request $request)
    {
        if ($request->invoice) {
            $reservations = DB::table('reservations')
                ->where('user_id', session()->get('user_id'))
                ->where('status', '!=', 'Pending')
                ->where('invoice', $request->invoice)
                ->get();
        } else {
            $reservations = DB::table('reservations')
                ->where('user_id', session()->get('user_id'))
                ->where('status', '!=', 'Pending')
                ->get();
        }
        
        return view('history-reservation', [
            'reservations' => $reservations,
            'invoice' => $request->invoice
        ]);
    }
}

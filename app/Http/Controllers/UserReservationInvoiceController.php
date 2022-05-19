<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserReservationInvoiceController extends Controller
{
    public function index($invoice)
    {
        $reservation = DB::table('reservations')
            ->where('invoice', $invoice)
            ->first();
        
        $user = DB::table('users')
            ->where('id', $reservation->user_id)
            ->first();
            
        $reservationTables = DB::table('reservation_tables')
            ->where('invoice', $invoice)
            ->get();

        return view('invoice-reservation', [
            'user' => $user,
            'reservation' => $reservation,
            'reservationTables' => $reservationTables
        ]);
    }

    public function update(Request $request, $invoice)
    {

        if ($request->file('image') !== null) {
                
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/proof/', $image->hashName());
            
            $update = DB::table('reservations')->where('invoice', $invoice)
                ->update([
                    'proof' => $request->image->hashName(),
                    'status' => 'Sudah Dibayar',
                    'updated_at' =>now()
                ]);

            return redirect()
            ->route('invoice.reservation', $invoice)
            ->with([
                'successInvoice' => 'Bukti transfer berhasil diupload'
            ]);
        } else {
            return redirect()
            ->route('invoice.reservation', $invoice)
            ->with([
                'errorInvoice' => 'Mohon upload bukti transfer'
            ]);
        }
    }
}

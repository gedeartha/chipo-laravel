<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationTable;
use App\Models\Table;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserReservationController extends Controller
{
    public function index()
    {   
        if (session()->get('login') == null) {
            return view('auth.login');
        } else {
            $tables = Table::latest()->get();
            $times = Time::get();
            
            DB::table('reservations')
                ->where('user_id', session()->get('user_id'))
                ->where('status', 'Pending')
                ->delete();
            
            return view('reservasi', ['tables' => $tables, 'times' => $times]);
        }
    }

    public function detail(Request $request)
    {
        // dd($request);
        
        $now = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));

        $invoiceGet = DB::table('reservations')
            ->where('user_id', session()->get('user_id'))
            ->where('updated_at', '>=', $now)
            ->where('updated_at', '<', $tomorrow)
            ->where('status', 'Pending')
            ->count();
            
        if ($invoiceGet == 0) {
            $invoice = random_int(1000, 9999);
            
            session([
                'invoiceReservation' => $invoice,
            ]);
        } else {
            $invoiceValue = DB::table('reservations')
                ->where('user_id', session()->get('user_id'))
                ->where('updated_at', '>=', $now)
                ->where('updated_at', '<', $tomorrow)
                ->latest()->first();

            $invoice = $invoiceValue->invoice;

            session([
                'invoiceReservation' => $invoice,
            ]);
        }

        $dateRequest = $request->date;
        $date = date("Y-m-d", strtotime($dateRequest) );
        
        Reservation::create([
            'invoice' => $invoice,
            'user_id' => session()->get('user_id'),
            'reservation_date' => $date,
            'reservation_time' => $request->time,
            'status' => 'Pending',
            'total' => 0,
            'proof' => '-',
        ]);

        // dd(session()->all());
        
        $tables = Table::latest()->get();
        $times = Time::get();
        
        session([
            'reservation_date' => $date,
            'reservation_time' => $request->time,
        ]);

        return view('reservasi-detail', ['tables' => $tables, 'date' => $date ,'times' => $times, 'time' => $request->time]);
    }
    
    public function cart(Request $request, $table)
    {
        
        $path = $request->getRequestUri();
        $getTable = explode("reservasi-cart/",$path);

        // dd($getTable[1]);

        $tableCek = DB::table('reservation_tables')
            ->where('invoice', session()->get('invoiceReservation'))
            ->where('table_id', $getTable[1])
            ->count();

        if ($tableCek == 0) {

            if ($getTable[1] != 0) {
                ReservationTable::insert([
                    'invoice' => session()->get('invoiceReservation'),
                    'table_id' => $getTable[1],
                    'reservation_date' => session()->get('reservation_date'),
                    'reservation_time' => session()->get('reservation_time'),
                ]);
            }
        }
        
        $tableList = DB::table('reservation_tables')
            ->where('invoice', session()->get('invoiceReservation'))
            ->get();

        $tables = Table::latest()->get();
        return view('reservasi-cart', [
            'tables' => $tables, 
            'date' => session()->get('reservation_date'), 
            'time' => session()->get('reservation_date'), 
            'table_selected' => $getTable[1],
            'tableLists' => $tableList,
        ]);

    }

    public function delete($table)
    {        
        DB::table('reservation_tables')
        ->where('invoice', session()->get('invoiceReservation'))
        ->where('table_id', $table)
        ->delete();
        
        return redirect()
            ->route('reservasi.cart', 0);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Midtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserInvoiceToppingController extends Controller
{
    public function index($invoice)
    {
        if (session()->get('login') == null) {
            return view('auth.login');
        }
        
        $order = DB::table('order_toppings')
            ->where('invoice', $invoice)
            ->first();

        $user = DB::table('users')
            ->where('id', $order->user_id)
            ->first();
        
        $orderItems = DB::table('order_topping_items')
            ->where('invoice', $invoice)
            ->get();
            
        $orderItemsCount = DB::table('order_topping_items')
            ->where('invoice', $order->invoice)
            ->count();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-IK-LC0zAW-djydF887uRncFK';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $curl = curl_init();
        
        if ($order->status == 'Belum Dibayar' && $order->midtrans_order_id != null) {
            $AUTH_STRING = base64_encode("SB-Mid-server-IK-LC0zAW-djydF887uRncFK:");
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/" . $order->midtrans_order_id . "/status",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: Basic ' . $AUTH_STRING,
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
    
            if ($err) {
                echo "cURL Error #:" . $err;
            }
            // else {
            //     print_r($response);
            // }

            $json = json_decode($response);

            // dd($json->payment_type);

            if ($json->payment_type == 'bank_transfer' && $json->transaction_status == 'settlement') {

                $update = DB::table('orders')
                    ->where('invoice', $invoice)
                    ->update([
                        'status' => 'Sudah Dibayar',
                ]);
            }

        }
        
        $midtrans_order_id = rand(1000, 9999999);
            
        $params = array(
            'transaction_details' => array(
                'order_id' => $midtrans_order_id,
                'gross_amount' => $order->total,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'last_name' => '',
                'email' => $user->email,
                'phone' => '',
            ),
        );
            
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        return view('invoice-topping', [
            'user' => $user,
            'order' => $order, 
            'order_items' => $orderItems,
            'quantity' => $orderItemsCount,
            'snap_token' => $snapToken
        ]);
    }

    public function update(Request $request)
    {
        $update = DB::table('order_toppings')
            ->where('invoice', $request->get('invoice'))
            ->update([
                'status' => 'Cash',
                'updated_at' =>now()
        ]);

        return redirect()
            ->route('invoice-topping', $request->get('invoice'))
            ->with([
                'successInvoice' => 'Berhasil memilih pembayaran cash'
        ]);
    }
    
    public function payment(Request $request)
    {
        $json = json_decode($request->get('json'));
        
        $order_id = $json->order_id;
        $transaction_status = $json->transaction_status;

        if ($transaction_status == 'pending') {
            $status = 'Belum Dibayar';
        } else if ($transaction_status == 'settlement') {
            $status = 'Sudah Dibayar';
        } else {
            $status = 'Error';
        }
        
        Midtrans::create([
            'order_id' => $order_id,
            'transaction_status' => $transaction_status,
        ]);

        $update = DB::table('order_toppings')
                ->where('invoice', $request->invoice)
                ->update([
                    'midtrans_order_id' => $order_id,
                    'status' => $status,
                ]);

        // return $json;

        return redirect()
        ->route('invoice-topping', $request->invoice);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserInvoiceController extends Controller
{
    public function index($invoice)
    {
        if (session()->get('login') == null) {
            return view('auth.login');
        }
        
        $order = DB::table('orders')->where('invoice', $invoice)->first();
        $orderMenu = DB::table('order_menus')->where('invoice', $invoice)->first();
        $orderMenus = DB::table('order_menus')->where('invoice', $invoice)->get();

        $orderItemsCount = DB::table('order_items')->where('menu_id', $orderMenu->menu_id)->count();

        return view('invoice-order', [
            'order' => $order, 
            'orderMenus' => $orderMenus,
            'quantity' => $orderItemsCount
        ]);
        
    }

    public function update(Request $request, $invoice)
    {

        if ($request->payment == 'Transfer') {

            if ($request->file('image') !== null) {
                
                //upload image
                $image = $request->file('image');
                $image->storeAs('public/proof/', $image->hashName());
                
                $update = DB::table('orders')->where('invoice', $invoice)->update([
                    'proof' => $request->image->hashName(),
                    'status' => 'Sudah Dibayar',
                    'updated_at' =>now()]);

                return redirect()
                ->route('invoice-order', $invoice)
                ->with([
                    'successInvoice' => 'Bukti transfer berhasil diupload'
                ]);
            } else {
                return redirect()
                ->route('invoice-order', $invoice)
                ->with([
                    'errorInvoice' => 'Mohon upload bukti transfer'
                ]);
            }

        } else {
            
            $update = DB::table('orders')->where('invoice', $invoice)->update([
                'status' => 'Cash',
                'updated_at' =>now()]);

            return redirect()
            ->route('invoice-order', $invoice)
            ->with([
                'successInvoice' => 'Berhasil memilih pembayaran cash'
            ]);
        }
    }
}

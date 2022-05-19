<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUsersController extends Controller
{
    public function index()
    {   
        if (session()->get('login') == null) {
            return view('admin.login');
        } else {
            $users = User::latest()->get();
            return view('admin.users.index', ['users' => $users]);
        }

    }
    
    public function add()
    {   
        if (session()->get('login') == null) {
            return view('admin.login');
        } else {
            return view('admin.users.add');
        }

    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'table' => 'required',
        ]);

        $now = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));

        $tableReq = $request->table;
        $tableCek = DB::table('orders')
            ->where('table', $tableReq)
            ->where('updated_at', '>=', $now)
            ->where('updated_at', '<', $tomorrow)
            ->count();

        if ($tableCek == 0) {
            $invoice = random_int(1000, 9999);
            $invoiceCek = DB::table('orders')->where('invoice', $invoice)->count();
            if ($invoiceCek > 0) {
                $invoice = random_int(1000, 9999);

                return $invoice;
            }
            
            $post = User::create([
                'name' => $request->name,
                'email' => $request->email . '@chipo.com',
                'password' => 'chipo',
            ]);
            
            $user = DB::table('users')
                ->where('email', $request->email . '@chipo.com')->first();
            
            Order::create([
                'invoice' => $invoice,
                'user_id' => $user->id,
                'table' => $request->table,
                'status' => 'Pending',
                'total' => 0,
                'payment' => '-',
                'proof' => '-',
            ]);
                
            if ($post) {
                return redirect()
                ->route('admin.users.index')
                ->with([
                    'success' => 'User berhasil ditambahkan.'
                ]);
            } else {
                return redirect()
                ->route('admin.users.index')
                ->withInput()
                ->with([
                    'error' => 'User gagal ditambahkan.'
                ]);
            }
            
        } else {
            return redirect()
            ->route('admin.users.add')
            ->withInput()
            ->with([
                'error' => 'Meja tidak tersedia/telah digunakan pelanggan lain.'
            ]);
        }
        
    }
    
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id) 
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'table' => 'required',
        ]);
        
        $now = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        
        //Cek meja jika telah digunakan hari ini
        $tableReq = $request->table;
        $tableCek = DB::table('orders')
            ->where('table', $tableReq)
            ->where('updated_at', '>=', $now)
            ->where('updated_at', '<', $tomorrow)
            ->count();
            
            if ($tableCek == 0) {
                $invoice = random_int(1000, 9999);
                $invoiceCek = DB::table('orders')->where('invoice', $invoice)->count();
                if ($invoiceCek > 0) {
                    $invoice = random_int(1000, 9999);
    
                    return $invoice;
                }
                
                Order::create([
                    'invoice' => $invoice,
                    'user_id' => $id,
                    'table' => $request->table,
                    'status' => 'Pending',
                    'total' => 0,
                    'payment' => '-',
                    'proof' => '-',
                ]);
                
                $updateUser = DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email . '@chipo.com',
                    'updated_at' =>now()
                ]);
                
                return redirect()
                ->route('admin.users.edit', $id)
                ->withInput()
                ->with([
                    'success' => 'Akun berhasil diupdate.'
                ]);
    
            } else {
                return redirect()
                ->route('admin.users.edit', $id)
                ->withInput()
                ->with([
                    'error' => 'Meja tidak tersedia/telah digunakan pelanggan lain.'
                ]);
            }

    }
}

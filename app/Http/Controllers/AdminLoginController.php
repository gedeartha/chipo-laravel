<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email . '@chipo.com';

        $login = DB::table('admins')
        ->where('email', $email)
        ->where('password', $request->password)
        ->count();

        if ($login > 0) {   
            $admin = DB::table('admins')->where('email', $email)->first();

            session([
                'login' => 'true',
                'id_admin' => $admin->id,
                'name' => $admin->name, 
                'email' => $admin->email,
                'role' => $admin->role,
            ]);
            
            return redirect()
            ->route('admin.topping.index');

        } else {
            return back()
            ->withInput()
            ->with([
                    'error' => 'Login Gagal! Email/Password Salah.'
            ]);
        }
    }
    
    public function logout()
    {       
        session()->flush();
        
        return redirect()
        ->route('admin.login.index');
    }
}

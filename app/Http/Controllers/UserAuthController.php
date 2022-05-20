<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    public function index()
    {        
        return view('login');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email . '@chipo.com';

        $login = DB::table('users')
        ->where('email', $email)
        ->where('password', $request->password)
        ->count();

        if ($login > 0) {   
            $user = DB::table('users')->where('email', $email)->first();

            session([
                'login' => 'true',
                'user_id' => $user->id,
                'name' => $user->name, 
                'email' => $user->email,
            ]);
            
            return redirect()
            ->route('index');

        } else {
            return back()
            ->withInput()
            ->with([
                    'error' => 'Email/Password Salah.'
            ]);
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirm' => 'required',
        ]);
        
        $emailCek = DB::table('users')
            ->where('email', $request->email . '@chipo.com')
            ->count();
        
        if ($emailCek == 1) {
            return redirect()
            ->back()
            ->with([
                'error' => 'Email telah digunakan!'
            ]);
        }

        if ($request->password != $request->password_confirm) {
            return redirect()
            ->back()
            ->with([
                'error' => 'Pastikan Password dan Konfirmasi Password Sesuai!'
            ]);
        }
        
        $post = User::create([
            'name' => $request->name,
            'email' => $request->email . '@chipo.com',
            'password' => $request->password
        ]);
        
        if ($post) {
            return redirect()
            ->route('login')
            ->with([
                'success' => 'Pendaftaran akun berhasil!'
            ]);
        }
    }
    
    public function navLogout()
    {       
        session()->flush();
        
        return redirect()
        ->route('login');
    }
}

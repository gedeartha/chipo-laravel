<?php

namespace App\Http\Controllers;

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

        $login = DB::table('users')
        ->where('email', $request->email)
        ->where('password', $request->password)
        ->count();

        if ($login > 0) {   
            $user = DB::table('users')->where('email', $request->email)->first();

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
    
    public function navLogout()
    {       
        session()->flush();
        
        return redirect()
        ->route('login');
    }
}

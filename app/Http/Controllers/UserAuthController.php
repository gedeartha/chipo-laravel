<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        $email = $request->email;

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
            ->where('email', $request->email)
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
            'email' => $request->email,
            'password' => $request->password
        ]);
        
        if ($post) {
            
            $details = [
                'name' => $request->name,
            ];
            
            \Mail::to($request->email)->send(new \App\Mail\RegistrationMail($details));

            return redirect()
            ->route('login')
            ->with([
                'success' => 'Pendaftaran akun berhasil!'
            ]);
        }
    }

    public function forgotPassword(Request $request)
    {
        $token = Str::random(60);

        $emailCek = DB::table('users')
            ->where('email', $request->email)
            ->first();
        
        if ($emailCek) {
            $post = PasswordReset::insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]);
            
            $details = [
                'email' => $request->email,
                'token' => $token,
                'name' => $emailCek->name
            ];
            
            \Mail::to($request->email)->send(new \App\Mail\ForgotPasswordMail($details));

            return back()
            ->with([
                'success' => 'Reset password berhasil! Periksa email Anda.'
            ]);

        } else {
            return back()
            ->with([
                'error' => 'Email tidak terdaftar!'
            ]);

        }
        
    }

    public function resetPassword($token)
    {        
        $tokenCek = DB::table('password_resets')
            ->where('token', $token)
            ->first();
                                
        if ($tokenCek != null) {
            $alert = true;
            
            $user = DB::table('users')
            ->where('email', $tokenCek->email)
            ->first();
            
            return view('account.reset-password', ['token' => $tokenCek, 'alert' => $alert, 'user_id' => $user->id]);
        } else {
            $alert = false;
            
            return view('account.reset-password', ['token' => $tokenCek, 'alert' => $alert]);
        }
    }

    public function changePassword(Request $request)
    {
        // dd($request);
        
        if ($request->password == $request->password_confirmation) {
            $update = DB::table('users')
                ->where('id', $request->user_id)
                ->update([
                    'password' => $request->password,
                    'updated_at' =>now()
                ]);

            return redirect()
                ->route('login')
                ->with([
                    'success' => 'Password berhasil dirubah! Silahkan login.'
                ]);
                
        } else {
            return back()
            ->with([
                'error' => 'Konfirmasi Password Tidak Sesuai.'
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

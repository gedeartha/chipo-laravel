<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLogoutController extends Controller
{
    public function index()
    {       
        session()->flush();
        
        return redirect()
        ->route('login.index');
    }
}

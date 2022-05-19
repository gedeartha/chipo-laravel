<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLogoutController extends Controller
{
    public function index()
    {       
        session()->flush();
        
        return redirect()
        ->route('admin.login.index');
    }
}

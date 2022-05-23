<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAdminsController extends Controller
{
    public function index()
    {   
        if (session()->get('login') == null) {
            return view('admin.users.index');
        }

        if (session()->get('role') != 'owner') {
            $users = User::latest()->get();
            return view('admin.users.index', ['users' => $users]);
        }
        
        $admins = DB::Table('admins')
            ->where('role', '!=', 'owner')
            ->get();

        return view('admin.admins.index', ['admins' => $admins]);

    }

    public function add()
    {   
        if (session()->get('login') == null) {
            return view('admin.login');
        }

        return view('admin.admins.add');

    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $email = $request->email . '@chipo.com';
        
        $post = Admin::create([
            'name' => $request->name,
            'email' => $email,
            'password' => 'chipo',
            'role' => 'admin',
        ]);

        if ($post) {
            return redirect()
            ->route('admin.admins.index')
            ->with([
                'success' => 'Admin berhasil ditambahkan.'
            ]);
        } else {
            return redirect()
            ->route('admin.admins.index')
            ->withInput()
            ->with([
                'error' => 'Admin gagal ditambahkan.'
            ]);
        }
    }
    
    public function edit($id)
    {
        $admin = DB::table('admins')->where('id', $id)->first();
        
        return view('admin.admins.edit', ['admin' => $admin]);
    }
    
    public function update(Request $request, $id) 
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $update = DB::table('admins')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email . '@chipo.com',
            'updated_at' =>now()
        ]);
        
        return redirect()
        ->route('admin.admins.edit', $id)
        ->withInput()
        ->with([
            'success' => 'Akun berhasil diupdate.'
        ]);

    }
}

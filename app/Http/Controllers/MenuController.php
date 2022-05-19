<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {        
        if (session()->get('login') == null) {
            return view('admin.login');
        } else {
            $menu = DB::table('menus')->where('id', 1)->first();
            return view('admin.menu-edit', ['menu' => $menu]);
        }
    }
    
    public function update(Request $request)
    {
        if($request->image != "") {
            $this->validate($request, [
                'image' => 'image|mimes:png,jpg,jpeg',
            ]);
            
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/upload/', $image->hashName());
            
            $update = DB::table('menus')->where('id', 1)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $request->image->hashName(),
                'updated_at' =>now()]);
        } else {            
            $update = DB::table('menus')->where('id', 1)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price]);
        }     

        if ($update) {
            return back()
            ->with([
                    'success' => 'Menu berhasil diedit.'
            ]);
        } else {
            return back()
            ->withInput()
            ->with([
                    'error' => 'Menu gagal diedit.'
            ]);
        }
        
    }
}

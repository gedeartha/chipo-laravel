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
            $menus = Menu::latest()->get();

            return view('admin.menus.index', ['menus' => $menus]);
        }
    }

    public function add()
    {
        return view('admin.menus.add');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'status' => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/upload/', $image->hashName());

        $post = Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image->hashName(),
            'status' => $request->status,
        ]);

        if ($post) {
            return redirect()
            ->route('admin.menus.index')
            ->with([
                'success' => 'Menu berhasil ditambahkan.'
            ]);
        } else {
            return redirect()
            ->route('admin.menus.index')
            ->withInput()
            ->with([
                'error' => 'Menu gagal ditambahkan.'
            ]);
        }
    }
    
    public function edit($id)
    {
        $menu = DB::table('menus')->where('id', $id)->first();
        return view('admin.menus.edit', ['menu' => $menu]);
    }
    
    public function update(Request $request, $id)
    {
        if($request->image != "") {
            $this->validate($request, [
                'image' => 'image|mimes:png,jpg,jpeg',
            ]);
            
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/upload/', $image->hashName());
            
            $update = DB::table('menus')->where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $request->image->hashName(),
                'status' => $request->status,
                'updated_at' =>now()]);
        } else {            
            $update = DB::table('menus')->where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $request->status,]);
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
    
    public function destroy($id)
    {
        $topping = DB::table('menus')->where('id', $id);
        $topping->delete();
        
        return redirect()
        ->route('admin.menus.index')
        ->with([
                'success' => 'Topping berhasil dihapus.'
        ]);
    }
}

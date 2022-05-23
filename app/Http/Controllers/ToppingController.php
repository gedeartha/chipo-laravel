<?php

namespace App\Http\Controllers;

use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToppingController extends Controller
{
    public function index()
    {   
        if (session()->get('login') == null) {
            return view('admin.login');
        } else {
            $toppings = Topping::latest()->get();
            return view('admin.topping.index', ['toppings' => $toppings]);
        }
    }

    public function add()
    {
        return view('admin.topping.add');
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

        $post = Topping::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image->hashName(),
            'status' => $request->status,
        ]);

        if ($post) {
            return redirect()
            ->route('admin.topping.index')
            ->with([
                'success' => 'Topping berhasil ditambahkan.'
            ]);
        } else {
            return redirect()
            ->route('admin.topping.index')
            ->withInput()
            ->with([
                'error' => 'Tooping gagal ditambahkan.'
            ]);
        }
    }

    public function edit($id)
    {
        $topping = DB::table('toppings')->where('id', $id)->first();
        return view('admin.topping.edit', ['topping' => $topping]);
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
            
            $update = DB::table('toppings')->where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $request->image->hashName(),
                'status' => $request->status,
                'updated_at' =>now()]);
        } else {            
            $update = DB::table('toppings')->where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $request->status,]);
        }     
        

        if ($update) {
            return back()
            ->with([
                    'success' => 'Topping berhasil diedit.'
            ]);
        } else {
            return back()
            ->withInput()
            ->with([
                    'error' => 'Tooping gagal diedit.'
            ]);
        }
        
    }

    public function destroy($id)
    {
        $topping = DB::table('toppings')->where('id', $id);
        $topping->delete();
        
        return redirect()
        ->route('admin.topping.index')
        ->with([
                'success' => 'Topping berhasil dihapus.'
        ]);
    }
}
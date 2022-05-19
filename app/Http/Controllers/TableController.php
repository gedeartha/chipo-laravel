<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function index()
    {   
        if (session()->get('login') == null) {
            return view('admin.login');
        } else {
            $tables = Table::latest()->get();
            return view('admin.table.index', ['tables' => $tables]);
        }
    }
    
    public function edit(Request $request, $table)
    {
        
        $path = $request->getRequestUri();
        $getTable = explode("/admin/table/",$path);

        // dd($getTable[1]);

        $tables = Table::latest()->get();
        return view('admin.table.edit', ['tables' => $tables, 'table_selected' => $getTable[1]]);
    }

    public function update(Request $request)
    {        
        $update = DB::table('tables')->where('table', $request->table)->update([
            'status' => $request->status,
            'updated_at' =>now()]);
        
            
        return redirect()
            ->route('admin.table.edit', $request->table)
            ->withInput()
            ->with([
                'success' => 'Perubahan status berhasil.'
        ]);
    }
}

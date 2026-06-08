<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function index()
    {
        $racks = Rack::latest()->get();
        return view('pages.admin.rackManagement', compact('racks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'factory' => 'required',
            'department' => 'required',
            'rack_code' => 'required|unique:racks'
        ]);

        Rack::create($request->all());

        return redirect()->back()
            ->with('success', 'Rack berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Rack::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'Rack berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $rack = Rack::findorFail($id);

        $request->validate([
            'factory' => 'required',
            'department' => 'required',
            'rack_code' => 'required|unique:racks,rack_code,' . $id
        ]);

        $rack->update([
            'factory' => $request->factory,
            'department' => $request->department,
            'rack_code' => $request->rack_code
        ]);

        return redirect()->back()
        ->with('succes', 'Rack berhasil diupdate');
    }
}

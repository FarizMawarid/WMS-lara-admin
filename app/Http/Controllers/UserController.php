<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view(
            'pages.admin.userManagement',
            compact('users')
        );
    }

    public function store(Request $request)
    {

        $request->validate([
            'factory' => 'required',
            'role' => 'required',
            'nik' => 'required|unique:users',
            'department' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'factory' => $request->factory,
            'role' => $request->role,
            'nik' => $request->nik,
            'department' => $request->department,

            'name' => $request->nik,
            'email' => $request->nik . '@wms.local',
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()
            ->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'factory' => 'required',
            'role' => 'required',
            'nik' => 'required|unique:users,nik,' . $id,
            'department' => 'required'
        ]);

        $user->update([
            'factory' => $request->factory,
            'role' => $request->role,
            'nik' => $request->nik,
            'department' => $request->department,
        ]);

        return redirect()->back()
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        
        User::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'User berhasil dihapus');
    }
}
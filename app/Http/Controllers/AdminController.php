<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profil()
    {
        $admins = Admin::all();
        return view('admin.profil', compact('admins'));
    }

    public function create()
    {
        return view('admin.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email',
            'password' => 'required|string|min:6',
        ]);

        Admin::create([
            'nama' => $request->nama,
            'email' => strtolower($request->email),
            'password' => hash('sha256', $request->password),
        ]);

        return redirect()->route('admin.profil')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.ubah', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->nama = $request->nama;
        $admin->email = strtolower($request->email);
        if ($request->filled('password')) {
            $admin->password = hash('sha256', $request->password);
        }
        $admin->save();

        return redirect()->route('admin.profil')->with('success', 'Admin berhasil diubah');
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admin.profil')->with('success', 'Admin berhasil dihapus');
    }
}

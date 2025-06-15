<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function hapusAdminDenganPassword(Request $request)
{
    $admin = Admin::find($request->id_admin);

    if (!$admin || !Hash::check($request->password, $admin->password)) {
        return back()->with('error', 'Password salah atau admin tidak ditemukan.');
    }

    $admin->delete();

    return redirect()->back()->with('success', 'Admin berhasil dihapus.');
}
    

    public function profilAdmin()
    {
        $admins = Admin::all();
        return view('admin.profiladmin', compact('admins'));
    }

    public function create()
    {
        return view('admin.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
            'admin_verification' => 'required|string',
        ]);

        // Cek apakah email sudah terdaftar di admin
        if (Admin::where('email', strtolower($request->email))->exists()) {
            return back()->withInput()->with('add_error', 'Email sudah terdaftar sebagai admin.');
        }

        // Cek apakah email sudah terdaftar di user
        if (User::where('email', strtolower($request->email))->exists()) {
            return back()->withInput()->with('add_error', 'Email sudah terdaftar sebagai user.');
        }

        // Verifikasi password admin yang login
        $loggedInAdmin = Auth::guard('admin')->user();
        if (!$loggedInAdmin || !Hash::check($request->admin_verification, $loggedInAdmin->password)) {
            return back()->withInput()->with('add_error', 'Verifikasi password Anda salah.');
        }

        // Simpan admin baru
        Admin::create([
            'nama' => $request->nama,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.ubah', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'old_password' => 'required',
            'password' => 'nullable|min:6',
        ]);

    // Verifikasi password lama
    if (!Hash::check($request->old_password, $admin->password)) {
        return redirect()->back()
            ->with('edit_error', 'Password lama salah')
            ->withInput()
            ->with('edit_id', $id);
        }

        // Update nama
        $admin->nama = $request->nama;

        // Update password jika diisi
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();
        return redirect()->route('admin.profiladmin')->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil dihapus');
    }

    public function daftarLaporin()
    {
        $laporan = DB::table('laporan')
            ->leftJoin('user', 'laporan.id_user', '=', 'user.id_user')
            ->leftJoin('instansi', 'laporan.instansi', '=', 'instansi.id_instansi')
            ->select('laporan.*', 'user.username', 'instansi.nama_instansi')
            ->get();

        return view('admin.daftarlaporin', compact('laporan'));
    }

    public function daftarInstansi()
    {
        $instansi = DB::table('instansi')->get();
        return view('admin.daftarinstansi', compact('instansi'));
    }

    public function profilUser()
    {
        $users = User::all();
        return view('admin.profiluser', compact('users'));
    }

    public function ubahStatusUser(Request $request)
    {
        foreach ($request->input('status', []) as $id => $status) {
            User::where('id_user', $id)->update(['status_user' => $status]);
        }

        return redirect()->route('admin.profiluser')->with('success', 'Status user berhasil diperbarui.');
    }
}

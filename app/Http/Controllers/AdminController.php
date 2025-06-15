<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function hapusAdminDenganPassword(Request $request)
{
    $request->validate([
        'id_admin' => 'required|exists:admin,id_admin',
        'password' => 'required',
    ]);

    $admin = DB::table('admin')->where('id_admin', $request->id_admin)->first();

    if (!$admin) {
        return back()->with('error', 'Admin tidak ditemukan.');
    }

    // Validasi password (diasumsikan hash SHA256 seperti kode PHP lama)
    $inputPasswordHash = hash('sha256', $request->password);
    if ($inputPasswordHash !== $admin->password) {
        return back()->with('error', 'Password salah. Admin tidak dapat dihapus.');
    }

    DB::table('admin')->where('id_admin', $request->id_admin)->delete();

    return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil dihapus.');
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

        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil ditambahkan');
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
        if (!$admin) {
        return back()->with('error', 'Admin tidak ditemukan!');
    }

    $nama = $request->input('nama');
    $email = strtolower($request->input('email'));
    $currentPassword = $request->input('current_password');
    $newPassword = $request->input('password');

    // Default: hanya update nama & email
    $data = [
        'nama' => $nama,
        'email' => $email,
    ];

    if (!empty($newPassword)) {
        // Verifikasi password lama
        $hashedPasswordLama = hash('sha256', $currentPassword);
        if ($hashedPasswordLama !== $admin->password) {
            return back()->with('error', 'Password lama salah!');
        }

        // Update password juga
        $data['password'] = hash('sha256', $newPassword);
    }

    DB::table('admin')->where('id_admin', $id)->update($data);

    return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil diperbarui.');
        // $admin->save();

        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil diubah');
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil dihapus');
    }
}

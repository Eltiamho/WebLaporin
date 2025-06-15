<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Instansi;

class AdminController extends Controller
{
    public function index() {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profilAdmin()
    {
        $admins = Admin::all();
        return view('admin.profiladmin', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
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

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.ubah', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $nama = $request->input('nama');
        $email = strtolower($request->input('email'));
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('password');

        $data = [
            'nama' => $nama,
            'email' => $email,
        ];

        if (!empty($newPassword)) {
            $hashedPasswordLama = hash('sha256', $currentPassword);
            if ($hashedPasswordLama !== $admin->password) {
                return back()->with('error', 'Password lama salah!');
            }

            $data['password'] = hash('sha256', $newPassword);
        }

        DB::table('admin')->where('id_admin', $id)->update($data);

        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil dihapus');
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

        $inputPasswordHash = hash('sha256', $request->password);
        if ($inputPasswordHash !== $admin->password) {
            return back()->with('error', 'Password salah. Admin tidak dapat dihapus.');
        }

        DB::table('admin')->where('id_admin', $request->id_admin)->delete();

        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil dihapus.');
    }

    public function daftarInstansi()
    {
        $instansi = DB::table('instansi')->get();
        return view('admin.daftarinstansi', compact('instansi'));
    }
    public function tambahInstansi()
{
    return view('admin.tambahinstansi');
}

public function storeInstansi(Request $request)
{
    $request->validate([
        'nama_instansi' => 'required|string|max:255',
        'Kontak' => 'required|string|max:255',
        'status' => 'required|in:Aktif,Nonaktif',
    ]);

    DB::table('instansi')->insert([
        'nama_instansi' => $request->nama_instansi,
        'Kontak' => $request->Kontak, // huruf K BESAR sesuai DB kamu
        'status' => $request->status,
    ]);

    return redirect()->route('admin.daftarin_stansi')->with('success', 'Instansi berhasil ditambahkan.');
}


    public function editInstansi($id)
    {
        $instansi = DB::table('instansi')->where('id_instansi', $id)->first();

        if (!$instansi) {
            return redirect()->route('admin.daftarin_stansi')->with('error', 'Instansi tidak ditemukan!');
        }

        return view('admin.editinstansi', compact('instansi'));
    }

    public function ubahInstansi(Request $request)
    {
        $validated = $request->validate([
            'id_instansi' => 'required|exists:instansi,id_instansi',
            'nama_instansi' => 'required|string|max:255',
            'Kontak' => 'required|string|max:255',
        ]);

        $update = DB::table('instansi')
            ->where('id_instansi', $validated['id_instansi'])
            ->update([
                'nama_instansi' => $validated['nama_instansi'],
                'Kontak' => $validated['Kontak'], // ✅ Perhatikan huruf K besar
            ]);

        if ($update) {
            return redirect()->route('admin.daftarin_stansi')->with('success', 'Data instansi berhasil diperbarui.');
        } else {
            return back()->with('error', 'Gagal memperbarui data instansi.');
        }
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
    public function ubahStatusInstansi(Request $request)
{
    // Validasi bahwa input status adalah array (sesuai struktur form)
    if ($request->has('status') && is_array($request->status)) {
        foreach ($request->status as $id_instansi => $status) {
            DB::table('instansi')
                ->where('id_instansi', $id_instansi)
                ->update(['status' => $status]);
        }

        return redirect()->route('admin.daftarin_stansi')->with('success', 'Status instansi berhasil diperbarui.');
    }

    return redirect()->route('admin.daftarin_stansi')->with('error', 'Tidak ada perubahan status yang dikirimkan.');
}

}

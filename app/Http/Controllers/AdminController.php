<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Support\Facades\Auth;

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

        // return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil ditambahkan');
        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }
    
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

<<<<<<< Updated upstream
        // Validasi input
=======
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:admin,email,' . $id . ',id_admin',
        ]);

        if ($request->password) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->with('error', 'Password lama salah!');
            }
            $admin->password = Hash::make($request->password);
        }

        $admin->nama = $request->nama;
        $admin->email = strtolower($request->email);
        $admin->save();

        return redirect()->route('admin.index');
    }
    // public function update(Request $request, $id)
    // {
    //     $admin = Admin::findOrFail($id);

    //     $nama = $request->input('nama');
    //     $email = strtolower($request->input('email'));
    //     $currentPassword = $request->input('current_password');
    //     $newPassword = $request->input('password');

    //     $data = [
    //         'nama' => $nama,
    //         'email' => $email,
    //     ];

    //     if (!empty($newPassword)) {
    //         $hashedPasswordLama = hash('sha256', $currentPassword);
    //         if ($hashedPasswordLama !== $admin->password) {
    //             return back()->with('error', 'Password lama salah!');
    //         }

    //         $data['password'] = hash('sha256', $newPassword);
    //     }

    //     DB::table('admin')->where('id_admin', $id)->update($data);

    //     return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil diperbarui.');
    // }

    
    public function confirmDelete($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.confirm', compact('admin'));
    }
    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admin.profiladmin')->with('success', 'Admin berhasil dihapus');
    }

    public function hapusAdminDenganPassword(Request $request)
    {
>>>>>>> Stashed changes
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


    public function hapusAdminDenganPassword(Request $request)
{
    $admin = Admin::find($request->id_admin);

    if (!$admin || !Hash::check($request->password, $admin->password)) {
        return back()
            ->withInput()
            ->with('delete_error', 'Password salah.')
            ->with('delete_id', $request->id_admin)
            ->with('delete_nama', $admin ? $admin->nama : '');
    }

    $admin->delete();

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
    $instansi = Instansi::findOrFail($id);
    return view('admin.editinstansi', compact('instansi'));
}



    // public function editInstansi($id)
    // {
    //     $instansi = DB::table('instansi')->where('id_instansi', $id)->first();

    //     if (!$instansi) {
    //         return redirect()->route('admin.daftarin_stansi')->with('error', 'Instansi tidak ditemukan!');
    //     }

    //     return view('admin.editinstansi', compact('instansi'));
    // }

    public function ubahInstansi(Request $request)
{
    $request->validate([
        'id_instansi' => 'required|integer|exists:instansi,id_instansi',
        'nama_instansi' => 'required|string|max:255',
        'kontak' => 'required|string|max:255',
    ]);

    $instansi = Instansi::findOrFail($request->id_instansi);
    $instansi->nama_instansi = $request->nama_instansi;
    $instansi->Kontak = $request->kontak;
    $instansi->save();

    return redirect()->route('admin.daftarinstansi')->with('success', 'Instansi berhasil diperbarui.');
}

    // public function ubahInstansi(Request $request)
    // {
    //     $validated = $request->validate([
    //         'id_instansi' => 'required|exists:instansi,id_instansi',
    //         'nama_instansi' => 'required|string|max:255',
    //         'Kontak' => 'required|string|max:255',
    //     ]);

    //     $update = DB::table('instansi')
    //         ->where('id_instansi', $validated['id_instansi'])
    //         ->update([
    //             'nama_instansi' => $validated['nama_instansi'],
    //             'Kontak' => $validated['Kontak'], // ✅ Perhatikan huruf K besar
    //         ]);

    //     if ($update) {
    //         return redirect()->route('admin.daftarin_stansi')->with('success', 'Data instansi berhasil diperbarui.');
    //     } else {
    //         return back()->with('error', 'Gagal memperbarui data instansi.');
    //     }
    // }

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

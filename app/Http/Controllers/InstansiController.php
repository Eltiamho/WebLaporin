<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\Laporan;

class InstansiController extends Controller
{
    // Menampilkan daftar instansi
    public function index()
    {
        $instansi = Instansi::all();
        return view('admin.daftarinstansi', compact('instansi'));
    }

    // Ubah data instansi
    public function ubahInstansi(Request $request)
    {
        $request->validate([
            'id_instansi' => 'required',
            'nama_instansi' => 'required',
            'kontak' => 'required',
        ]);

        $instansi = Instansi::find($request->id_instansi);

        if ($instansi) {
            $instansi->nama_instansi = $request->nama_instansi;
            $instansi->Kontak = $request->kontak;
            $instansi->save();

            return redirect()->route('admin.daftarinstansi')->with('success', 'Data instansi berhasil diperbarui.');
        }

        return back()->with('error', 'Instansi tidak ditemukan.');
    }

    // Ubah status semua instansi
    public function prosesUbahStatusInstansi(Request $request)
    {
        foreach ($request->input('status') as $id => $status) {
            $instansi = Instansi::find($id);
            if ($instansi) {
                $instansi->status = $status;
                $instansi->save();
            }
        }

        return redirect()->route('admin.daftarinstansi')->with('success', 'Status instansi berhasil diperbarui.');
    }

    // Hapus instansi jika tidak terkait dengan laporan
    public function destroy($id)
    {
        $instansi = Instansi::find($id);

        if (!$instansi) {
            return back()->with('error', 'Instansi tidak ditemukan.');
        }

        // Cek apakah instansi digunakan di laporan
        if ($instansi->laporan()->exists()) {
            return back()->with('error', 'Instansi tidak dapat dihapus karena sedang digunakan dalam laporan.');
        }

        $instansi->delete();
        return redirect()->route('admin.daftarinstansi')->with('success', 'Instansi berhasil dihapus.');
    }
}

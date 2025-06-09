<?php
// app/Http/Controllers/LihatLaporanController.php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LihatLaporanController extends Controller
{
    public function index()
    {
        // Mengambil laporan yang terkait dengan pengguna yang sedang login
        $laporans = Laporan::where('id_user', Auth::id())
                        ->join('instansi', 'laporan.instansi', '=', 'instansi.id_instansi')
                        ->select('laporan.*', 'instansi.nama_instansi')
                        ->orderBy('laporan.tanggal', 'desc')
                        ->get();

        // Mengirim data laporan ke view
        return view('lihatlaporan', compact('laporans'));
    }
    public function destroy($id)
{
    $laporan = Laporan::findOrFail($id);
    $laporan->delete();

    return redirect()->route('lihatlaporan')->with('success', 'Laporan berhasil ditarik.');
}
}

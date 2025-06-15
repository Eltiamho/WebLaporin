<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class DonasiController extends Controller
{
    public function form($id_laporan)
    {
        $laporan = Laporan::find($id_laporan);
        $email = Auth::check() ? Auth::user()->email : '';
    
        if (!$laporan) {
            abort(404, 'Laporan tidak ditemukan.');
        }
    
        // Ambil total donasi dan daftar donatur terbaru
        $total_donasi = Donasi::where('id_laporan', $id_laporan)->sum('jumlah');
    
        $daftar_donatur = Donasi::where('id_laporan', $id_laporan)
                            ->orderByDesc('tanggal')
                            ->take(10)
                            ->get();
    
        return view('form_donasi', compact('laporan', 'email', 'total_donasi', 'daftar_donatur'));
    }
    
    

    public function proses(Request $request)
    {
        // Hilangkan titik pemisah ribuan
        $request->merge([
            'jumlah' => str_replace('.', '', $request->jumlah)
        ]);
    
        $request->validate([
            'id_laporan' => 'required|exists:laporan,id_laporan',
            'nama'       => 'nullable|string|max:255',
            'email'      => 'required|email',
            'jumlah'     => 'required|numeric|min:1000|max:5000000',
            'pesan'      => 'nullable|string|max:1000',
        ], [
            'jumlah.min' => 'Jumlah donasi minimal adalah Rp 1.000.',
            'jumlah.max' => 'Jumlah donasi maksimal adalah Rp 5.000.000.',
        ]);
        
        $nama = $request->nama ?: 'Anonymous';
        $pesan = $request->pesan ?: '-';
        Donasi::create([
            'id_laporan' => $request->id_laporan,
            'nama'       => $nama,
            'email'      => $request->email,
            'jumlah'     => $request->jumlah,
            'pesan'      => $pesan,
            'tanggal'    => now(),
        ]);
        
    
        return redirect()->route('form_donasi', ['id_laporan' => $request->id_laporan])
                         ->with('success', 'Donasi berhasil dikirim!');
    }
    public function riwayat()
{
    $email = Auth::user()->email;

    $donasi = DB::table('donasi as d')
        ->join('laporan as l', 'd.id_laporan', '=', 'l.id_laporan')
        ->select('d.nama', 'd.jumlah', 'd.pesan', 'd.tanggal', 'l.judul')
        ->where('d.email', $email)
        ->orderByDesc('d.tanggal')
        ->get();

    return view('riwayat_donasi', compact('donasi'));
}

}

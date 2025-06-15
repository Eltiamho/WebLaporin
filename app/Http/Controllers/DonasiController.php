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
        // Ambil email user yang sedang login
    $email = Auth::check() ? Auth::user()->email : '';

        if (!$laporan) {
            abort(404, 'Laporan tidak ditemukan.');
        }

        // $email = session('username'); // atau auth()->user()->email jika pakai Laravel Auth

        return view('form_donasi', compact('laporan', 'email'));
    }
    

    public function proses(Request $request)
    {
        $request->validate([
            'id_laporan' => 'required|exists:laporan,id_laporan',
            'nama'       => 'required|string|max:255',
            'email'      => 'required|email',
            'jumlah'     => 'required|numeric|min:1000',
            'pesan'      => 'nullable|string|max:1000',
        ]);

        Donasi::create($request->all());

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

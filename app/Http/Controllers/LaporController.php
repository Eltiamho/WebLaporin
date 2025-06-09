<?php
// app/Http/Controllers/LaporController.php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporController extends Controller
{
    // Menampilkan form Lapor (Halaman utama)
    public function index()
    {
        // Mengambil instansi yang aktif
        $instansi = Instansi::where('status', 'Aktif')->get();

        return view('lapor', compact('instansi'));
    }

    // Menyimpan laporan
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'instansi' => 'required|exists:instansi,id_instansi',
            'kategori' => 'required|string',
            'privasi' => 'nullable|string|in:Publik,Anonim',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Menyimpan data laporan
        $laporan = new Laporan();
        $laporan->id_user = Auth::id(); // Menggunakan Auth untuk mendapatkan ID pengguna
        $laporan->judul = $request->judul;
        $laporan->isi = $request->isi;
        $laporan->tanggal = $request->tanggal;
        $laporan->lokasi = $request->lokasi;
        $laporan->instansi = $request->instansi;
        $laporan->kategori = $request->kategori;
        $laporan->privasi = $request->privasi ?? 'Publik'; // Defaultnya 'Publik'

        // Proses upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('laporan_files', 'public');
            $laporan->lampiran = $lampiranPath;
        }

        // Status default adalah 'Pending'
        $laporan->status = 'Pending';
        $laporan->save();

        return redirect()->route('lapor')->with('success', 'Laporan berhasil disampaikan!');
    }
}


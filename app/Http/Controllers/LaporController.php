<?php
// app/Http/Controllers/LaporController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use Illuminate\Support\Facades\Response;

use App\Models\Instansi;


class LaporController extends Controller
{
    public function store(Request $request)
    {
         \Illuminate\Support\Facades\Log::info('Masuk ke method store laporan');
        // Validasi form input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
            'privasi' => 'nullable|in:Publik,Privat'
        ]);

        // Ambil user ID dari session
        $id_user = Session::get('id_user');

        if (!$id_user) {
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        // Simpan file lampiran jika ada
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
        }

        // Simpan ke database
        Laporan::create([
            'id_user' => $id_user,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'instansi' => $request->instansi,
            'kategori' => $request->kategori,
            'lampiran' => $lampiranPath,
            'privasi' => $request->privasi ?? 'Publik',
            'status' => 'Pending',
        ]);

        return redirect()->route('lapor')->with('success', 'Laporan berhasil dikirim.');
    }
    public function lihatLampiran($id)
{
    // Ambil lampiran (tipe BLOB) dari database
    $lampiran = DB::table('laporan')
        ->where('id_laporan', $id)
        ->value('lampiran');

    if (!$lampiran) {
        return response('Lampiran tidak ditemukan.', 404);
    }

    // Deteksi MIME type (misalnya jpg, png, pdf, dll)
    // Kamu bisa sesuaikan atau tetapkan default
    $finfo = finfo_open();
    $mimeType = finfo_buffer($finfo, $lampiran, FILEINFO_MIME_TYPE);
    finfo_close($finfo);

    return Response::make($lampiran, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline', // atau 'attachment' jika ingin force download
    ]);
}

    public function index(Request $request)
{
    $kategori = $request->query('kategori');
    $instansi = $request->query('instansi');

    $lapor = DB::table('laporan')
        ->leftJoin('user', 'laporan.id_user', '=', 'user.id_user')
        ->leftJoin('instansi', 'laporan.instansi', '=', 'instansi.id_instansi')
        ->select('laporan.*', 'user.username', 'instansi.nama_instansi');

    if (!empty($kategori)) {
        $lapor->where('laporan.kategori', $kategori);
    }

    if (!empty($instansi)) {
        $lapor->where('instansi.nama_instansi', $instansi);
    }

    $lapor = $lapor->orderBy('laporan.id_laporan', 'desc')->get();

    return view('lapor', ['lapor' => $lapor]);
}
}



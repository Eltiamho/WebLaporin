<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Instansi;
// use App\Models\Laporan;
// use Illuminate\Support\Facades\Session;

// class HomeController extends Controller
// {
//     public function index()
//     {
//         $instansis = Instansi::where('status', 'Aktif')->get();
//         $username = Session::get('username'); // jika pakai session sendiri

//         return view('home', compact('instansis', 'username'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'judul' => 'required|string',
//             'isi' => 'required|string',
//             'tanggal' => 'required|date',
//             'lokasi' => 'required|string',
//             'instansi' => 'required|integer',
//             'kategori' => 'required|string',
//             'privasi' => 'required|in:Anonim,Publik',
//             'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
//         ]);

//         $path = $request->file('lampiran')?->store('lampiran', 'public');

//         Laporan::create([
//             'id_user' => Session::get('id_user') ?? 1, // sesuaikan dengan loginmu
//             'judul' => $request->judul,
//             'isi' => $request->isi,
//             'tanggal' => $request->tanggal,
//             'lokasi' => $request->lokasi,
//             'instansi' => $request->instansi,
//             'kategori' => $request->kategori,
//             'privasi' => $request->privasi,
//             'status' => 'Menunggu',
//             'lampiran' => $path,
//         ]);

//         return redirect()->route('home')->with('success', 'Laporan berhasil dikirim!');
//     }
// }
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua instansi yang statusnya 'Aktif'
        $data_instansi = Instansi::where('status', 'Aktif')->get();

        // Mengirim data instansi ke view
        return view('home', compact('data_instansi'));
    }
}


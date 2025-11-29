<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\Laporan;

class InstansiController extends Controller
{
    // API LOGIN DUMMY
    public function login(Request $request)
    {
        // 1. Cek Password Dummy (Hardcode aja sesuai requestmu)
        if ($request->password !== 'admin123') { // Ganti 'admin123' sesuai maumu
            return response()->json([
                'status' => false,
                'message' => 'Password Salah!'
            ], 401);
        }

        // 2. Cari Instansi berdasarkan Nama
        $instansi = Instansi::where('nama_instansi', $request->nama_instansi)->first();

        if ($instansi) {
            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'data' => $instansi // Kita butuh ID_INSTANSI dari sini
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Instansi Tidak Ditemukan'
            ], 404);
        }
    }

    // API AMBIL LAPORAN KHUSUS INSTANSI TERTENTU
    public function getLaporanByInstansi($id_instansi)
    {
        // Filter laporan dimana kolom 'instansi' == id yang login
        $laporans = Laporan::where('instansi', $id_instansi)->get();

        return response()->json([
            'status' => true,
            'data' => $laporans
        ], 200);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
   
    public function index()
    {
        // Mengambil semua data laporan
        $laporans = Laporan::all();

        return response()->json([
            'status' => true,
            'message' => 'Daftar Laporan Berhasil Diambil',
            'data' => $laporans
        ], 200);
    }

   
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'id_user'   => 'required|integer', // Harus ada id_user
            'judul'     => 'required|string',
            'isi'       => 'required|string',
            'lokasi'    => 'required|string',
            'instansi'  => 'required|integer', // Sesuai model kamu
            'kategori'  => 'required|string',
            'privasi'   => 'required|in:Publik,Privat,Anonim', // Sesuaikan opsi enum jika ada
            'status'    => 'required|string',
            // 'lampiran' kita skip dulu agar simpel, nanti bisa ditambahkan
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        // 2. Simpan ke Database
        $laporan = Laporan::create([
            'id_user'   => $request->id_user,
            'judul'     => $request->judul,
            'isi'       => $request->isi,
            'tanggal'   => now(), // Isi tanggal otomatis sekarang
            'lokasi'    => $request->lokasi,
            'instansi'  => $request->instansi,
            'kategori'  => $request->kategori,
            'privasi'   => $request->privasi,
            'status'    => $request->status,
        ]);

        // 3. Kembalikan Respon JSON
        if ($laporan) {
            return response()->json([
                'status' => true,
                'message' => 'Laporan Berhasil Ditambahkan',
                'data' => $laporan
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Laporan'
            ], 500);
        }
    }

    
    public function show($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            return response()->json([
                'status' => true,
                'message' => 'Detail Laporan Ditemukan',
                'data' => $laporan
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Laporan Tidak Ditemukan',
            ], 404);
        }
    }

    
    public function update(Request $request, $id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json(['status' => false, 'message' => 'Laporan Tidak Ditemukan'], 404);
        }

        // Validasi input (opsional, bisa dibuat nullable)
        $validator = Validator::make($request->all(), [
            'judul'     => 'string',
            'isi'       => 'string',
            'status'    => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }

        // Update data
        $laporan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Laporan Berhasil Diupdate',
            'data' => $laporan
        ], 200);
    }

    
    public function destroy($id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json(['status' => false, 'message' => 'Laporan Tidak Ditemukan'], 404);
        }

        $laporan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Laporan Berhasil Dihapus'
        ], 200);
    }
}
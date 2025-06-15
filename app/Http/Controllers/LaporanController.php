<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');
        $instansi = $request->query('instansi');

        $laporan = DB::table('laporan')
            ->leftJoin('user', 'laporan.id_user', '=', 'user.id_user')
            ->leftJoin('instansi', 'laporan.instansi', '=', 'instansi.id_instansi')
            ->select('laporan.*', 'user.username', 'instansi.nama_instansi')
            ->when($kategori, function ($query, $kategori) {
                return $query->where('laporan.kategori', $kategori);
            })
            ->when($instansi, function ($query, $instansi) {
                return $query->where('instansi.nama_instansi', $instansi);
            })
            ->orderByDesc('laporan.id_laporan')
            ->get();

        return view('laporan', compact('laporan'));
    }
     public function ubahStatus(Request $request)
    {
        if ($request->has('status')) {
            foreach ($request->status as $id_laporan => $status) {
                DB::table('laporan')
                    ->where('id_laporan', $id_laporan)
                    ->update(['status' => $status]);
            }

            return redirect()->route('admin.daftarlaporin')->with('status', 'success');
        } else {
            return redirect()->route('admin.daftarlaporin')->with('status', 'error');
        }
    }
}


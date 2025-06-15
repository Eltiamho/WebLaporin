<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil laporan 3 bulan terakhir dan format bulan
        $laporan = DB::table('laporan')
            ->selectRaw("MONTH(tanggal) AS bulan_angka, DATE_FORMAT(tanggal, '%M') AS bulan, COUNT(*) AS jumlah")
            ->where('tanggal', '>=', now()->subMonths(3))
            ->groupBy(DB::raw('MONTH(tanggal), DATE_FORMAT(tanggal, "%M")'))
            ->orderBy(DB::raw('MONTH(tanggal)'))
            ->get();

        // Pisahkan label dan data untuk Chart.js
        $labels = $laporan->pluck('bulan');
        $data = $laporan->pluck('jumlah');

        return view('about', compact('labels', 'data'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller
{
    public function destroy($id)
{
    $instansi = Instansi::find($id);

    if ($instansi) {
        $instansi->delete();
        return redirect()->route('admin.daftarinstansi')->with('success', 'Data berhasil dihapus');
    } else {
        return back()->with('error', 'Instansi tidak ditemukan');
    }
}
}

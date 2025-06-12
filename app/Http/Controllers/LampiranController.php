<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Laporan;

class LampiranController extends Controller
{
    public function view($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!$laporan->lampiran || !Storage::exists('lampiran/' . $laporan->lampiran)) {
            abort(404);
        }

        $file = Storage::get('lampiran/' . $laporan->lampiran);
        $mime = Storage::mimeType('lampiran/' . $laporan->lampiran);

        return Response::make($file, 200)->header("Content-Type", $mime);
    }
}


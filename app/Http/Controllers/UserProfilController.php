<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProfilController extends Controller
{
    public function edit()
    {
        $user = DB::table('user')->where('id_user', Auth::id())->first();
        return view('user.ubahprofil', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no' => 'required|string|max:15',
            'email' => 'required|email|max:255'
        ]);

        DB::table('user')->where('id_user', Auth::id())->update([
            'username' => $request->nama,
            'alamat' => $request->tempat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no,
            'email' => $request->email,
        ]);

        return redirect()->route('user.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}



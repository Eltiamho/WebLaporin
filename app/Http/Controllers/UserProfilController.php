<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


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
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6',
            'password_konfirmasi' => 'required|same:password_baru',
        ], [
            'password_lama.required' => 'Password lama harus diisi.',
            'password_baru.required' => 'Password baru harus diisi.',
            'password_baru.min' => 'Password baru minimal harus terdiri dari 6 karakter.',
            'password_konfirmasi.required' => 'Konfirmasi password harus diisi.',
            'password_konfirmasi.same' => 'Password baru dan konfirmasi password tidak cocok.',
        ]);
        

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah.']);
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }

}



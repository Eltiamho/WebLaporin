<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function showRegisterForm()
{
    return view('auth.register'); // pastikan view ini ada di resources/views/auth/register.blade.php
}

    public function register(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:50',
        'tempat' => 'required|string|max:50',
        'kelamin' => 'required|in:Laki-laki,Perempuan',
        'no' => 'required|string|max:12|unique:user,no_telp',
        'email' => 'required|email|max:50|unique:user,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    try {
        $user = new User();
        $user->username = $request->nama;
        $user->alamat = $request->tempat;
        $user->jenis_kelamin = $request->kelamin;
        $user->no_telp = $request->no;
        $user->email = $request->email;
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->status_user = 'Aktif'; // default status

        $user->save();

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil.');
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Registrasi gagal: ' . $e->getMessage());
        return back()->withErrors(['register' => 'Registrasi gagal, silakan coba lagi.']);
    }
}

}

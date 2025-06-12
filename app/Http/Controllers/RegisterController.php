<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    public function showRegisterForm()
{
    return view('auth.register'); // pastikan view ini ada di resources/views/auth/register.blade.php
}

    public function register(Request $request)
{
    \Illuminate\Support\Facades\Log::info('Register dipanggil');
    $request->validate([
    'nama' => 'required|string|max:50',
    'tempat' => 'required|string|max:50',
    'kelamin' => 'required|in:Laki-laki,Perempuan',
    'no' => [
        'required',
        'string',
        'max:12',
        Rule::unique('user', 'no_telp'),
    ],
    'email' => [
        'required',
        'email',
        'max:50',
        Rule::unique('user', 'email'),
    ],
    'password' => 'required|string|min:6|confirmed',
]);
// dd($request->all());

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
        if ($user->save()) {
    Log::info('Registrasi berhasil disimpan untuk user: ' . $user->email);
    Auth::login($user);
    return redirect()->route('home')->with('success', 'Registrasi berhasil.');
} else {
    Log::error('Registrasi gagal saat menyimpan user.');
    return back()->withErrors(['register' => 'Registrasi gagal, silakan coba lagi.']);
}
        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil.');
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Registrasi gagal: ' . $e->getMessage());
        return back()->withErrors(['register' => 'Registrasi gagal, silakan coba lagi.']);
    }
}

}

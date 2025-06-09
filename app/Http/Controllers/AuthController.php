<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Jika user ditemukan dan password sesuai
        if ($user && Hash::check($request->password, $user->password)) {
            session(['id_user' => $user->id_user, 'is_login' => true, 'email' => $user->email, 'username' => $user->username]);
            return redirect()->route('home');
        }

        // Jika login gagal
        return back()->withErrors(['login' => 'Email atau Password salah.']);
    }

    // Menampilkan halaman registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:user,email',
        'password' => 'required|string|min:8|confirmed',
        'no_telp' => 'required|string|max:20',
        'jenis_kelamin' => 'required|in:L,P',
        'alamat' => 'required|string',
        'status_user' => 'required|string' // misalnya: admin/user
    ]);

    // Mendaftar user baru
    $user = new User();
    $user->username = $request->nama;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->no_telp = $request->no_telp;
    $user->jenis_kelamin = $request->jenis_kelamin;
    $user->alamat = $request->alamat;
    $user->status_user = $request->status_user;
    $user->save();

    
    Auth::login($user);
    

    return redirect()->route('home')->with('success', 'Registrasi berhasil.');
}


    public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:user,email',
        'pass_new' => 'required|string|min:8',
        'pass_conf' => 'required|same:pass_new',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user) {
        $user->password = Hash::make($request->pass_new);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silakan login kembali.');
    } else {
        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }
}
    // Logout
    public function logout()
    {
        Session::flush(); // Menghapus semua session
        Auth::logout(); // Logout Laravel
        return redirect()->route('login');
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek sebagai user
        $user = User::where('email', strtolower($request->email))->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Auth Laravel
            session()->put('id_user', $user->id_user);
            session()->put('nama', $user->nama);
            session()->put('email', $user->email);
            session()->put('role', 'user');

            return redirect()->route('home');
        }

        // Cek sebagai admin
        $admin = Admin::where('email', strtolower($request->email))->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
        Auth::guard('admin')->login($admin); // pakai guard 'admin'
        return redirect()->route('admin.dashboard');
        // return redirect()->route('dashboard');
        // return redirect()->route('admin.dashboard');
    }
        // if ($admin && Hash::check($request->password, $admin->password)) {
        //     session()->put('id_admin', $admin->id_admin);
        //     session()->put('nama', $admin->nama);
        //     session()->put('email', $admin->email);
        //     session()->put('role', 'admin');

        //     return redirect()->route('admin.dashboard');
        // }

        return back()->withErrors(['login' => 'Email atau Password salah.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

    // public function logout()
    // {
    //     Session::flush();
    //     Auth::logout();
    //     return redirect()->route('login');
    // }
}

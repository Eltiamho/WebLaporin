<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

        $user = User::where('email', $request->email)->first();

       if ($user && Hash::check($request->password, $user->password)) {
    session([
        'id_user' => $user->id_user,
        'is_login' => true,
        'email' => $user->email,
        'username' => $user->username
    ]);
    return redirect()->route('home');
}

        return back()->withErrors(['login' => 'Email atau Password salah.']);
    }
}

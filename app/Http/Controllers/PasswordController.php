<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user,email',
            'pass_new' => 'required|string|min:8',
            'pass_conf' => 'required|same:pass_new',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->pass_new);
            $user->save();

            return redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silakan login kembali.');
        }

        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }
}

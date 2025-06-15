<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LupaPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pass_new' => 'required|min:6',
            'pass_conf' => 'required|same:pass_new'
        ]);

        $user = DB::table('user')->where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }

        $hashedPassword = Hash::make($request->pass_new);

        DB::table('user')->where('email', $request->email)->update(['password' => $hashedPassword]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui, silakan login kembali!');
    }
}



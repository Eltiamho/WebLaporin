<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LupaPasswordController extends Controller
{
    // Step 1: Form input email
    public function showEmailForm()
{
    return view('email'); // atau 'email' sesuai lokasi file blade kamu
}

    // Step 2: Simulasi kirim kode verifikasi (tidak kirim email sungguhan)
    public function sendVerification(Request $request)
{
    // Validasi email format
    $request->validate([
        'email' => 'required|email',
    ]);

    // Cek apakah email ada di database
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Email tidak terdaftar.');
    }

    // Simulasi kode verifikasi (tanpa email asli)
    $verificationCode = rand(100000, 999999);

    // Simpan email dan kode ke session
    session([
        'reset_email' => $request->email,
        'reset_code' => $verificationCode,
    ]);

    // Redirect ke halaman verifikasi kode
    return redirect()->route('verifyform')->with('success', 'Kode verifikasi telah dikirim!');
}

    // Step 3: Tampilkan form verifikasi kode
    public function showVerifyForm()
    {
        if (!Session::has('reset_email')) {
            return redirect()->route('lupapassword.form')
                ->with('error', 'Silakan masukkan email terlebih dahulu.');
        }

        return view('verify');
    }

    // Step 4: Cek kode verifikasi
    public function verifyCode(Request $request)
    {
        return redirect()->route('lupapassword.resetform');
    }
    


    // Step 5: Tampilkan form reset password
    public function showResetForm()
{
    // Tambahkan log untuk melihat isi session
    \Log::info('Session data:', [
        'verified' => Session::get('verified'),
        'reset_email' => Session::get('reset_email'),
        'reset_code' => Session::get('reset_code'),
    ]);

    return view('reset');
}


    // Step 6: Simpan password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
    
        $email = Session::get('reset_email');
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return redirect()->route('lupapassword.form')
                ->with('error', 'Pengguna tidak ditemukan.');
        }
    
        // Cek apakah password baru sama dengan yang lama
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password baru tidak boleh sama dengan password lama.'
            ]);
        }
    
        // Simpan password baru
        $user->password = Hash::make($request->password);
        $user->save();
    
        // Hapus session reset
        Session::forget(['reset_email', 'reset_code', 'verified']);
    
        return redirect()->route('login')->with('success', 'Password berhasil direset.');
    }
    
}


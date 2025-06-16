<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporController;
use App\Http\Controllers\LihatLaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserProfilController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\LupaPasswordController;


/*
|--------------------------------------------------------------------------
| Halaman Utama dan Informasi
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

/*
|--------------------------------------------------------------------------
| Autentikasi User
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    Session::flush();
    return redirect('/login');
})->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::post('/password-update', [PasswordController::class, 'update'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Donasi
|--------------------------------------------------------------------------
*/
Route::get('/form_donasi/{id_laporan}', [DonasiController::class, 'form'])->name('form_donasi');
Route::post('/proses_donasi', [DonasiController::class, 'proses'])->name('proses_donasi');
Route::get('/riwayat_donasi', [DonasiController::class, 'riwayat'])->middleware('auth')->name('riwayat_donasi');

/*
|--------------------------------------------------------------------------
| Lampiran
|--------------------------------------------------------------------------
*/
Route::get('/lampiran/{id}', [LampiranController::class, 'view'])->name('lampiran.view');
Route::get('/lampiran/{id}', [LaporController::class, 'lihatLampiran'])->name('lampiran.lihat');

/*
|--------------------------------------------------------------------------
| User Profil (Hanya untuk user yang login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/ubahprofil', [UserProfilController::class, 'edit'])->name('user.edit');
    Route::post('/ubahprofil', [UserProfilController::class, 'update'])->name('user.update');
    Route::post('/user/update-password', [UserProfilController::class, 'updatePassword'])->name('user.updatePassword');

    
   

});
Route::get('/lupapassword', [LupaPasswordController::class, 'showEmailForm'])->name('lupapassword.form');
Route::post('/lupapassword/send', [LupaPasswordController::class, 'sendVerification'])->name('lupapassword.verify.send');
Route::get('/lupapassword/verify', [LupaPasswordController::class, 'showVerifyForm'])->name('verifyform');
Route::post('/lupapassword/verify', [LupaPasswordController::class, 'verifyCode'])->name('lupapassword.verifycode');
Route::get('/lupapassword/reset', [LupaPasswordController::class, 'showResetForm'])->name('lupapassword.resetform');
Route::post('/lupapassword/reset', [LupaPasswordController::class, 'resetPassword'])->name('lupapassword.reset');

/*
|--------------------------------------------------------------------------
| Pelaporan (Hanya untuk user yang login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/lapor', [LaporController::class, 'index'])->name('lapor');
    Route::post('/lapor/store', [LaporController::class, 'store'])->name('lapor.store');
    Route::get('/lihatlaporan', [LihatLaporanController::class, 'index'])->name('lihatlaporan');
    Route::delete('/laporan/{id}', [LihatLaporanController::class, 'destroy'])->name('lapor.delete');
    Route::delete('/lihatlaporan/{id}', [LihatLaporanController::class, 'destroy'])->name('lapor.delete');
});

/*
|--------------------------------------------------------------------------
| Admin Panel (Hanya untuk admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['is_admin'])->group(function () {
    // Dashboard & Profil
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profiladmin', [AdminController::class, 'profilAdmin'])->name('admin.profiladmin');
    Route::get('/admin/profil-user', [AdminController::class, 'profilUser'])->name('admin.profiluser');
    Route::post('/admin/ubah-status-user', [AdminController::class, 'ubahStatusUser'])->name('admin.ubahstatususer');

    // Manajemen Admin
    Route::get('/admin/tambah', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/tambah', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/admin/proses-hapus-admin', [AdminController::class, 'hapusAdminDenganPassword'])->name('admin.hapusAdminDenganPassword');
    Route::post('/hapus-dengan-password', [AdminController::class, 'hapusAdminDenganPassword'])->name('hapusAdminDenganPassword');

    // Instansi
    Route::get('/admin/daftarlaporin', [AdminController::class, 'daftarLaporin'])->name('admin.daftarlaporin');
    Route::get('/admin/daftarinstansi', [AdminController::class, 'daftarInstansi'])->name('admin.daftarinstansi');
    Route::get('/admin/daftar-instansi', [AdminController::class, 'daftarInstansi'])->name('admin.daftarin_stansi');
    Route::get('/admin/edit-instansi/{id}', [AdminController::class, 'editInstansi'])->name('admin.editinstansi');
    Route::post('/admin/ubah-instansi', [AdminController::class, 'ubahInstansi'])->name('admin.ubahinstansi');
    Route::post('/admin/prosesubahstatusinstansi', [AdminController::class, 'ubahStatusInstansi'])->name('admin.ubahstatusinstansi');
    Route::get('/admin/tambahinstansi', [AdminController::class, 'tambahInstansi'])->name('admin.tambahinstansi');
    Route::post('/admin/tambahinstansi', [AdminController::class, 'storeInstansi'])->name('admin.storeinstansi');
    Route::delete('/instansi/{id}', [InstansiController::class, 'destroy'])->name('instansi.hapus');


    // Status Laporan
    Route::post('/admin/ubahstatuslaporan', [LaporController::class, 'ubahStatus'])->name('admin.ubahstatuslaporan');

});

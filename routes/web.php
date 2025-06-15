<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\{
    HomeController,
    LaporController,
    LihatLaporanController,
    AuthController,
    LaporanController,
    RegisterController,
    LoginController,
    LogoutController,
    PasswordController,
    LampiranController,
    AdminController
};

// ------------------------------
// GUEST ROUTES
// ------------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// ------------------------------
// LOGOUT (BISA PILIH SALAH SATU CARA SAJA)
// ------------------------------
Route::get('/logout', function () {
    Session::flush(); // Hapus session login
    auth()->logout(); // Logout dari auth Laravel (jika login)
    return redirect('/login')->with('success', 'Anda telah logout.');
})->name('logout');
// ------------------------------
// PASSWORD
// ------------------------------
Route::post('/password-update', [PasswordController::class, 'update'])->name('password.update');

// ------------------------------
// HOME & DASHBOARD
// ------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// ------------------------------
// AUTH ROUTES
// ------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/lapor', [LaporController::class, 'index'])->name('lapor');
    Route::post('/lapor/store', [LaporController::class, 'store'])->name('lapor.store');
    Route::get('/lihatlaporan', [LihatLaporanController::class, 'index'])->name('lihatlaporan');
    Route::delete('/laporan/{id}', [LihatLaporanController::class, 'destroy'])->name('lapor.delete');
    Route::post('/admin/ubah-status-laporan', [LaporanController::class, 'ubahStatus'])->name('admin.ubahstatuslaporan');
});

// ------------------------------
// LAMPIRAN
// ------------------------------
Route::get('/lampiran/{id}', [LampiranController::class, 'view'])->name('lampiran.view');
Route::get('/lampiran/{id}', [LaporController::class, 'lihatLampiran'])->name('lampiran.lihat');

// ------------------------------
// ADMIN ROUTES
// ------------------------------
Route::middleware(['is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profiladmin', [AdminController::class, 'profilAdmin'])->name('profiladmin');
    Route::get('/profil-user', [AdminController::class, 'profilUser'])->name('profiluser');
    Route::post('/ubah-status-user', [AdminController::class, 'ubahStatusUser'])->name('ubahstatususer');
    Route::post('/proses-hapus-admin', [AdminController::class, 'hapusAdminDenganPassword'])->name('hapusadmin.post');
    Route::get('/daftarlaporin', [AdminController::class, 'daftarLaporin'])->name('daftarlaporin');
    Route::get('/daftarinstansi', [AdminController::class, 'daftarInstansi'])->name('daftarinstansi');
    Route::post('/hapus-dengan-password', [AdminController::class, 'hapusAdminDenganPassword'])->name('hapusAdminDenganPassword');
        // Admin CRUD
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('destroy');
    

});

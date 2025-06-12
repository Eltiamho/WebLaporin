<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporController;
use App\Http\Controllers\LihatLaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\LampiranController;

Route::get('/lampiran/{id}', [LampiranController::class, 'view'])->name('lampiran.view');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/proseslogout', [AuthController::class, 'logout']);

Route::post('/password-update', [PasswordController::class, 'update'])->name('password.update');


// Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');


// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/password-update', [AuthController::class, 'updatePassword'])->name('password.update');

Route::get('/lampiran/{id}', [\App\Http\Controllers\LaporController::class, 'lihatLampiran'])->name('lampiran.lihat');

Route::get('/lihatlaporan', [LihatLaporanController::class, 'index'])->name('lihatlaporan');
Route::delete('/lihatlaporan/{id}', [LihatLaporanController::class, 'destroy'])->name('lapor.delete');

Route::get('/lapor', [LaporController::class, 'index'])->name('lapor');
Route::post('/lapor/store', [LaporController::class, 'store'])->name('lapor.store');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', function () {
//     return view('home');
// });

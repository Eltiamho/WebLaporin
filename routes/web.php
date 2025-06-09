<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporController;
use App\Http\Controllers\LihatLaporanController;

Route::get('/lihatlaporan', [LihatLaporanController::class, 'index'])->name('lihatlaporan');
Route::delete('/lapor/{id}', [LihatLaporanController::class, 'destroy'])->name('lapor.delete');

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

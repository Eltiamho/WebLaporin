<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LaporanController; // Pastikan ini mengarah ke Controller yang kita buat
use App\Http\Controllers\Api\InstansiController;

// Route API Laporan
// Di Laravel 11, semua route di file ini otomatis ada awalan '/api'
Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/laporan/{id}', [LaporanController::class, 'show']);  
Route::post('/laporan', [LaporanController::class, 'store']);     
Route::put('/laporan/{id}', [LaporanController::class, 'update']); 
Route::delete('/laporan/{id}', [LaporanController::class, 'destroy']); 
Route::post('/instansi/login', [InstansiController::class, 'login']);
Route::get('/instansi/{id}/laporan', [InstansiController::class, 'getLaporanByInstansi']);

// Route User (Bawaan Laravel 11, biarkan saja kalau ada)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
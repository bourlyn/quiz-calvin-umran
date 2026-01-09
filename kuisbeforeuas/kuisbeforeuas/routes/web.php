<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KontrakSewaController;
use App\Http\Controllers\PembayaranController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('kamar', KamarController::class);
Route::resource('penyewa', PenyewaController::class);
Route::resource('kontrak-sewa', KontrakSewaController::class);
Route::resource('pembayaran', PembayaranController::class);

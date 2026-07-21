<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect Halaman Utama ke Login / Dashboard
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Authentication (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route dengan Proteksi Login (Auth)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Transaksi Penyewaan
    Route::patch('/penyewaan/{penyewaan}/status', [PenyewaanController::class, 'updateStatus'])->name('penyewaan.updateStatus');
    Route::resource('penyewaan', PenyewaanController::class);

    // Route Khusus Role Administrator & Staff
    Route::middleware('role:Administrator,Staff')->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('anggota', AnggotaController::class);

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });
});

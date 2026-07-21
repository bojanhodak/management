<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Penyewaan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalPelanggan = Pelanggan::count();
        $totalPenyewaan = Penyewaan::count();
        $transaksiAktif = Penyewaan::where('status', 'Disewa')->count();

        return view('dashboard', compact('totalBarang', 'totalPelanggan', 'totalPenyewaan', 'transaksiAktif'));
    }
}

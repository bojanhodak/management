<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $penyewaans = Penyewaan::with(['pelanggan', 'barang'])
            ->when($request->tgl_mulai && $request->tgl_selesai, function ($query) use ($request) {
                $query->whereBetween('tgl_sewa', [$request->tgl_mulai, $request->tgl_selesai]);
            })
            ->latest()
            ->get();

        $totalPendapatan = $penyewaans->whereIn('status', ['Disewa', 'Dikembalikan', 'Selesai'])->sum('total_harga');

        return view('laporan.index', compact('penyewaans', 'totalPendapatan'));
    }
}

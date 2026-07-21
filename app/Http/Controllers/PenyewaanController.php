<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Pelanggan;
use App\Models\Barang;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penyewaan::with(['pelanggan', 'barang'])->latest();

        // Filter Search (Kode Transaksi atau Nama Pelanggan)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_transaksi', 'like', "%{$search}%")
                ->orWhereHas('pelanggan', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $penyewaans = $query->paginate(10)->withQueryString();

        return view('penyewaan.index', compact('penyewaans'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::where('stok', '>', 0)->get();

        return view('penyewaan.create', compact('pelanggan', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:penyewaans,kode_transaksi',
            'pelanggan_id'   => 'required|exists:pelanggans,id',
            'barang_id'      => 'required|exists:barangs,id',
            'jumlah'         => 'required|integer|min:1',
            'tgl_sewa'       => 'required|date',
            'tgl_kembali'    => 'required|date|after_or_equal:tgl_sewa',
            'total_harga'    => 'required|numeric',
        ]);

        Penyewaan::create([
            'kode_transaksi' => $request->kode_transaksi,
            'pelanggan_id'   => $request->pelanggan_id,
            'barang_id'      => $request->barang_id,
            'jumlah'         => $request->jumlah,
            'tgl_sewa'       => $request->tgl_sewa,
            'tgl_kembali'    => $request->tgl_kembali,
            'status'         => 'Diproses',
            'total_harga'    => $request->total_harga,
        ]);

        return redirect()->route('penyewaan.index')->with('success', 'Transaksi penyewaan berhasil ditambahkan!');
    }

    public function edit(Penyewaan $penyewaan)
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();

        return view('penyewaan.edit', compact('penyewaan', 'pelanggan', 'barang'));
    }

    public function update(Request $request, Penyewaan $penyewaan)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'barang_id'    => 'required|exists:barangs,id',
            'jumlah'       => 'required|integer|min:1',
            'tgl_sewa'     => 'required|date',
            'tgl_kembali'  => 'required|date|after_or_equal:tgl_sewa',
            'status'       => 'required|in:Diproses,Disewa,Dikembalikan,Selesai',
            'total_harga'  => 'required|numeric',
        ]);

        $statusLama = $penyewaan->status;
        $statusBaru = $request->status;
        $barang = Barang::findOrFail($request->barang_id);

        // Penyesuaian stok otomatis saat update via Form Edit
        if ($statusLama != 'Disewa' && $statusBaru == 'Disewa') {
            if ($barang->stok < $request->jumlah) {
                return back()->withErrors(['jumlah' => 'Stok barang tidak mencukupi untuk disewa.']);
            }
            $barang->decrement('stok', $request->jumlah);
        } elseif ($statusLama == 'Disewa' && in_array($statusBaru, ['Dikembalikan', 'Selesai'])) {
            $barang->increment('stok', $penyewaan->jumlah);
        }

        $penyewaan->update([
            'pelanggan_id' => $request->pelanggan_id,
            'barang_id'    => $request->barang_id,
            'jumlah'       => $request->jumlah,
            'tgl_sewa'     => $request->tgl_sewa,
            'tgl_kembali'  => $request->tgl_kembali,
            'status'       => $request->status,
            'total_harga'  => $request->total_harga,
        ]);

        return redirect()->route('penyewaan.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function updateStatus(Request $request, Penyewaan $penyewaan)
    {
        $request->validate([
            'status' => 'required|in:Diproses,Disewa,Dikembalikan,Selesai',
        ]);

        $statusLama = $penyewaan->status;
        $statusBaru = $request->status;
        $barang = $penyewaan->barang;

        // Logika Pengurangan / Penambahan Stok Otomatis
        if ($statusLama != 'Disewa' && $statusBaru == 'Disewa') {
            if ($barang->stok < $penyewaan->jumlah) {
                return back()->with('error', 'Stok barang tidak mencukupi!');
            }
            $barang->decrement('stok', $penyewaan->jumlah);
        } elseif ($statusLama == 'Disewa' && in_array($statusBaru, ['Dikembalikan', 'Selesai'])) {
            $barang->increment('stok', $penyewaan->jumlah);
        }

        $penyewaan->update(['status' => $statusBaru]);

        return redirect()->route('penyewaan.index')->with('success', 'Status transaksi berhasil diperbarui!');
    }

    public function destroy(Penyewaan $penyewaan)
    {
        // Jika status transaksi masih 'Disewa' saat dihapus, kembalikan stoknya
        if ($penyewaan->status == 'Disewa') {
            $penyewaan->barang->increment('stok', $penyewaan->jumlah);
        }

        $penyewaan->delete();

        return redirect()->route('penyewaan.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}

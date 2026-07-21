<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Tampilkan daftar supplier.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Tampilkan form untuk menambah supplier baru.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Simpan supplier baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'telepon'       => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
        ]);

        // Menggunakan data hasil validasi saja (otomatis membuang _token)
        Supplier::create($validated);

        return redirect()->route('supplier.index')
            ->with('success', 'Data supplier berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit supplier.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Perbarui data supplier di database.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'telepon'       => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
        ]);

        // Memperbarui data menggunakan data tervalidasi
        $supplier->update($validated);

        return redirect()->route('supplier.index')
            ->with('success', 'Data supplier berhasil diperbarui!');
    }

    /**
     * Hapus data supplier.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Data supplier berhasil dihapus!');
    }
}

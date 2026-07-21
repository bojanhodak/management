<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.index');
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        // Create a new Barang record
        \App\Models\Barang::create($validatedData);

        return redirect()->route('barang.index')->with('success', 'Barang created successfully.');
    }

    public function edit($id)
    {
        $barang = \App\Models\Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        // Find the Barang record and update it
        $barang = \App\Models\Barang::findOrFail($id);
        $barang->update($validatedData);

        return redirect()->route('barang.index')->with('success', 'Barang updated successfully.');
    }

    public function destroy($id)
    {
        $barang = \App\Models\Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang deleted successfully.');
    }
}

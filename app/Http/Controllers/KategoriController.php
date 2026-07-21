<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Create a new Kategori record
        \App\Models\Kategori::create($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Kategori created successfully.');
    }

    public function edit($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Find the Kategori record and update it
        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->update($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Kategori updated successfully.');
    }

    public function destroy($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori deleted successfully.');
    }
}

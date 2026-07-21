<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        return view('pelanggan.index');
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ]);

        // Create a new Pelanggan record
        \App\Models\Pelanggan::create($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan created successfully.');
    }

    public function edit($id)
    {
        $pelanggan = \App\Models\Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email,' . $id,
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ]);

        // Find the Pelanggan record and update it
        $pelanggan = \App\Models\Pelanggan::findOrFail($id);
        $pelanggan->update($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan updated successfully.');
    }

    public function destroy($id)
    {
        $pelanggan = \App\Models\Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan deleted successfully.');
    }
}

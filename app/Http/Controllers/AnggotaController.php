<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('anggota.index');
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email',
            'password' => 'required|string|min:6',
            'status' => 'required|in:active,inactive',
        ]);

        // Create a new Anggota record
        \App\Models\Anggota::create($validatedData);

        return redirect()->route('anggota.index')->with('success', 'Anggota created successfully.');
    }

    public function edit($id)
    {
        $anggota = \App\Models\Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email,' . $id,
            'password' => 'nullable|string|min:6',
            'status' => 'required|in:active,inactive',
        ]);

        // Find the Anggota record and update it
        $anggota = \App\Models\Anggota::findOrFail($id);
        $anggota->update($validatedData);

        return redirect()->route('anggota.index')->with('success', 'Anggota updated successfully.');
    }

    public function destroy($id)
    {
        $anggota = \App\Models\Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota deleted successfully.');
    }
}

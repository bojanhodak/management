<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Barang::create([
            'nama_barang' => 'Tenda camping',
            'deskripsi' => 'Tenda camping yang nyaman dan tahan air.',
            'harga' => 10000,
            'stok' => 50,
            'kategori_id' => 1, // Pastikan kategori dengan ID 1 ada
        ]);
    }
}

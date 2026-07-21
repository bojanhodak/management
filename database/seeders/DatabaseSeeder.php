<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;
use App\Models\Kategori;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder User/Anggota Multi-Role
        Anggota::create([
            'nama' => 'Admin Utama',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Administrator',
        ]);

        Anggota::create([
            'nama' => 'Staff Rental',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Staff',
        ]);

        Anggota::create([
            'nama' => 'Customer Contoh',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Customer',
        ]);

        // Seeder Master Data Awal
        Kategori::create(['nama_kategori' => 'Kamera & Lensa', 'deskripsi' => 'Alat Fotografi']);
        Pelanggan::create(['nama' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'telepon' => '08123456789']);
    }
}

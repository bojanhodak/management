<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Anggota::create([
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'status' => 'aktif'
        ]);
        \App\Models\Anggota::create([
            'nama' => 'Staff',
            'email' => 'staff@example.com',
            'password' => bcrypt('87654321'),
            'status' => 'aktif'
        ]);
    }
}

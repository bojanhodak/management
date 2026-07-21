<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Pelanggan::create([
            'nama' => 'Dadang',
            'email' => 'dadangkonelo@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}

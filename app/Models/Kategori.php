<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = [];

    // Relasi ini yang menyelesaikan error BadMethodCallException sebelumnya
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}

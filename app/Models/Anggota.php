<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable
{
    use Notifiable;

    protected $table = 'anggotas';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    // Relasi jika ada
    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, 'anggota_id');
    }
}

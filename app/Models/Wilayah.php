<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    // Sesuaikan nama tabel jika berbeda
    protected $table = 'wilayah';
    protected $guarded = [];

    public function subWilayahs()
    {
        return $this->hasMany(SubWilayah::class, 'wilayah_id');
    }

    // Relasi Many-to-Many ke Guru lewat tabel pivot guru_wilayah
    public function gurus()
    {
        return $this->belongsToMany(User::class, 'guru_wilayah', 'wilayah_id', 'guru_id');
    }

    // Menghitung total siswa di wilayah ini (tembus lewat sub_wilayah)
    public function users()
    {
        return $this->hasManyThrough(User::class, SubWilayah::class, 'wilayah_id', 'sub_wilayah_id');
    }
}

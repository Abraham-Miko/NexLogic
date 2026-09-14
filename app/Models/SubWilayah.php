<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Wilayah;

class SubWilayah extends Model
{
    // Sesuaikan nama tabel jika berbeda
    protected $table = 'sub_wilayah';
    protected $guarded = [];

    // Relasi Balik: 1 Kelas dimiliki oleh 1 Wilayah
    // Relasi Balik ke Wilayah
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    // Relasi ke Guru yang memegang Sub Wilayah ini
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Relasi ke Guru yang memegang Sub Wilayah ini
    public function siswa()
    {
        return $this->hasMany(User::class, 'sub_wilayah_id')->where('role', 'siswa');
    }

    // Relasi 1 Kelas punya Banyak Siswa
    public function users()
    {
        return $this->hasMany(User::class, 'sub_wilayah_id');
    }

    // Relasi ke Bank Soal
    public function bankSoal()
    {
        return $this->hasMany(BankSoal::class, 'sub_wilayah_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'siswa_id',
        'sub_wilayah_id',
        'materi_ke',
        'skor_pre',
        'skor_post',
        'skor_puzzle',
    ];

    /**
     * Relasi ke User (siswa).
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    /**
     * Relasi ke SubWilayah.
     */
    public function subWilayah()
    {
        return $this->belongsTo(SubWilayah::class, 'sub_wilayah_id');
    }

    /**
     * Mendapatkan total skor_puzzle untuk seorang siswa.
     */
    public static function totalSkorPuzzle(int $siswaId): int
    {
        return static::where('siswa_id', $siswaId)->sum('skor_puzzle');
    }
}

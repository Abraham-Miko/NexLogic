<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    use HasFactory;

    protected $table = 'puzzle';

    protected $fillable = [
        'level',
        'pertanyaan',
        'kode_snippet',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
        'petunjuk',
    ];

    /**
     * Mengambil teks opsi berdasarkan huruf jawaban (A, B, C, D).
     */
    public function getOpsiByHuruf(string $huruf): string
    {
        return match (strtoupper($huruf)) {
            'A' => $this->opsi_a,
            'B' => $this->opsi_b,
            'C' => $this->opsi_c,
            'D' => $this->opsi_d,
            default => '',
        };
    }

    /**
     * Scope untuk mengurutkan puzzle berdasarkan level.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('level', 'asc');
    }
}

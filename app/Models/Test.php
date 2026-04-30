<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'guru_id',
        'type',
        'question',
        'options',
        'correct_answer',
    ];

    protected $casts = [
        // Otomatis decode JSON ke array saat diakses
        'options' => 'array',
    ];

    // ── Relasi ────────────────────────────────────────────

    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // ── Helpers ───────────────────────────────────────────

    /**
     * Kembalikan teks label pilihan berdasarkan kunci (A/B/C/D).
     */
    public function getOption(string $key): ?string
    {
        return $this->options[$key] ?? null;
    }
}

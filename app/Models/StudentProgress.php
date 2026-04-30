<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProgress extends Model
{
    use HasFactory;

    protected $table = 'student_progress';

    protected $fillable = [
        'user_id',
        'materi_id',
        'pre_test_score',
        'post_test_score',
        'progress_percentage',
        'stars',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    // ── Relasi ────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class);
    }

    // ── Helpers ───────────────────────────────────────────

    /**
     * Hitung persentase progres berdasarkan langkah yang sudah selesai.
     * Alur: pre_test (33%) → baca materi (66%) → post_test (100%)
     */
    public static function calculateProgress(?int $preScore, bool $hasReadMateri, ?int $postScore): int
    {
        if ($postScore !== null)   return 100;
        if ($hasReadMateri)        return 66;
        if ($preScore !== null)    return 33;
        return 0;
    }

    /**
     * Hitung bintang dari skor post-test.
     * <60 → 0 bintang, 60-79 → 1, 80-89 → 2, 90+ → 3
     */
    public static function calculateStars(?int $postScore): int
    {
        if ($postScore === null)  return 0;
        if ($postScore >= 90)    return 3;
        if ($postScore >= 80)    return 2;
        if ($postScore >= 60)    return 1;
        return 0;
    }

    /** Apakah siswa sudah mengerjakan pre-test? */
    public function hasPreTest(): bool
    {
        return $this->pre_test_score !== null;
    }

    /** Apakah siswa sudah selesai post-test? */
    public function hasPostTest(): bool
    {
        return $this->post_test_score !== null;
    }
}

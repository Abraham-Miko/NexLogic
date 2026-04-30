<?php

namespace App\Models;

use App\Models\MateriVisibility;
use App\Models\StudentProgress;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'level',
        'content',
        'order_number',
        'icon',
    ];

    // ── Relasi ────────────────────────────────────────────

    /** Semua soal (pre-test & post-test) yang dimiliki materi ini */
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

    /** Soal pre-test saja */
    public function preTests(): HasMany
    {
        return $this->hasMany(Test::class)->where('type', 'pre_test');
    }

    /** Soal post-test saja */
    public function postTests(): HasMany
    {
        return $this->hasMany(Test::class)->where('type', 'post_test');
    }

    /** Semua record visibilitas (per guru) untuk materi ini */
    public function visibilities(): HasMany
    {
        return $this->hasMany(MateriVisibility::class);
    }

    /** Semua progres siswa untuk materi ini */
    public function studentProgress(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }

    // ── Helpers ───────────────────────────────────────────

    /**
     * Cek apakah materi ini terkunci untuk guru tertentu.
     * Jika belum ada record visibilitas, dianggap terkunci (default true).
     */
    public function isLockedForGuru(int $guruId): bool
    {
        $visibility = $this->visibilities->firstWhere('guru_id', $guruId);
        return $visibility ? (bool) $visibility->is_locked : true;
    }

    /**
     * Ambil progres siswa tertentu untuk materi ini.
     */
    public function progressFor(int $userId): ?StudentProgress
    {
        return $this->studentProgress->firstWhere('user_id', $userId);
    }

    /**
     * Warna border card berdasarkan level.
     */
    public function levelColor(): string
    {
        return match ($this->level) {
            'beginner' => '#22c55e',  // green
            'amateur'  => '#eab308',  // yellow
            'pro'      => '#ef4444',  // red
            default    => '#6366f1',
        };
    }

    /**
     * Warna badge level.
     */
    public function levelBadgeClass(): string
    {
        return match ($this->level) {
            'beginner' => 'badge-beginner',
            'amateur'  => 'badge-amateur',
            'pro'      => 'badge-pro',
            default    => '',
        };
    }
}

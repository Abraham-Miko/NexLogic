<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MateriVisibility extends Model
{
    use HasFactory;

    protected $table = 'materi_visibilities';

    protected $fillable = [
        'materi_id',
        'guru_id',
        'is_locked',
    ];

    protected $casts = [
        'is_locked' => 'boolean',
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
}

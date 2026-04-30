<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara mass-assignment.
     * Sesuaikan dengan kolom di migration kamu.
     */
    protected $fillable = [
        'email',
        'nama',
        'nomor_induk',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat array/JSON ditampilkan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}

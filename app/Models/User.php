<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

   /**
     * Kolom yang boleh diisi secara mass-assignment.
     * Sesuaikan dengan kolom di migration kamu.
     */
    protected $fillable = [
        'nama',
        'nomor_induk',
        'password',
        'sub_wilayah_id',
        'jenis_kelamin',
        'status',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function subWilayah()
    {
        return $this->belongsTo(SubWilayah::class, 'sub_wilayah_id');
    }
    public function subWilayahs() // Gunakan akhiran 's' karena jomok
    {
        return $this->hasMany(SubWilayah::class, 'guru_id');
    }
    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=random&color=fff'
        );
    }
}

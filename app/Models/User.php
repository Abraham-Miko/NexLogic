<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\SubWilayah;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaTemplateExport;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

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

    public function subWilayahs(){

    return $this->hasMany(SubWilayah::class, 'guru_id');

    }

    public function subWilayah(){

        return $this->belongsTo(SubWilayah::class, 'sub_wilayah_id');

    }

    public function wilayahs(){

        return $this->belongsToMany(Wilayah::class, 'guru_wilayah', 'guru_id', 'wilayah_id');

    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=random&color=fff'
        );
    }

    public function hasRole($role)
    {
        return $this->role === $role;
        // Sesuaikan logic ini dengan struktur database Anda (misal: $this->role_id atau kolom lainnya)
    }

}

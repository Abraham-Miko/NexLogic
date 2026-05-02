<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaTemplateExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Mengambil data siswa dari database
     */
    public function collection()
    {
        // Hanya ambil user dengan role 'siswa'
        return User::where('role', 'siswa')->get();
    }

    /**
     * Mengatur urutan kolom yang muncul di Excel
     */
    public function map($siswa): array
    {
        return [
            $siswa->nama,
            $siswa->nomor_induk,
            $siswa->jenis_kelamin,
            $siswa->subWilayah,
            $siswa->role,
        ];
    }

    /**
     * Judul Kolom
     */
    public function headings(): array
    {
        return [
            'NAMA LENGKAP',
            'NOMOR INDUK',
            'JENIS KELAMIN (L/P)',
            'SUB WILAYAH',
            'ROLE (SISWA/GURU)',
        ];
    }
}

<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GuruImport implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Mulai baca data dari baris ke-2 (mengabaikan judul kolom)
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Cegah error jika ada baris kosong di Excel
        if (!isset($row[0]) || !isset($row[1])) {
            return null;
        }

        // Cek apakah NIS (Nomor Induk) sudah ada di database agar tidak ganda
        $cekSiswa = User::where('nomor_induk', $row[1])->first();
        if ($cekSiswa) {
            return null; // Skip (lewati) baris ini jika NIS sudah terdaftar
        }

        // Tentukan Password: Jika di Excel kosong, jadikan NIS sebagai password default
        $password = !empty($row[3]) ? $row[3] : $row[1];

        return new User([
            'nama'          => $row[0],               // Kolom A: Nama Lengkap
            'nomor_induk'   => $row[1],               // Kolom B: NIS
            'jenis_kelamin' => strtoupper($row[2]),   // Kolom C: L / P
            'password'      => Hash::make($password), // Kolom D: Password
            'role'          => 'guru',               // Otomatis diset sebagai siswa
            'status'        => 'aktif',               // Otomatis diset aktif
        ]);
    }
}

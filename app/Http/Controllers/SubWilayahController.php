<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubWilayah;
use Illuminate\Http\Request;

class SubWilayahController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',
            'guru_id' => 'required|exists:users,id',
            'nama_sub_wilayah' => 'required|string|max:50',
            'kode_sub_wilayah' => 'required|string|max:20|unique:sub_wilayah,kode_sub_wilayah',
        ]);

        // 2. Simpan Data
        $subBaru = SubWilayah::create([
            'wilayah_id' => $request->wilayah_id, // Didapat dari hidden input
            'guru_id' => $request->guru_id,       // Didapat dari dropdown
            'nama_sub_wilayah' => $request->nama_sub_wilayah,
            'kode_sub_wilayah' => strtoupper($request->kode_sub_wilayah),
            // materi_aktif tidak perlu diisi di sini karena database sudah punya default(false)
        ]);

        return redirect()->back()->with('success', "Sub Wilayah (Kelas) baru berhasil ditambahkan! (ID: {$subBaru->id})");
    }

    public function update(Request $request, $id)
    {
        $subWilayah = SubWilayah::findOrFail($id);

        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'nama_sub_wilayah' => 'required|string|max:50',
            // Pastikan kode unik, tapi kecualikan ID sub wilayah ini sendiri
            'kode_sub_wilayah' => 'required|string|max:20|unique:sub_wilayah,kode_sub_wilayah,' . $subWilayah->id,
        ]);

        $subWilayah->update([
            'guru_id' => $request->guru_id,
            'nama_sub_wilayah' => $request->nama_sub_wilayah,
            'kode_sub_wilayah' => strtoupper($request->kode_sub_wilayah),
        ]);

        return redirect()->back()->with('success', "Sub Wilayah dengan ID {$subWilayah->id} berhasil diperbarui!");
    }

    public function destroy($id)
    {
        $subWilayah = SubWilayah::findOrFail($id);
        if ($subWilayah->users()->where('role', 'siswa')->exists()) {
            return redirect()->back()->with('error', "Gagal dihapus! Sub Wilayah ini masih memiliki Siswa di dalamnya. Pindahkan atau hapus data siswa terlebih dahulu.");
        }

        $idDihapus = $subWilayah->id;
        $subWilayah->delete();

        return redirect()->back()->with('success', "Sub Wilayah dengan ID {$idDihapus} berhasil dihapus permanen!");
    }

    public function show($id)
    {
        $subWilayah = SubWilayah::with(['guru', 'users' => function($query) {
            $query->where('role', 'siswa')->orderBy('nama', 'asc');
        }])->findOrFail($id);

        // AMBIL CALON SISWA: Role Siswa, Status Aktif, dan Belum Punya Kelas
        $calonSiswa = \App\Models\User::where('role', 'siswa')
            ->where('status', 'aktif')
            ->whereNull('sub_wilayah_id') // Mencari yang foreign key-nya masih kosong (NULL)
            ->orderBy('nama', 'asc')
            ->get();

        return view('superadmin.subwilayah.show', compact('subWilayah', 'calonSiswa'));
    }

    public function assignSiswa(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id'
        ]);

        $siswa = \App\Models\User::findOrFail($request->siswa_id);

        // Update data siswa agar masuk ke kelas (sub_wilayah) ini
        $siswa->update([
            'sub_wilayah_id' => $id
        ]);

        return redirect()->back()->with('success', "Siswa {$siswa->nama} berhasil dimasukkan ke kelas!");
    }
    public function removeSiswa($siswa_id)
    {
        // Cari data siswa berdasarkan ID
        $siswa = \App\Models\User::findOrFail($siswa_id);

        // Simpan nama untuk ditampilkan di pesan sukses
        $namaSiswa = $siswa->nama;

        // Ubah sub_wilayah_id menjadi null (kosong)
        $siswa->update([
            'sub_wilayah_id' => null
        ]);

        return redirect()->back()->with('success', "Siswa {$namaSiswa} berhasil dikeluarkan dari kelas.");
    }
}

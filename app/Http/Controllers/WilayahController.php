<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use App\Models\SubWilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index() {
        // Ambil semua wilayah beserta jumlah kelas dan jumlah siswa (yang rolenya siswa)
        $wilayahs = Wilayah::withCount([
            'subWilayahs',
            'users' => function($query) {
                $query->where('role', 'siswa');
            }
        ])->get();

        return view('superadmin.wilayah.index', compact('wilayahs'));
    }

    public function store(Request $request) {
        // 1. Validasi data yang masuk
        $request->validate([
            'nama_wilayah' => 'required|string|max:255',
            // Pastikan kode_wilayah unik di tabel wilayah
            'kode_wilayah' => 'required|string|max:255|unique:wilayah,kode_wilayah',
        ], [
            'kode_wilayah.unique' => 'Kode Wilayah ini sudah digunakan, silakan pilih kode lain.'
        ]);

        // 2. Simpan ke database
        Wilayah::create([
            'nama_wilayah' => $request->nama_wilayah,
            'kode_wilayah' => strtoupper($request->kode_wilayah),
        ]);

        // 3. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Wilayah baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
         $wilayah = Wilayah::findOrFail($id);

        $request->validate([
            'nama_wilayah'  => 'required|string|max:30',
            'kode_wilayah'  => 'required|string|max:10|unique:wilayah,kode_wilayah,' . $wilayah->id,
        ]);

        $dataToUpdate = [
            'nama_wilayah'  => $request->nama_wilayah,
            'kode_wilayah'  => strtoupper($request->kode_wilayah),
        ];

        $wilayah->update($dataToUpdate);
        return redirect()->back()->with('success', "Wilayah ID ({$id}) berhasil diubah!");
    }

    public function destroy($id)
    {
        $wilayah = Wilayah::findOrFail($id);
        if ($wilayah->subWilayahs()->exists()) {
            return redirect()->back()->with('error', "Gagal dihapus! Wilayah dengan ID {$wilayah->id} masih memiliki Sub Wilayah (Kelas) di dalamnya. Kosongkan dulu wilayah ini sebelum menghapusnya.");
        }
        $idDihapus = $wilayah->id;

        $wilayah->delete();
        return redirect()->back()->with('success', "Data wilayah dengan ID {$idDihapus} berhasil dihapus permanen!");
    }

    public function show($id) {
        $wilayah = Wilayah::findOrFail($id);
        $subWilayahs = SubWilayah::with('guru')
            ->where('wilayah_id', $id)
            ->withCount(['users' => function($query) {
                $query->where('role', 'siswa');
            }])
            ->get();
        // dd($subWilayahs);
        $gurus = \App\Models\User::where('role', 'guru')->where('status', 'aktif')->get();
        return view('superadmin.wilayah.show', compact('wilayah', 'subWilayahs', 'gurus'));
    }
}

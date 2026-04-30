<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function indexSiswa(Request $request)
    {
        $totalSiswa = User::where('role', 'siswa')->count();
        $siswaAktif = User::where('role', 'siswa')->where('status', 'aktif')->count();
        $siswaTidakAktif = User::where('role', 'siswa')->where('status', 'tidak_aktif')->count();

        $siswaBaru = User::where('role', 'siswa')
                         ->whereMonth('created_at', Carbon::now()->month)
                         ->whereYear('created_at', Carbon::now()->year)
                         ->count();

        $siswa = User::where('role', 'siswa')
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nomor_induk', 'like', '%' . $search . '%');
            });
        })
        ->when($request->jenis_kelamin, function ($query, $jk) {
            $query->where('jenis_kelamin', $jk);
        })
        ->when($request->status, function ($query, $status) {
            $query->where('status', $status);
        })

        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('superadmin.siswa.index', compact(
            'siswa',
            'totalSiswa',
            'siswaAktif',
            'siswaTidakAktif',
            'siswaBaru'
        ));
    }

    public function createSiswa()
    {
        return view('superadmin.siswa.create');
    }

    public function storeSiswa(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nomor_induk'   => 'required|string|max:20|unique:users,nomor_induk',
            'password'      => 'required|string|min:6',
            'jenis_kelamin' => 'nullable|in:L,P',
            'status'        => 'required|in:aktif,tidak_aktif',
        ], [
            'nomor_induk.unique' => 'NIS ini sudah terdaftar di sistem!',
        ]);

        // 2. Simpan ke Database
        User::create([
            'nama'          => $request->nama,
            'nomor_induk'   => $request->nomor_induk,
            'password'      => Hash::make($request->password), // Enkripsi password!
            'role'          => 'siswa', // Kunci otomatis role sebagai siswa
            'jenis_kelamin' => $request->jenis_kelamin,
            'status'        => $request->status,
        ]);

        return redirect()->route('superadmin.siswa')
                         ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function editSiswa($id)
    {
        // Cari user berdasarkan ID, jika tidak ketemu akan otomatis error 404
        $siswa = User::findOrFail($id);
        return view('superadmin.siswa.edit', compact('siswa'));
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = User::findOrFail($id);

        $request->validate([
            'nama'          => 'required|string|max:255',
            'nomor_induk'   => 'required|string|max:20|unique:users,nomor_induk,' . $siswa->id,
            'jenis_kelamin' => 'nullable|in:L,P',
            'status'        => 'required|in:aktif,tidak_aktif',
            'password'      => 'nullable|string|min:6',
        ]);

        $dataToUpdate = [
            'nama'          => $request->nama,
            'nomor_induk'   => $request->nomor_induk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status'        => $request->status,
        ];

        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $siswa->update($dataToUpdate);
        return redirect()->route('superadmin.siswa')
                         ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroySiswa($id)
    {
        $siswa = User::findOrFail($id);
        $siswa->delete();
        return redirect()->route('superadmin.siswa')
                         ->with('success', 'Data siswa berhasil dihapus secara permanen.');
    }

    public function indexGuru(Request $request)
    {
        $totalGuru = User::where('role', 'guru')->count();
        $guruAktif = User::where('role', 'guru')->where('status', 'aktif')->count();
        $guruTidakAktif = User::where('role', 'guru')->where('status', 'tidak_aktif')->count();

        $guruBaru = User::where('role', 'guru')
                         ->whereMonth('created_at', Carbon::now()->month)
                         ->whereYear('created_at', Carbon::now()->year)
                         ->count();

        $guru = User::where('role', 'guru')
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nomor_induk', 'like', '%' . $search . '%');
            });
        })
        ->when($request->jenis_kelamin, function ($query, $jk) {
            $query->where('jenis_kelamin', $jk);
        })
        ->when($request->status, function ($query, $status) {
            $query->where('status', $status);
        })

        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('superadmin.guru.index', compact(
            'guru',
            'totalGuru',
            'guruAktif',
            'guruTidakAktif',
            'guruBaru'
        ));
    }
    public function createGuru()
    {
        return view('superadmin.guru.create');
    }

    public function storeGuru(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nomor_induk'   => 'required|string|max:20|unique:users,nomor_induk',
            'password'      => 'required|string|min:6',
            'jenis_kelamin' => 'nullable|in:L,P',
            'status'        => 'required|in:aktif,tidak_aktif',
        ], [
            'nomor_induk.unique' => 'NIS ini sudah terdaftar di sistem!',
        ]);

        // 2. Simpan ke Database
        User::create([
            'nama'          => $request->nama,
            'nomor_induk'   => $request->nomor_induk,
            'password'      => Hash::make($request->password), // Enkripsi password!
            'role'          => 'guru', // Kunci otomatis role sebagai guru
            'jenis_kelamin' => $request->jenis_kelamin,
            'status'        => $request->status,
        ]);

        return redirect()->route('superadmin.guru')
                         ->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function editGuru($id)
    {
        // Cari user berdasarkan ID, jika tidak ketemu akan otomatis error 404
        $guru = User::findOrFail($id);
        return view('superadmin.guru.edit', compact('guru'));
    }

    public function updateGuru(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $request->validate([
            'nama'          => 'required|string|max:255',
            'nomor_induk'   => 'required|string|max:20|unique:users,nomor_induk,' . $guru->id,
            'jenis_kelamin' => 'nullable|in:L,P',
            'status'        => 'required|in:aktif,tidak_aktif',
            'password'      => 'nullable|string|min:6',
        ]);

        $dataToUpdate = [
            'nama'          => $request->nama,
            'nomor_induk'   => $request->nomor_induk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status'        => $request->status,
        ];

        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $guru->update($dataToUpdate);
        return redirect()->route('superadmin.guru')
                         ->with('success', 'Data guru berhasil diperbarui!');
    }

    public function destroyGuru($id)
    {
        $guru = User::findOrFail($id);
        $guru->delete();
        return redirect()->route('superadmin.guru')
                         ->with('success', 'Data guru berhasil dihapus secara permanen.');
    }
}

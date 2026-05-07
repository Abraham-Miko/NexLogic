<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wilayah;
use App\Models\SubWilayah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        $totalSiswa = User::where('role', 'siswa')->where('status', 'aktif')->count();
        $totalGuru = User::where('role', 'guru')->where('status', 'aktif')->count();
        $totalWilayah = Wilayah::count();
        $totalKelas = SubWilayah::count();
        $siswaLaki = User::where('role', 'siswa')->where('status', 'aktif')->where('jenis_kelamin', 'L')->count();
        $siswaPerempuan = User::where('role', 'siswa')->where('status', 'aktif')->where('jenis_kelamin', 'P')->count();

        $distribusiKelas = \Illuminate\Support\Facades\DB::table('sub_wilayah')
            ->leftJoin('wilayah', 'sub_wilayah.wilayah_id', '=', 'wilayah.id')
            ->leftJoin('users', function($join) {
                $join->on('sub_wilayah.id', '=', 'users.sub_wilayah_id')
                     ->where('users.role', '=', 'siswa')
                     ->where('users.status', '=', 'aktif');
            })
            ->select(
                'sub_wilayah.id',
                'sub_wilayah.nama_sub_wilayah',
                'wilayah.nama_wilayah',
                \Illuminate\Support\Facades\DB::raw('count(users.id) as total_siswa')
            )
            ->groupBy('sub_wilayah.id', 'sub_wilayah.nama_sub_wilayah', 'wilayah.nama_wilayah')
            ->get();
        $labelKelas = $distribusiKelas->map(function ($item) {
            $namaWilayah = $item->nama_wilayah ? $item->nama_wilayah : 'Tanpa Wilayah';
            return [
                $item->nama_sub_wilayah, // Baris atas: X-RPL
                $namaWilayah             // Baris bawah: Angkatan 2026
            ];

        })->toArray();
        $dataSiswaKelas = $distribusiKelas->pluck('total_siswa');

        $siswaTanpaKelas = User::where('role', 'siswa')
                               ->where('status', 'aktif')
                               ->whereNull('sub_wilayah_id')
                               ->count();

        $kelasTanpaWali = SubWilayah::whereNull('guru_id')->count();

        // Kirim semua data ke view dashboard
        return view('superadmin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalWilayah',
            'totalKelas',
            'siswaTanpaKelas',
            'kelasTanpaWali',
            'siswaLaki',
            'siswaPerempuan',
            'labelKelas',
            'dataSiswaKelas'
        ));
    }

// app/Http/Controllers/DashboardController.php

    public function indexSiswa() {
        $user = auth()->user();

        // Redirect jika bukan siswa
        if ($user->role === 'super_admin') return redirect()->route('superadmin.dashboard');
        if ($user->role === 'guru') return redirect()->route('guru.dashboard');

        $siswa = $user;
        $subWilayah = $siswa->subWilayah; // Mengambil data kelas/wilayah

        // 1. Ambil semua siswa di sub-wilayah yang sama untuk perhitungan ranking
        $rankingSiswa = \App\Models\User::where('sub_wilayah_id', $siswa->sub_wilayah_id)
        ->where('role', 'siswa')
        ->get()
        ->map(function($s) {
            return [
                'id' => $s->id,
                'total_poin' => \App\Models\Penilaian::where('siswa_id', $s->id)->sum('skor_puzzle')
            ];
        })
        ->sortByDesc('total_poin')
        ->values();

        $userRank = $rankingSiswa->search(function($item) use ($user) {
            return $item['id'] === $user->id;
        }) + 1;
        // 1. Ambil Status Aktivasi Materi dari Tabel Sub Wilayah
        $statusMateri = [
            1 => (bool) ($subWilayah->materi_1_aktif ?? false),
            2 => (bool) ($subWilayah->materi_2_aktif ?? false),
            3 => (bool) ($subWilayah->materi_3_aktif ?? false),
            4 => (bool) ($subWilayah->materi_4_aktif ?? false),
            5 => (bool) ($subWilayah->materi_5_aktif ?? false),
            6 => (bool) ($subWilayah->materi_6_aktif ?? false),
        ];

        // 2. Hitung Progress & Total XP
        $progressMateri = [];
        $totalProgressValue = 0;
        $totalXP = 0;

        for ($i = 1; $i <= 6; $i++) {
            $penilaian = \App\Models\Penilaian::where('siswa_id', $user->id)
                ->where('materi_ke', $i)
                ->first();

            if ($penilaian) {
                // Hitung XP (Skor Post Test + Skor Puzzle)
                $totalXP += ($penilaian->skor_puzzle ?? 0);

                // Logika Progress Sesuai Kesepakatan
                if (!is_null($penilaian->skor_post)) {
                    $progressMateri[$i] = 100;
                } elseif (!is_null($penilaian->skor_pre)) {
                    $progressMateri[$i] = 40;
                } else {
                    $progressMateri[$i] = 0;
                }
            } else {
                $progressMateri[$i] = 0;
            }
            $totalProgressValue += $progressMateri[$i];
        }

        // Rata-rata progress keseluruhan
        $overallProgress = round($totalProgressValue / 6);

        // Data Statis Judul Materi
        $materis = [
            1 => ['judul' => 'Variabel & Tipe Data', 'level' => 'Beginner'],
            2 => ['judul' => 'Operator & Ekspresi', 'level' => 'Beginner'],
            3 => ['judul' => 'Input & Output', 'level' => 'Amateur'],
            4 => ['judul' => 'Percabangan (if/else)', 'level' => 'Amateur'],
            5 => ['judul' => 'Perulangan (for & while)', 'level' => 'Pro'],
            6 => ['judul' => 'Fungsi & Parameter', 'level' => 'Pro'],
        ];

        return view('dashboard', compact(
            'user', 'subWilayah', 'statusMateri',
            'progressMateri', 'overallProgress', 'totalXP', 'materis', 'userRank'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pastikan user adalah siswa dan memiliki sub wilayah
        if (!$user || $user->role !== 'siswa' || !$user->sub_wilayah_id) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $subWilayahId = $user->sub_wilayah_id;
        $namaSubWilayah = $user->subWilayah->nama_sub_wilayah ?? 'Kelas Saya';

        // 1. Ambil semua siswa di sub-wilayah yang sama
        $students = User::where('role', 'siswa')
            ->where('sub_wilayah_id', $subWilayahId)
            ->get();

        // 2. Hitung total Poin (Akumulasi skor_puzzle) untuk tiap siswa
        $leaderboardData = $students->map(function ($student) use ($subWilayahId) {
            $totalPoin = Penilaian::where('siswa_id', $student->id)
                ->where('sub_wilayah_id', $subWilayahId)
                ->sum('skor_puzzle'); // Pastikan ini sesuai dengan nama kolom poin Anda

            return [
                'nama' => $student->nama,
                // Menggunakan UI Avatars sebagai fallback foto profil
                'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($student->nama) . '&background=7c3aed&color=fff&bold=true',
                'poin' => $totalPoin,
            ];
        })
        // Urutkan berdasarkan poin terbesar
        ->sortByDesc('poin')
        ->values(); // Reset index array

        // 3. Pisahkan Top 3 dan Peringkat Sisanya
        $top3 = [];
        $others = [];

        foreach ($leaderboardData as $index => $data) {
            $rank = $index + 1;
            if ($rank <= 3) {
                $top3[$rank] = $data;
            } else {
                $others[$rank] = $data;
            }
        }

        // Jaga-jaga jika murid di kelas kurang dari 3 orang agar podium tidak error
        for ($i = 1; $i <= 3; $i++) {
            if (!isset($top3[$i])) {
                $top3[$i] = ['nama' => 'Belum Ada', 'avatar' => 'https://ui-avatars.com/api/?name=?&background=1e293b&color=fff', 'poin' => 0];
            }
        }

        return view('leaderboard.index', [
            'wilayah' => $namaSubWilayah,
            'top3' => $top3,
            'others' => $others
        ]);
    }
}

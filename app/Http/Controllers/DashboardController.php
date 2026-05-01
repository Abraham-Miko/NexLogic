<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wilayah;
use App\Models\SubWilayah;
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
}

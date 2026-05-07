<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Puzzle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PuzzleController extends Controller
{
    /**
     * Halaman Peta Puzzle (Map Leveling).
     *
     * Menampilkan semua puzzle beserta status siswa
     * (selesai, sedang dikerjakan, terkunci).
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua puzzle, urutkan by level
        $puzzle = Puzzle::ordered()->get();

        // Ambil record penilaian milik siswa ini untuk sub_wilayah mereka
        $penilaian = Penilaian::where('siswa_id', $user->id)
            ->where('sub_wilayah_id', $user->sub_wilayah_id)
            ->pluck('skor_puzzle', 'materi_ke'); // [materi_ke => skor_puzzle]

        // Total EXP siswa dari semua puzzle
        $totalExp = Penilaian::totalSkorPuzzle($user->id);

        // Tentukan level puzzle mana yang sudah diselesaikan
        // Puzzle dianggap "selesai" jika skor_puzzle > 0
        $completedLevels = $penilaian->filter(fn($skor) => $skor > 0)->keys()->toArray();

        // Level berikutnya yang boleh dikerjakan
        // (level tertinggi yang sudah selesai + 1, atau level 1 jika belum ada)
        $nextLevel = empty($completedLevels)
            ? 1
            : (max($completedLevels) + 1);

        return view('puzzle.index', compact('puzzle', 'completedLevels', 'nextLevel', 'totalExp'));
    }

    /**
     * Halaman Detail Puzzle — Mengerjakan Soal.
     */
    public function show(Puzzle $puzzle)
    {
        $user = Auth::user();

        // Cek apakah siswa boleh mengerjakan puzzle ini
        // (level harus <= nextLevel yang sudah dihitung)
        $totalCompleted = Penilaian::where('siswa_id', $user->id)
            ->where('sub_wilayah_id', $user->sub_wilayah_id)
            ->where('skor_puzzle', '>', 0)
            ->count();

        $nextLevel = $totalCompleted + 1;

        if ($puzzle->level > $nextLevel) {
            return redirect()->route('puzzle.index')
                ->with('error', 'Selesaikan puzzle sebelumnya terlebih dahulu!');
        }

        // Total EXP saat ini
        $totalExp = Penilaian::totalSkorPuzzle($user->id);

        // Ambil puzzle sebelum dan sesudah untuk navigasi
        $prevPuzzle = Puzzle::where('level', '<', $puzzle->level)->ordered()->last();
        $nextPuzzle = Puzzle::where('level', '>', $puzzle->level)->ordered()->first();

        // Cek apakah puzzle ini sudah diselesaikan
        $sudahSelesai = Penilaian::where('siswa_id', $user->id)
            ->where('sub_wilayah_id', $user->sub_wilayah_id)
            ->where('materi_ke', $puzzle->level)
            ->where('skor_puzzle', '>', 0)
            ->exists();

        return view('puzzle.show', compact(
            'puzzle',
            'totalExp',
            'prevPuzzle',
            'nextPuzzle',
            'sudahSelesai',
        ));
    }

    /**
     * Proses Submit Jawaban Siswa.
     *
     * - Validasi jawaban.
     * - Jika benar: tambahkan 10 poin ke skor_puzzle di tabel penilaian.
     * - Return JSON agar bisa ditangani oleh Alpine.js / fetch di frontend.
     */
    public function jawab(Request $request, Puzzle $puzzle)
    {
        $request->validate([
            'jawaban' => ['required', 'string', 'in:A,B,C,D'],
        ]);

        $user = Auth::user();
        $jawabanUser  = strtoupper($request->input('jawaban'));
        $jawabanBenar = strtoupper($puzzle->jawaban_benar);

        $benar = ($jawabanUser === $jawabanBenar);

        if ($benar) {
            // Cari atau buat record penilaian untuk puzzle ini
            $penilaian = Penilaian::firstOrNew([
                'siswa_id'       => $user->id,
                'sub_wilayah_id' => $user->sub_wilayah_id,
                'materi_ke'      => $puzzle->level,
            ]);

            // Hanya tambah poin jika belum pernah menjawab benar sebelumnya
            if (! $penilaian->exists || ($penilaian->skor_puzzle ?? 0) === 0) {
                $penilaian->skor_puzzle = ($penilaian->skor_puzzle ?? 0) + 10;
                $penilaian->save();
                $pointsDitambahkan = 10;
            } else {
                // Sudah pernah menjawab benar, tidak double poin
                $pointsDitambahkan = 0;
            }
        }

        $totalExp = Penilaian::totalSkorPuzzle($user->id);

        return response()->json([
            'benar'              => $benar,
            'jawaban_benar'      => $jawabanBenar,
            'points_ditambahkan' => $benar ? ($pointsDitambahkan ?? 0) : 0,
            'total_exp'          => $totalExp,
            'pesan'              => $benar
                ? '🎉 Jawaban Benar! +' . ($pointsDitambahkan ?? 0) . ' EXP'
                : '❌ Jawaban Salah. Coba lagi!',
        ]);
    }

    public function courses() {
        $user = auth()->user();
        $subWilayahId = auth()->user()->sub_wilayah_id;
        $subWilayah = $user->subWilayah;

        if ($subWilayah) {
            $statusMateri = [
                1 => (bool) $subWilayah->materi_1_aktif,
                2 => (bool) $subWilayah->materi_2_aktif,
                3 => (bool) $subWilayah->materi_3_aktif,
                4 => (bool) $subWilayah->materi_4_aktif,
                5 => (bool) $subWilayah->materi_5_aktif,
                6 => (bool) $subWilayah->materi_6_aktif,
            ];
        } else {
            $statusMateri = [
                1 => false, 2 => false, 3 => false, 4 => false, 5 => false, 6 => false
            ];
        }
        $user = auth()->user();
        $siswaId = $user->id;
        $progressMateri = [];
        for ($i = 1; $i <= 6; $i++) {
            $penilaian = \App\Models\Penilaian::where('siswa_id', $siswaId)
                ->where('materi_ke', $i)
                ->first();

            // Logika Sederhana: Cek Post-test dulu, baru Pre-test
            if ($penilaian && !is_null($penilaian->skor_post)) {
                // Jika sudah mengerjakan Post-test, progres langsung penuh
                $progressMateri[$i] = 100;
            } elseif ($penilaian && !is_null($penilaian->skor_pre)) {
                // Jika baru mengerjakan Pre-test
                $progressMateri[$i] = 40;
            } else {
                // Belum mengerjakan apapun
                $progressMateri[$i] = 0;
            }
        }

        return view('courses', compact('statusMateri', 'progressMateri'));

    }

}

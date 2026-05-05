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

}

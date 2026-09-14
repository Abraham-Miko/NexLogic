<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Puzzle;
use Illuminate\Http\Request;

class SuperAdminPuzzleController extends Controller
{
    /**
     * Daftar semua puzzle.
     */
    public function index()
    {
        $puzzle = Puzzle::ordered()->paginate(15);

        return view('superadmin.puzzle.index', compact('puzzle'));
    }

    /**
     * Form tambah puzzle baru.
     */
    public function create()
    {
        // Level berikutnya yang tersedia (auto-suggest)
        $nextLevel = (Puzzle::max('level') ?? 0) + 1;

        return view('superadmin.puzzle.create', compact('nextLevel'));
    }

    /**
     * Simpan puzzle baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'level'         => ['required', 'integer', 'min:1', 'unique:puzzle,level'],
            'pertanyaan'    => ['required', 'string'],
            'kode_snippet'  => ['nullable', 'string'],
            'opsi_a'        => ['required', 'string', 'max:500'],
            'opsi_b'        => ['required', 'string', 'max:500'],
            'opsi_c'        => ['required', 'string', 'max:500'],
            'opsi_d'        => ['required', 'string', 'max:500'],
            'jawaban_benar' => ['required', 'in:A,B,C,D'],
            'petunjuk'      => ['required', 'string'],
        ], [
            'level.unique'      => 'Level puzzle ini sudah ada. Pilih nomor level yang berbeda.',
            'jawaban_benar.in'  => 'Jawaban benar harus salah satu dari: A, B, C, atau D.',
        ]);

        Puzzle::create($validated);

        return redirect()
            ->route('superadmin.puzzle.index')
            ->with('success', "Puzzle Level {$validated['level']} berhasil ditambahkan!");
    }

    /**
     * Form edit puzzle.
     */
    public function edit(Puzzle $puzzle)
    {
        return view('superadmin.puzzle.edit', compact('puzzle'));
    }

    /**
     * Update data puzzle.
     */
    public function update(Request $request, Puzzle $puzzle)
    {
        $validated = $request->validate([
            'level'         => ['required', 'integer', 'min:1', "unique:puzzle,level,{$puzzle->id}"],
            'pertanyaan'    => ['required', 'string'],
            'kode_snippet'  => ['nullable', 'string'],
            'opsi_a'        => ['required', 'string', 'max:500'],
            'opsi_b'        => ['required', 'string', 'max:500'],
            'opsi_c'        => ['required', 'string', 'max:500'],
            'opsi_d'        => ['required', 'string', 'max:500'],
            'jawaban_benar' => ['required', 'in:A,B,C,D'],
            'petunjuk'      => ['required', 'string'],
        ], [
            'level.unique'      => 'Level puzzle ini sudah dipakai oleh puzzle lain.',
            'jawaban_benar.in'  => 'Jawaban benar harus salah satu dari: A, B, C, atau D.',
        ]);

        $puzzle->update($validated);

        return redirect()
            ->route('superadmin.puzzle.index')
            ->with('success', "Puzzle Level {$puzzle->level} berhasil diperbarui!");
    }

    /**
     * Hapus puzzle.
     */
    public function destroy(Puzzle $puzzle)
    {
        $level = $puzzle->level;
        $puzzle->delete();

        return redirect()
            ->route('superadmin.puzzle.index')
            ->with('success', "Puzzle Level {$level} berhasil dihapus.");
    }
}

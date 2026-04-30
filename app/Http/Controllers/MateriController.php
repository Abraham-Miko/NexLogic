<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MateriVisibility;
use App\Models\StudentProgress;
use App\Models\Test; // Asumsi model untuk soal
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MateriController extends Controller
{
    // ────────────────────────────────────────────────────────────────────────────
    // INDEX – Halaman daftar semua materi
    // ────────────────────────────────────────────────────────────────────────────
    public function index(Request $request): View
    {
        $user  = Auth::user();
        $query = Materi::query()->orderBy('order_number');

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $materis = $query->with(['visibilities'])->get();

        $progressMap = collect();
        $visibilityMap = collect();
        $guruVisibilityMap = collect();

        if ($user->role === 'siswa') {
            $progressMap = StudentProgress::where('user_id', $user->id)->pluck(null, 'materi_id');
            // Siswa melihat materi yang dibuka oleh setidaknya satu guru
            $visibilityMap = MateriVisibility::where('is_locked', false)->pluck('materi_id')->unique();
        } else {
            // Guru & Superadmin melihat status lock (Superadmin melihat status default/global)
            $guruVisibilityMap = MateriVisibility::where('guru_id', $user->id)->pluck('is_locked', 'materi_id');
        }

        return view('materi.index', compact('materis', 'progressMap', 'visibilityMap', 'guruVisibilityMap'));
    }

    // ────────────────────────────────────────────────────────────────────────────
    // SHOW – Detail materi, Soal, & Rekap Skor
    // ────────────────────────────────────────────────────────────────────────────
    public function show(Materi $materi, Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        // Guard Siswa: Cek apakah terkunci
        if ($user->role === 'siswa') {
            $isOpen = MateriVisibility::where('materi_id', $materi->id)->where('is_locked', false)->exists();
            if (!$isOpen) {
                return redirect()->route('materi.index')->with('error', 'Materi terkunci.');
            }
        }

        $preTests  = $materi->preTests;
        $postTests = $materi->postTests;
        $progress  = StudentProgress::where('user_id', $user->id)->where('materi_id', $materi->id)->first();

        // Logika Tab Aktif
        $activeTab = $request->get('tab', 'pre_test');

        // Fitur: Rekap Skor (Hanya Guru & Superadmin)
        $allProgress = collect();
        if ($user->role === 'superadmin' || $user->role === 'guru') {
            $progressQuery = StudentProgress::with('user')->where('materi_id', $materi->id);

            // Guru hanya melihat skor Siswa & Guru
            if ($user->role === 'guru') {
                $progressQuery->whereHas('user', function($q) {
                    $q->whereIn('role', ['siswa', 'guru']);
                });
            }
            $allProgress = $progressQuery->get();
        }

        $isLockedByCurrentGuru = MateriVisibility::where('materi_id', $materi->id)
            ->where('guru_id', $user->id)->value('is_locked') ?? true;

        return view('materi.show', compact('materi', 'preTests', 'postTests', 'progress', 'activeTab', 'allProgress', 'isLockedByCurrentGuru'));
    }

    // UPDATE LEVEL – Ganti kesulitan (Guru & Superadmin)
    public function updateLevel(Request $request, Materi $materi): RedirectResponse
    {
        $user = Auth::user(); // Tambahkan baris ini

        if ($user->role === 'siswa') {
            abort(403, 'Siswa tidak diperbolehkan mengubah tingkat kesulitan.');
        }

        $materi->update([
            'level' => $request->level
        ]);

        return back()->with('success', 'Tingkat kesulitan berhasil diperbarui.');
    }

    // ────────────────────────────────────────────────────────────────────────────
    // KUNCI JAWABAN – Halaman Terpisah (Guru & Superadmin Only)
    // ────────────────────────────────────────────────────────────────────────────
    public function kunciJawaban(Materi $materi, string $type): View
    {
        $user = Auth::user(); // Tambahkan baris ini

        if ($user->role === 'siswa') {
            abort(403, 'Siswa tidak diperbolehkan melihat kunci jawaban.');
        }

        $soals = Test::where('materi_id', $materi->id)
                    ->where('type', $type)
                    ->get();

        return view('materi.kunci_jawaban', compact('materi', 'soals', 'type'));
    }

    // ────────────────────────────────────────────────────────────────────────────
    // CRUD MATERI (Super Admin Only)
    // ────────────────────────────────────────────────────────────────────────────
    public function store(Request $request) { /* Sama seperti sebelumnya, restricted to superadmin */ }

    public function update(Request $request, Materi $materi) { /* Restricted to superadmin */ }

    public function destroy(Materi $materi) { /* Restricted to superadmin */ }

    // ────────────────────────────────────────────────────────────────────────────
    // TOGGLE LOCK – (Guru & Superadmin)
    // ────────────────────────────────────────────────────────────────────────────
    public function toggleLock(Materi $materi): RedirectResponse
    {
        if (Auth::user()->role === 'siswa') abort(403);

        $visibility = MateriVisibility::firstOrCreate(
            ['materi_id' => $materi->id, 'guru_id' => Auth::id()],
            ['is_locked' => true]
        );

        $visibility->update(['is_locked' => !$visibility->is_locked]);
        return back()->with('success', 'Status kunci materi berhasil diubah.');
    }
}

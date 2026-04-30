<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\StudentProgress;
use App\Models\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    // ────────────────────────────────────────────────────────────────────────────
    // STORE  –  Guru membuat soal baru
    // ────────────────────────────────────────────────────────────────────────────

    public function store(Request $request, Materi $materi): RedirectResponse
    {
        $user = Auth::user();

        if ($user->roles !== 'guru') {
            abort(403, 'Hanya Guru yang bisa membuat soal.');
        }

        $validated = $request->validate([
            'type'           => 'required|in:pre_test,post_test',
            'question'       => 'required|string',
            'option_a'       => 'required|string|max:255',
            'option_b'       => 'required|string|max:255',
            'option_c'       => 'required|string|max:255',
            'option_d'       => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        Test::create([
            'materi_id'      => $materi->id,
            'guru_id'        => $user->id,
            'type'           => $validated['type'],
            'question'       => $validated['question'],
            'options'        => [
                'A' => $validated['option_a'],
                'B' => $validated['option_b'],
                'C' => $validated['option_c'],
                'D' => $validated['option_d'],
            ],
            'correct_answer' => $validated['correct_answer'],
        ]);

        $tab = $validated['type'] === 'pre_test' ? 'pre_test' : 'post_test';

        return redirect()->route('materi.show', $materi)
            ->with('success', 'Soal berhasil ditambahkan!')
            ->with('tab', $tab);
    }

    // ────────────────────────────────────────────────────────────────────────────
    // UPDATE  –  Guru mengedit soal
    // ────────────────────────────────────────────────────────────────────────────

    public function update(Request $request, Test $test): RedirectResponse
    {
        $user = Auth::user();

        if ($user->roles !== 'guru' || $test->guru_id !== $user->id) {
            abort(403, 'Kamu tidak berhak mengedit soal ini.');
        }

        $validated = $request->validate([
            'question'       => 'required|string',
            'option_a'       => 'required|string|max:255',
            'option_b'       => 'required|string|max:255',
            'option_c'       => 'required|string|max:255',
            'option_d'       => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $test->update([
            'question'       => $validated['question'],
            'options'        => [
                'A' => $validated['option_a'],
                'B' => $validated['option_b'],
                'C' => $validated['option_c'],
                'D' => $validated['option_d'],
            ],
            'correct_answer' => $validated['correct_answer'],
        ]);

        $tab = $test->type === 'pre_test' ? 'pre_test' : 'post_test';

        return redirect()->route('materi.show', $test->materi_id)
            ->with('success', 'Soal berhasil diperbarui!')
            ->with('tab', $tab);
    }

    // ────────────────────────────────────────────────────────────────────────────
    // DESTROY  –  Guru menghapus soal
    // ────────────────────────────────────────────────────────────────────────────

    public function destroy(Test $test): RedirectResponse
    {
        $user = Auth::user();

        if ($user->roles !== 'guru' || $test->guru_id !== $user->id) {
            abort(403, 'Kamu tidak berhak menghapus soal ini.');
        }

        $materiId = $test->materi_id;
        $tab      = $test->type === 'pre_test' ? 'pre_test' : 'post_test';

        $test->delete();

        return redirect()->route('materi.show', $materiId)
            ->with('success', 'Soal berhasil dihapus.')
            ->with('tab', $tab);
    }

    // ────────────────────────────────────────────────────────────────────────────
    // SUBMIT  –  Siswa mengumpulkan jawaban test
    // ────────────────────────────────────────────────────────────────────────────

    public function submit(Request $request, Materi $materi): RedirectResponse
    {
        $user = Auth::user();

        if ($user->roles !== 'siswa') {
            abort(403);
        }

        $type = $request->validate(['type' => 'required|in:pre_test,post_test'])['type'];

        // Ambil soal sesuai tipe
        $tests = Test::where('materi_id', $materi->id)
            ->where('type', $type)
            ->get();

        if ($tests->isEmpty()) {
            return back()->with('error', 'Tidak ada soal yang tersedia.');
        }

        // Hitung skor
        $correct = 0;
        foreach ($tests as $test) {
            $jawaban = $request->input('jawaban_' . $test->id);
            if ($jawaban === $test->correct_answer) {
                $correct++;
            }
        }

        $score = (int) round(($correct / $tests->count()) * 100);

        // Update atau buat record progres
        $progress = StudentProgress::firstOrCreate(
            ['user_id' => $user->id, 'materi_id' => $materi->id]
        );

        if ($type === 'pre_test') {
            // Pre-test: hanya simpan jika belum pernah dikerjakan
            if (! $progress->hasPreTest()) {
                $progress->update([
                    'pre_test_score'      => $score,
                    'progress_percentage' => 33,
                ]);
            }
            return redirect()->route('materi.show', $materi)
                ->with('success', "Pre-test selesai! Skor kamu: {$score}/100. Sekarang baca materinya.")
                ->with('tab', 'materi');
        }

        if ($type === 'post_test') {
            // Post-test: hanya bisa dikerjakan jika sudah baca materi (progress >= 66)
            if ($progress->progress_percentage < 66) {
                return back()->with('error', 'Kamu harus membaca materi terlebih dahulu.');
            }

            $stars = StudentProgress::calculateStars($score);

            $progress->update([
                'post_test_score'     => $score,
                'progress_percentage' => 100,
                'stars'               => $stars,
                'is_completed'        => true,
            ]);

            return redirect()->route('materi.show', $materi)
                ->with('success', "Post-test selesai! Skor: {$score}/100. Kamu mendapat {$stars} bintang! 🎉")
                ->with('tab', 'post_test');
        }

        return back();
    }
}

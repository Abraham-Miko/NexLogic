<?php

use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ── Semua route membutuhkan autentikasi ──
Route::middleware('auth')->group(function () {

    // ── AKSES SEMUA ROLE ──
    // Siswa, Guru, & Super Admin bisa melihat daftar & isi materi
    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/{materi}', [MateriController::class, 'show'])->name('materi.show');

    // ── KHUSUS SUPER ADMIN ──
    // Sesuai UI index.blade.php: Menambah, mengedit, dan menghapus materi
    Route::middleware(['role:superadmin'])->group(function () {
        Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');
        Route::put('/materi/{materi}', [MateriController::class, 'update'])->name('materi.update');
        Route::delete('/materi/{materi}', [MateriController::class, 'destroy'])->name('materi.destroy');
        Route::post('/materi/{materi}/toggle-lock', [MateriController::class, 'toggleLock'])->name('materi.toggle-lock');
        Route::post('/materi/{materi}/tests', [TestController::class, 'store'])->name('tests.store');
        Route::put('/tests/{test}', [TestController::class, 'update'])->name('tests.update');
        Route::delete('/tests/{test}', [TestController::class, 'destroy'])->name('tests.destroy');
        Route::post('/materi/{materi}/mark-read', [MateriController::class, 'markRead'])->name('materi.mark-read');
        Route::post('/materi/{materi}/tests/submit', [TestController::class, 'submit'])->name('tests.submit');
        Route::patch('/materi/{materi}/update-level', [MateriController::class, 'updateLevel'])
            ->name('materi.update-level');
        Route::get('/materi/{materi}/kunci-jawaban/{type}', [MateriController::class, 'kunciJawaban'])
            ->name('materi.kunci-jawaban');
    });

    // ── KHUSUS GURU ──
    // Sesuai UI show.blade.php: Toggle lock materi & kelola soal (CRUD Test)[cite: 2]
    Route::middleware(['role:guru'])->group(function () {
        Route::post('/materi/{materi}/toggle-lock', [MateriController::class, 'toggleLock'])->name('materi.toggle-lock');
        Route::post('/materi/{materi}/tests', [TestController::class, 'store'])->name('tests.store');
        Route::put('/tests/{test}', [TestController::class, 'update'])->name('tests.update');
        Route::delete('/tests/{test}', [TestController::class, 'destroy'])->name('tests.destroy');
        Route::post('/materi/{materi}/mark-read', [MateriController::class, 'markRead'])->name('materi.mark-read');
        Route::post('/materi/{materi}/tests/submit', [TestController::class, 'submit'])->name('tests.submit');
        Route::patch('/materi/{materi}/update-level', [MateriController::class, 'updateLevel'])
            ->name('materi.update-level');
        Route::get('/materi/{materi}/kunci-jawaban/{type}', [MateriController::class, 'kunciJawaban'])
            ->name('materi.kunci-jawaban');
    });

    // ── KHUSUS SISWA ──
    // Sesuai UI show.blade.php: Submit jawaban & tandai sudah baca[cite: 2]
    Route::middleware(['role:siswa'])->group(function () {
        Route::post('/materi/{materi}/mark-read', [MateriController::class, 'markRead'])->name('materi.mark-read');
        Route::post('/materi/{materi}/tests/submit', [TestController::class, 'submit'])->name('tests.submit');
    });

});

require __DIR__.'/auth.php';

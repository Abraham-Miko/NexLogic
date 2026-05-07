<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\SubWilayahController;
use App\Http\Controllers\SuperAdminPuzzleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $total_siswa = \App\Models\User::where('role', 'siswa')->count();
    $total_kelas = \App\Models\SubWilayah::count();
    $total_soal = \App\Models\BankSoal::count();
    return view('welcome', compact('total_siswa', 'total_kelas', 'total_soal'));
})->name('/');

Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    if ($role === 'super_admin') {
        // Arahkan ke rute khusus super admin
        return redirect()->route('superadmin.dashboard');
    } else if($role === 'guru') {
        return redirect()->route('guru.dashboard');
    }

    // Jika user biasa, tampilkan view dashboard biasa
    return redirect()->route('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'indexSiswa'])->name('dashboard')->middleware('auth');
Route::get('/courses', [PuzzleController::class, 'courses'])->name('courses')->middleware('auth');

Route::get('/courses/{id}', function ($id) {
    $user = auth()->user();
    $subWilayahId = $user->sub_wilayah_id;

    // Ambil bank soal pre-test dan post-test untuk materi ini
    $preTestQuestions = \App\Models\BankSoal::where('sub_wilayah_id', $subWilayahId)
                                           ->where('materi_ke', $id)
                                           ->where('jenis_soal', 'pre_test')
                                           ->get();

    $postTestQuestions = \App\Models\BankSoal::where('sub_wilayah_id', $subWilayahId)
                                            ->where('materi_ke', $id)
                                            ->where('jenis_soal', 'post_test')
                                            ->get();

    // 1. Map JUDUL materi
    $judulMap = [
        1 => 'Variabel & Tipe Data',
        2 => 'Operator & Ekspresi',
        3 => 'Input & Output',
        4 => 'Percabangan (If/Else)',
        5 => 'Perulangan (Looping)',
        6 => 'Fungsi & Parameter'
    ];

    // Map judul materi ke array sub-topik
    $topicsMap = [
        1 => ['Pengenalan Variabel', 'Tipe Data Dasar', 'Cara Deklarasi', 'Contoh Penggunaan'],
        2 => ['Pengertian Operator', 'Operator Matematika', 'Operator Logika', 'Operator Perbandingan'],
        3 => ['Pengertian I/O', 'Menampilkan Teks ke Layar', 'Menerima Input Pengguna', 'Format Penggabungan Teks'],
        4 => ['Pengertian If', 'Percabangan If', 'If-Else', 'Nested If'],
        5 => ['Pengertian Perulangan', 'Perulangan For', 'Perulangan While', 'Break & Continue'],
        6 => ['Pengenalan Fungsi', 'Parameter', 'Return Value']
    ];

    $judul_materi = $judulMap[$id] ?? 'Materi ' . $id;
    $materiTopics = $topicsMap[$id] ?? ['Sub-Topik 1', 'Sub-Topik 2'];

    // Cek status pengerjaan kuis siswa
    $penilaian = \App\Models\Penilaian::where('siswa_id', $user->id)
                                      ->where('sub_wilayah_id', $subWilayahId)
                                      ->where('materi_ke', $id)
                                      ->first();

    $skorPre = $penilaian ? $penilaian->skor_pre : null;
    $skorPost = $penilaian ? $penilaian->skor_post : null;

    return view('siswa.courses.show', compact('id', 'preTestQuestions', 'postTestQuestions', 'materiTopics', 'skorPre', 'skorPost', 'judul_materi'));
})->middleware(['auth', 'verified'])->name('courses.show');

Route::post('/courses/{id}/submit-test', function (\Illuminate\Http\Request $request, $id) {
    $user = auth()->user();
    $subWilayahId = $user->sub_wilayah_id;
    $type = $request->input('type'); // 'pre_test' atau 'post_test'
    $answers = $request->input('answers', []);

    // Cek apakah sudah pernah mengerjakan
    $penilaian = \App\Models\Penilaian::where('siswa_id', $user->id)
                                      ->where('sub_wilayah_id', $subWilayahId)
                                      ->where('materi_ke', $id)
                                      ->first();

    if ($penilaian) {
        if ($type === 'pre_test' && !is_null($penilaian->skor_pre)) {
            return response()->json(['error' => 'Anda sudah mengerjakan pre-test ini.'], 403);
        }
        if ($type === 'post_test' && !is_null($penilaian->skor_post)) {
            return response()->json(['error' => 'Anda sudah mengerjakan post-test ini.'], 403);
        }
    }

    // Ambil soal
    $questions = \App\Models\BankSoal::where('sub_wilayah_id', $subWilayahId)
                                     ->where('materi_ke', $id)
                                     ->where('jenis_soal', $type)
                                     ->get();

    if ($questions->isEmpty()) {
        return response()->json(['error' => 'Soal tidak ditemukan.'], 404);
    }

    $correctCount = 0;
    foreach ($questions as $q) {
        $userAnswer = $answers[$q->id] ?? null;
        if ($userAnswer === $q->jawaban_benar) {
            $correctCount++;
        }
    }

    $score = round(($correctCount / $questions->count()) * 100);

    // Simpan ke penilaian
    if (!$penilaian) {
        $penilaian = new \App\Models\Penilaian();
        $penilaian->siswa_id = $user->id;
        $penilaian->sub_wilayah_id = $subWilayahId;
        $penilaian->materi_ke = $id;
    }

    if ($type === 'pre_test') {
        $penilaian->skor_pre = $score;
    } else {
        $penilaian->skor_post = $score;
    }

    $penilaian->save();

    return response()->json([
        'success' => true,
        'score' => $score
    ]);
})->middleware(['auth', 'verified'])->name('courses.submit_test');

Route::post('/siswa/join-kelas', function (\Illuminate\Http\Request $request) {
    $request->validate(['kode_sub_wilayah' => 'required|string']);

    $subWilayah = \App\Models\SubWilayah::where('kode_sub_wilayah', strtoupper($request->kode_sub_wilayah))->first();

    if (!$subWilayah) {
        return back()->with('error', 'Kode kelas tidak ditemukan!');
    }

    $user = auth()->user();
    $user->sub_wilayah_id = $subWilayah->id;
    $user->save();

    return redirect()->route('dashboard')->with('success', 'Berhasil bergabung dengan kelas ' . $subWilayah->nama_sub_wilayah);
})->middleware(['auth', 'verified'])->name('siswa.join_kelas');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('superadmin')->name('superadmin.')->middleware(['auth', 'role:super_admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // --- MANAJEMEN SISWA ---
    Route::get('/siswa', [UserController::class, 'indexSiswa'])->name('siswa');
    Route::get('/siswa/create', [UserController::class, 'createSiswa'])->name('siswa.create');
    Route::post('/siswa', [UserController::class, 'storeSiswa'])->name('siswa.store');
    Route::get('/siswa/{id}/edit', [UserController::class, 'editSiswa'])->name('siswa.edit');
    Route::put('/siswa/{id}', [UserController::class, 'updateSiswa'])->name('siswa.update');
    Route::delete('/siswa/{id}', [UserController::class, 'destroySiswa'])->name('siswa.destroy');
    Route::get('/siswa/download-template', [UserController::class, 'downloadTemplateSiswa'])->name('siswa.template');
    Route::post('/siswa/import', [UserController::class, 'importSiswa'])->name('siswa.import');

    //  --- MANAJEMEN GURU ---
    Route::get('/guru', [UserController::class, 'indexGuru'])->name('guru');
    Route::get('/guru/create', [UserController::class, 'createGuru'])->name('guru.create');
    Route::post('/guru', [UserController::class, 'storeGuru'])->name('guru.store');
    Route::get('/guru/{id}/edit', [UserController::class, 'editGuru'])->name('guru.edit');
    Route::put('/guru/{id}', [UserController::class, 'updateGuru'])->name('guru.update');
    Route::delete('/guru/{id}', [UserController::class, 'destroyGuru'])->name('guru.destroy');
    Route::get('/guru/download-template', [UserController::class, 'downloadTemplateGuru'])->name('guru.template');
    Route::post('/guru/import', [UserController::class, 'importGuru'])->name('guru.import');

    // Rute Wilayah
    Route::get('/wilayah', [WilayahController::class, 'index'])->name('wilayah');
    Route::post('/wilayah', [WilayahController::class, 'store'])->name('wilayah.store');
    Route::put('/wilayah/{id}', [WilayahController::class, 'update'])->name('wilayah.update');
    Route::delete('/wilayah/{id}', [WilayahController::class, 'destroy'])->name('wilayah.destroy');

    // Rute Sub Wilayah (Detail)
    Route::get('/wilayah/{id}', [WilayahController::class, 'show'])->name('wilayah.show');
    Route::post('/sub-wilayah', [SubWilayahController::class, 'store'])->name('subwilayah.store');
    Route::put('/sub-wilayah/{id}', [SubWilayahController::class, 'update'])->name('subwilayah.update');
    Route::delete('/sub-wilayah/{id}', [SubWilayahController::class, 'destroy'])->name('subwilayah.destroy');
    Route::get('/sub-wilayah/{id}', [SubWilayahController::class, 'show'])->name('subwilayah.show');
    Route::post('/sub-wilayah/{id}/assign-siswa', [SubWilayahController::class, 'assignSiswa'])->name('subwilayah.assign_siswa');
    Route::post('/sub-wilayah/remove-siswa/{siswa_id}', [SubWilayahController::class, 'removeSiswa'])->name('subwilayah.remove_siswa');
});

Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('dashboard');
    Route::post('/wilayah/join', [GuruController::class, 'joinWilayah']);
    Route::get('/subwilayah/create', [GuruController::class, 'createSubwilayah'])->name('subwilayah.create');
    Route::post('/subwilayah/store', [GuruController::class, 'storeSubwilayah'])->name('subwilayah.store');
    Route::get('/subwilayah/{id}', [GuruController::class, 'show'])->name('subwilayah.show');
    Route::post('/subwilayah/{id}/tambah-siswa', [GuruController::class, 'tambahSiswaManual'])->name('subwilayah.show');
    Route::post('/subwilayah/{id}/assign-siswa', [GuruController::class, 'assignSiswa'])->name('subwilayah.assign_siswa');
    Route::delete('/subwilayah/{id}/keluarkan-siswa/{siswa_id}', [GuruController::class, 'hapusSiswa'])->name('subwilayah.removeSiswa');

    // Content Manager
    Route::get('/content', [GuruController::class, 'contentManager'])->name('content');
    Route::get('/content/kelas/{sub_wilayah_id}', [GuruController::class, 'contentKelas'])->name('content.kelas');
    Route::post('/content/soal', [GuruController::class, 'storeSoal'])->name('content.soal.store');
    Route::get('/content/soal/{sub_wilayah_id}/{materi_ke}/{jenis_soal}', [GuruController::class, 'getSoal'])->name('content.soal.get');
    Route::delete('/content/soal/{id}', [GuruController::class, 'deleteSoal'])->name('content.soal.delete');
    Route::post('/content/toggle', [GuruController::class, 'toggleMateri'])->name('content.toggle');
    Route::get('/content/copy-options/{materi_ke}/{jenis_soal}', [GuruController::class, 'getCopyOptions'])->name('content.copy.options');
    Route::post('/content/copy-soal', [GuruController::class, 'copySoal'])->name('content.copy.store');
});

Route::middleware('auth')->group(function () {
    // Route untuk menampilkan halaman profil (sesuaikan nama view/jalurnya jika berbeda)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

    // Route untuk memproses update profil (Ini yang dipanggil di action form kamu)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
// --- Route Fitur Puzzle (NexLogic - Siswa/Umum) ---
Route::middleware(['auth', 'verified'])->prefix('puzzle')->name('puzzle.')->group(function () {
    Route::get('/', function() {
        $user_id = auth()->id();
        $total_skor = \App\Models\Penilaian::totalSkorPuzzle($user_id);

        $penilaian = \App\Models\Penilaian::where('siswa_id', $user_id)->get();
        $completed_materi = $penilaian->whereNotNull('skor_puzzle')->pluck('materi_ke')->toArray();
        $unlocked_materi = $penilaian->whereNotNull('skor_pre')->whereNotNull('skor_post')->pluck('materi_ke')->toArray();

        return view('siswa.puzzle.index', compact('total_skor', 'completed_materi', 'unlocked_materi'));
    })->name('index');

    Route::get('/materi/{id}', function($id) {
        return view('siswa.puzzle.puzzle_materi' . $id, ['materi_id' => $id]);
    })->name('materi.show');

    Route::post('/materi/{id}/submit', function (\Illuminate\Http\Request $request, $id) {
        $request->validate(['skor_total' => 'required|numeric|min:0|max:500']);
        $user = auth()->user();
        \App\Models\Penilaian::updateOrCreate(
            [
                'siswa_id' => $user->id,
                'sub_wilayah_id' => $user->sub_wilayah_id,
                'materi_ke' => $id
            ],
            [
                'skor_puzzle' => $request->skor_total
            ]
        );
        return redirect()->route('puzzle.index')->with('success', 'Puzzle Materi ' . $id . ' Selesai! Skor berhasil disimpan!');
    })->name('materi.submit');
    Route::get('/{puzzle}', [PuzzleController::class, 'show'])->name('show');
    Route::post('/{puzzle}/jawab', [PuzzleController::class, 'jawab'])->name('jawab');
});

// --- Route Manajemen Puzzle (NexLogic - Super Admin) ---
Route::middleware(['auth', 'verified', 'role:super_admin'])->prefix('superadmin/puzzle')->name('superadmin.puzzle.')->group(function () {
    Route::get('/', [SuperAdminPuzzleController::class, 'index'])->name('index');
    Route::get('/create', [SuperAdminPuzzleController::class, 'create'])->name('create');
    Route::post('/', [SuperAdminPuzzleController::class, 'store'])->name('store');
    Route::get('/{puzzle}/edit', [SuperAdminPuzzleController::class, 'edit'])->name('edit');
    Route::put('/{puzzle}', [SuperAdminPuzzleController::class, 'update'])->name('update');
    Route::delete('/{puzzle}', [SuperAdminPuzzleController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';

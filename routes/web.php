<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\SubWilayahController;
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

Route::prefix('superadmin')->name('superadmin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('dashboard');
    // --- MANAJEMEN SISWA ---
    Route::get('/siswa', [UserController::class, 'indexSiswa'])->name('siswa');
    Route::get('/siswa/create', [UserController::class, 'createSiswa'])->name('siswa.create');
    Route::post('/siswa', [UserController::class, 'storeSiswa'])->name('siswa.store');
    Route::get('/siswa/{id}/edit', [UserController::class, 'editSiswa'])->name('siswa.edit');
    Route::put('/siswa/{id}', [UserController::class, 'updateSiswa'])->name('siswa.update');
    Route::delete('/siswa/{id}', [UserController::class, 'destroySiswa'])->name('siswa.destroy');

    //  --- MANAJEMEN GURU ---
    Route::get('/guru', [UserController::class, 'indexGuru'])->name('guru');
    Route::get('/guru/create', [UserController::class, 'createGuru'])->name('guru.create');
    Route::post('/guru', [UserController::class, 'storeGuru'])->name('guru.store');
    Route::get('/guru/{id}/edit', [UserController::class, 'editGuru'])->name('guru.edit');
    Route::put('/guru/{id}', [UserController::class, 'updateGuru'])->name('guru.update');
    Route::delete('/guru/{id}', [UserController::class, 'destroyGuru'])->name('guru.destroy');

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

Route::middleware('auth')->group(function () {
    // Route untuk menampilkan halaman profil (sesuaikan nama view/jalurnya jika berbeda)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route untuk memproses update profil (Ini yang dipanggil di action form kamu)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route untuk memproses update password (jika kamu nanti membuat logic passwordnya)
    // Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

require __DIR__.'/auth.php';

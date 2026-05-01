<?php

use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    // Route untuk menampilkan halaman profil (sesuaikan nama view/jalurnya jika berbeda)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route untuk memproses update profil (Ini yang dipanggil di action form kamu)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route untuk memproses update password (jika kamu nanti membuat logic passwordnya)
    // Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

require __DIR__.'/auth.php';

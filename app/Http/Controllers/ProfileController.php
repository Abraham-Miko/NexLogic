<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     * (Asumsi kamu sudah punya method ini untuk merender edit.blade.php)
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memproses update informasi profil user.
     */
    public function update(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            // Validasi jenis_kelamin menyesuaikan dengan enum di migration ('L', 'P')
            'jenis_kelamin' => ['nullable', 'in:L,P'],
        ], [
            // Kustomisasi pesan error (opsional)
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.'
        ]);

        // 2. Ambil data user yang sedang login
        $user = $request->user();

        // 3. Update field yang diizinkan (nomor_induk diabaikan karena disabled di form)
        $user->nama = $request->nama;
        $user->jenis_kelamin = $request->jenis_kelamin;

        // 4. Simpan ke database
        $user->save();

        // 5. Redirect kembali ke halaman sebelumnya dengan membawa session 'status'
        // Ini akan men-trigger notifikasi flash-success "Profil berhasil diperbarui" di view-mu
        return Redirect::back()->with('status', 'profile-updated');
    }
}

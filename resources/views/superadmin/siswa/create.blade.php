@extends('layouts.superadmin')

@section('content')
<div class="p-8">
    <div class="max-w-5xl mx-auto">

        <!-- Bagian Header & Tombol Kembali -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('superadmin.siswa') }}" class="p-2 bg-[#1e243b] hover:bg-slate-700 border border-slate-600 rounded-lg text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-white mb-1">Tambah Siswa Baru</h2>
                <p class="text-sm text-gray-400">Masukkan identitas dan kredensial login untuk siswa.</p>
            </div>
        </div>

        <!-- Form Create -->
        <form action="{{ route('superadmin.siswa.store') }}" method="POST">
            @csrf <!-- Wajib ada di setiap form Laravel -->

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- KOLOM KIRI: Data Personal (Lebar 2/3) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-slate-700 pb-2">Informasi Personal</h3>

                        <div class="space-y-4">
                            <!-- Input Nama Lengkap -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" required
                                       class="w-full bg-[#111827] border @error('nama') border-red-500 @else border-slate-600 @enderror text-white rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Input NISN -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">NISN / Nomor Induk <span class="text-red-500">*</span></label>
                                <input type="text" name="nomor_induk" value="{{ old('nomor_induk') }}" placeholder="Contoh: 0041234567" required
                                       class="w-full bg-[#111827] border @error('nomor_induk') border-red-500 @else border-slate-600 @enderror text-white rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                                @error('nomor_induk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Input Jenis Kelamin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Jenis Kelamin</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 text-gray-300 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 bg-[#111827] border-slate-600">
                                        Laki-laki
                                    </label>
                                    <label class="flex items-center gap-2 text-gray-300 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 bg-[#111827] border-slate-600">
                                        Perempuan
                                    </label>
                                </div>
                                @error('jenis_kelamin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: Akun & Status (Lebar 1/3) -->
                <div class="space-y-6">
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-slate-700 pb-2">Pengaturan Akun</h3>

                        <div class="space-y-4">
                            <!-- Input Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Password <span class="text-red-500">*</span></label>
                                <input type="password" name="password" placeholder="Minimal 6 karakter" required
                                       class="w-full bg-[#111827] border @error('password') border-red-500 @else border-slate-600 @enderror text-white rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Input Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Status Akun</label>
                                <select name="status" required class="w-full bg-[#111827] border border-slate-600 text-white rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                                    <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>🔴 Tidak Aktif</option>
                                </select>
                                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-xl transition-colors shadow-lg shadow-indigo-500/20 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Data Siswa
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection

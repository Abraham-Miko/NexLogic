@extends('layouts.superadmin')

@section('content')
<div class="p-8">
    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('superadmin.siswa') }}" class="p-2 bg-[#1e243b] hover:bg-slate-700 border border-slate-600 rounded-lg text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-white mb-1">Edit Data Siswa</h2>
                <p class="text-sm text-gray-400">Memperbarui informasi untuk: <span class="text-indigo-400 font-medium">{{ $siswa->nama }}</span></p>
            </div>
        </div>

        <form action="{{ route('superadmin.siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Wajib untuk proses Update di Laravel -->

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- KOLOM KIRI: Data Personal -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-slate-700 pb-2">Informasi Personal</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <!-- Tampilkan old() terlebih dahulu, jika tidak ada, tampilkan data dari database -->
                                <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" required
                                       class="w-full bg-[#111827] border @error('nama') border-red-500 @else border-slate-600 @enderror text-white rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">NISN / Nomor Induk <span class="text-red-500">*</span></label>
                                <input type="text" name="nomor_induk" value="{{ old('nomor_induk', $siswa->nomor_induk) }}" required
                                       class="w-full bg-[#111827] border @error('nomor_induk') border-red-500 @else border-slate-600 @enderror text-white rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                                @error('nomor_induk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Jenis Kelamin</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 text-gray-300 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'checked' : '' }} class="text-indigo-600 bg-[#111827] border-slate-600"> Laki-laki
                                    </label>
                                    <label class="flex items-center gap-2 text-gray-300 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'checked' : '' }} class="text-indigo-600 bg-[#111827] border-slate-600"> Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: Akun & Status -->
                <div class="space-y-6">
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-slate-700 pb-2">Pengaturan Akun</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Password Baru</label>
                                <!-- Kosongkan valuenya agar password lama tidak terlihat -->
                                <input type="password" name="password" placeholder="Kosongkan jika tak diubah"
                                       class="w-full bg-[#111827] border @error('password') border-red-500 @else border-slate-600 @enderror text-white rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                                <p class="text-xs text-gray-500 mt-1">Hanya isi jika ingin mereset password siswa.</p>
                                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Status Akun</label>
                                <select name="status" required class="w-full bg-[#111827] border border-slate-600 text-white rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                                    <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                                    <option value="tidak_aktif" {{ old('status', $siswa->status) == 'tidak_aktif' ? 'selected' : '' }}>🔴 Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-xl transition-colors shadow-lg shadow-indigo-500/20 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Update Data Siswa
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection

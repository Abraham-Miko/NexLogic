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
        <!-- Tombol Import Data (Primary Outline) -->
        <button onclick="openModal('modal-import-siswa')"
        class="flex items-center justify-center gap-2 bg-[#1e243b] border border-indigo-500/50 hover:bg-indigo-500/10 text-indigo-400 text-sm font-medium px-5 py-2.5 rounded-lg transition-colors w-full md:w-auto">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            Import Excel
        </button>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL IMPORT EXCEL -->
<!-- ========================================== -->
<div id="modal-import-siswa" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="relative bg-[#1e243b] border border-slate-600 rounded-2xl shadow-2xl">
            <div class="flex items-center justify-between p-5 border-b border-slate-600/60 rounded-t-2xl">
                <h3 class="text-xl font-bold text-white">Import Data Siswa</h3>
                <button type="button" onclick="closeModal('modal-import-siswa')" class="text-gray-400 bg-transparent hover:bg-slate-700 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>

            <form action="{{ route('superadmin.siswa.import') }}" method="POST" enctype="multipart/form-data" class="p-5">
                @csrf
                <div class="space-y-4">
                    <div class="p-4 mb-4 text-sm text-indigo-400 rounded-lg bg-indigo-900/20 border border-indigo-500/30" role="alert">
                        <span class="font-medium">Catatan:</span> Pastikan Anda sudah mengunduh dan mengisi data sesuai dengan Template Excel.
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-300" for="file_excel">Upload File Excel</label>
                        <input class="block w-full text-sm text-gray-400 border border-slate-600 rounded-lg cursor-pointer bg-[#111827] focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition-all" id="file_excel" name="file_excel" type="file" accept=".xlsx, .xls, .csv" required>
                        <p class="mt-1 text-xs text-gray-500">Format yang didukung: .xlsx, .xls, .csv</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t border-slate-600/60">
                    <button type="button" onclick="closeModal('modal-import-siswa')" class="text-gray-300 hover:bg-slate-700 rounded-lg text-sm px-5 py-2.5">Batal</button>
                    <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm px-5 py-2.5 flex items-center gap-2">
                        Upload & Proses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
@endsection

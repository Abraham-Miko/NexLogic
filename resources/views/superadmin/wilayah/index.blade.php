@extends('layouts.superadmin')

@section('content')
<div class="p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-white mb-1">Manajemen Wilayah</h2>
                <p class="text-sm text-gray-400">Kelola data Angkatan beserta daftar Kelas (Sub Wilayah) di dalamnya.</p>
            </div>

            <button class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow-lg shadow-green-500/20" onclick="openModal('modal-create')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Wilayah Baru
            </button>
        </div>

        <!-- Daftar Wilayah (Card Memanjang) -->
        <div class="flex flex-col gap-4">
            @forelse($wilayahs as $w)
            <!-- Card Wrapper -->
            <div class="group bg-[#1e243b] border border-slate-600 hover:border-indigo-500 rounded-xl p-5 flex flex-col lg:flex-row items-center justify-between transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/10 relative overflow-hidden">

                <!-- Efek Garis Kiri saat di-hover -->
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- Bagian Kiri: Info Utama (Nama & Kode) -->
                <div class="flex items-center gap-5 w-full lg:w-2/5 mb-4 lg:mb-0 pl-2">
                    <div class="w-14 h-14 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-400 border border-indigo-500/20 shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <!-- Judul bisa diklik nanti untuk masuk ke detail -->
                        <h3 class="text-xl font-bold text-white group-hover:text-indigo-400 transition cursor-pointer">
                            {{ $w->nama_wilayah }}
                        </h3>
                        <div class="flex items-center gap-3 mt-1.5">
                            <span class="px-2.5 py-0.5 rounded bg-slate-700/50 text-xs font-mono text-gray-300 border border-slate-600">
                                {{ $w->kode_wilayah }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Bagian Tengah: Statistik -->
                <div class="flex items-center gap-8 w-full lg:w-1/3 mb-4 lg:mb-0 lg:border-x border-slate-600/50 py-2 lg:px-8">
                    <div class="flex flex-col">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-2xl font-bold text-white">{{ $w->sub_wilayahs_count }}</span>
                            <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">Sub Wilayah</span>
                        </div>
                    </div>

                    <div class="w-px h-8 bg-slate-600/50 hidden md:block"></div>

                    <div class="flex flex-col">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-2xl font-bold text-white">{{ $w->users_count }}</span>
                            <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">Siswa</span>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan: Aksi (Lihat, Edit, Hapus) -->
                <div class="flex items-center justify-end w-full lg:w-auto gap-2">
                    <button class="bg-indigo-500/10 hover:bg-indigo-500 text-indigo-400 hover:text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                        <a href="{{ route('superadmin.wilayah.show', $w->id) }}" class="...">Masuk Sub Wilayah</a>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>

                    <div class="w-px h-6 bg-slate-600 mx-2 hidden sm:block"></div>

                    <button onclick="openEditModal({{ $w->id }}, '{{ $w->nama_wilayah }}', '{{ $w->kode_wilayah }}')" class="p-2 text-gray-400 hover:text-amber-400 hover:bg-amber-400/10 rounded-lg transition" title="Edit Data">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button onclick="openDeleteModal({{ $w->id }})" class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-400/10 rounded-lg transition" title="Hapus Data">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>

            </div>
            @empty
            <!-- TAMPILAN JIKA BELUM ADA WILAYAH SAMA SEKALI -->
                <div class="w-full border-2 border-dashed border-slate-600/60 rounded-2xl p-12 flex flex-col items-center justify-center text-center bg-[#1e243b]/50">
                    <div class="w-20 h-20 bg-indigo-500/10 rounded-full flex items-center justify-center mb-5 border border-indigo-500/20">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Data Wilayah</h3>
                    <p class="text-gray-400 max-w-md mx-auto mb-6">Sistem saat ini belum memiliki data Angkatan/Wilayah. Silakan buat wilayah pertama Anda untuk mulai menambahkan guru dan siswa.</p>

                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-lg flex items-center gap-2 transition-colors shadow-lg shadow-indigo-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Wilayah Pertama
                    </button>
                </div>
            @endforelse
        </div>

    </div>
</div>

<!-- ========================================== -->
<!-- MODAL TAMBAH WILAYAH -->
<!-- ========================================== -->
<div id="modal-create" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm transition-opacity duration-300">
    <!-- Modal Container -->
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <!-- Modal Content -->
        <div class="relative bg-[#1e243b] border border-slate-600 rounded-2xl shadow-2xl">

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-5 border-b border-slate-600/60 rounded-t-2xl">
                <h3 class="text-xl font-bold text-white">
                    Tambah Wilayah Baru
                </h3>
                <button type="button" onclick="closeModal('modal-create')" class="text-gray-400 bg-transparent hover:bg-slate-700 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>

            <!-- Modal Body (Form) -->
            <!-- Nanti action form ini akan diarahkan ke route store -->
            <form action="{{ route('superadmin.wilayah.store') }}" method="POST" class="p-5">
                @csrf
                <div class="space-y-5">

                    <!-- Input Nama Wilayah -->
                    <div>
                        <label for="nama_wilayah" class="block mb-2 text-sm font-medium text-gray-300">Nama Wilayah (Angkatan)</label>
                        <input type="text" name="nama_wilayah" id="nama_wilayah" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 placeholder-gray-500 transition-colors" placeholder="Contoh: Angkatan 2024" required>
                    </div>

                    <!-- Input Kode Wilayah -->
                    <div>
                        <label for="kode_wilayah" class="block mb-2 text-sm font-medium text-gray-300">Kode Wilayah</label>
                        <input type="text" name="kode_wilayah" id="kode_wilayah" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 placeholder-gray-500 transition-colors uppercase" placeholder="Contoh: WLY-2024" required>
                        <p class="mt-1.5 text-xs text-gray-400 flex items-start gap-1">
                            <svg class="w-4 h-4 shrink-0 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Kode ini akan digunakan oleh Guru untuk melakukan Join ke wilayah ini.
                        </p>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-slate-600/60">
                    <button type="button" onclick="closeModal('modal-create')" class="text-gray-300 bg-transparent hover:bg-slate-700 rounded-lg text-sm font-medium px-5 py-2.5 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center gap-2 transition-colors shadow-lg shadow-indigo-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Wilayah
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- ========================================== -->
<!-- MODAL EDIT WILAYAH -->
<!-- ========================================== -->
<div id="modal-edit" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="relative bg-[#1e243b] border border-slate-600 rounded-2xl shadow-2xl">

            <div class="flex items-center justify-between p-5 border-b border-slate-600/60 rounded-t-2xl">
                <h3 class="text-xl font-bold text-white">Edit Wilayah</h3>
                <button type="button" onclick="closeModal('modal-edit')" class="text-gray-400 bg-transparent hover:bg-slate-700 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>

            <!-- Form Edit (Action URL akan diisi oleh JavaScript) -->
            <form id="form-edit-wilayah" method="POST" class="p-5">
                @csrf
                @method('PUT') <!-- Wajib ditambahkan untuk proses Update di Laravel -->

                <div class="space-y-5">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-300">Nama Wilayah</label>
                        <input type="text" name="nama_wilayah" id="edit_nama_wilayah" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition-colors" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-300">Kode Wilayah</label>
                        <input type="text" name="kode_wilayah" id="edit_kode_wilayah" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition-colors uppercase" required>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-slate-600/60">
                    <button type="button" onclick="closeModal('modal-edit')" class="text-gray-300 bg-transparent hover:bg-slate-700 rounded-lg text-sm font-medium px-5 py-2.5 transition-colors">Batal</button>
                    <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center gap-2 transition-colors shadow-lg shadow-indigo-500/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL HAPUS WILAYAH -->
<!-- ========================================== -->
<div id="modal-delete" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="relative bg-[#1e243b] border border-red-900/50 rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-6 text-center">

                <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-4">
                    <svg class="text-red-500 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>

                <h3 class="mb-2 text-xl font-bold text-white">Hapus Wilayah?</h3>
                <p class="mb-6 text-sm text-gray-400">Tindakan ini tidak dapat dibatalkan. Pastikan wilayah ini sudah kosong dari Sub Wilayah sebelum menghapus.</p>

                <form id="form-delete-wilayah" method="POST" class="flex items-center justify-center gap-3">
                    @csrf
                    @method('DELETE') <!-- Wajib untuk route DELETE -->

                    <button type="button" onclick="closeModal('modal-delete')" class="text-gray-300 bg-[#111827] hover:bg-slate-700 border border-slate-600 rounded-lg text-sm font-medium px-5 py-2.5 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors shadow-lg shadow-red-600/20 flex items-center gap-2">
                        Ya, Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Script Toggle Modal -->
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
    function openEditModal(id, nama, kode) {
        // 1. Ubah action URL pada form agar mengarah ke ID yang benar
        const form = document.getElementById('form-edit-wilayah');
        form.action = `/superadmin/wilayah/${id}`; // <-- Sesuaikan jika prefix URL Anda /superadmin/wilayah

        // 2. Isi inputan dengan data lama
        document.getElementById('edit_nama_wilayah').value = nama;
        document.getElementById('edit_kode_wilayah').value = kode;

        // 3. Tampilkan modal
        openModal('modal-edit');
    }
    function openDeleteModal(id) {
        const form = document.getElementById('form-delete-wilayah');
        form.action = `/superadmin/wilayah/${id}`; // <-- Sesuaikan dengan prefix URL Anda
        openModal('modal-delete');
    }
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                background: '#1e243b',
                color: '#ffffff',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    });
</script>
@endsection

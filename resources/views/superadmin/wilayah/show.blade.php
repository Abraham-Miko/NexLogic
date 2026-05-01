@extends('layouts.superadmin')

@section('content')
<div class="p-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header & Breadcrumb -->
        <div class="mb-8">
            <a href="{{ route('superadmin.wilayah') }}" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-indigo-400 transition mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Wilayah
            </a>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-1">Daftar Sub Wilayah <span class="text-indigo-400">({{ $wilayah->nama_wilayah }})</span></h2>
                    <p class="text-sm text-gray-400">Kode Induk: <b>{{ $wilayah->kode_wilayah }}</b></p>
                </div>

                <button onclick="openModal('modal-create-sub')" class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow-lg shadow-green-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Sub Wilayah Baru
                </button>
            </div>
        </div>

        <!-- Grid Sub Wilayah (Kelas) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($subWilayahs as $sub)
            <!-- Card Kelas -->
            <div class="group bg-[#1e243b] border border-slate-600 hover:border-indigo-500 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/10 flex flex-col h-full relative">

                <!-- Aksi (Edit/Hapus) di Pojok Kanan Atas -->
                <div class="absolute top-4 right-4 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button onclick="openEditSubModal({{ $sub->id }}, '{{ $sub->nama_sub_wilayah }}', '{{ $sub->kode_sub_wilayah }}', {{ $sub->guru_id }})" class="p-1.5 text-gray-400 hover:text-amber-400 bg-[#111827] hover:bg-amber-400/10 rounded-md transition" title="Edit Kelas">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button onclick="openDeleteSubModal({{ $sub->id }})" class="p-1.5 text-gray-400 hover:text-red-400 bg-[#111827] hover:bg-red-400/10 rounded-md transition" title="Hapus Kelas">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>

                <!-- Ikon & Nama Kelas -->
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center text-indigo-400 border border-indigo-500/30 shrink-0">
                        <span class="font-bold text-lg">
                            <!-- Mengambil huruf depan nama kelas (Misal: 'X' dari X-TKJ) -->
                            {{ substr($sub->nama_sub_wilayah, 0, 1) }}
                        </span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $sub->nama_sub_wilayah }}</h3>
                        <!-- Tampilan Kode Sub Wilayah dengan Tombol Copy -->
                        <div class="flex items-center gap-2 mt-2">
                            <!-- Area Kode dengan desain menonjol -->
                            <div class="flex items-center bg-[#111827] border border-slate-600/60 rounded-md overflow-hidden">
                                <span class="px-3 py-1.5 text-sm font-mono font-medium text-indigo-300 tracking-wider">
                                    Kode : {{ $sub->kode_sub_wilayah }}
                                </span>
                                <button onclick="copyKode('{{ $sub->kode_sub_wilayah }}', this)"
                                        class="p-1.5 bg-slate-700/50 hover:bg-indigo-600 transition-colors border-l border-slate-600/60"
                                        title="Salin Kode">
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="space-y-3 mb-6 flex-grow">
                    <!-- Wali Kelas -->
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <div>
                            <p class="text-xs text-gray-500 mb-0.5">Wali Kelas</p>
                            <p class="text-sm font-medium text-gray-300">{{ $sub->guru->nama ?? '-' }} ({{ $sub->guru->nomor_induk ?? '-' }})</p>
                        </div>
                    </div>

                    <!-- Jumlah Siswa -->
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <div>
                            <p class="text-xs text-gray-500 mb-0.5">Total Siswa</p>
                            <p class="text-sm font-medium text-gray-300"><span class="text-white">{{ $sub->users_count }}</span> orang terdaftar</p>
                        </div>
                    </div>
                </div>

                <!-- Tombol Navigasi Bawah -->
                <a href="{{ route('superadmin.subwilayah.show', $sub->id) }}" class="w-full py-2.5 bg-[#111827] border border-slate-600 hover:border-indigo-500 text-gray-300 hover:text-indigo-400 text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2 mt-auto">
                    Lihat Daftar Siswa
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>

            </div>
            @endforeach
        </div>

    </div>
</div>

<!-- ========================================== -->
    <!-- MODAL TAMBAH SUB WILAYAH -->
    <!-- ========================================== -->
    <div id="modal-create-sub" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="relative w-full max-w-md p-4 animate-fade-in-up">
            <div class="relative bg-[#1e243b] border border-slate-600 rounded-2xl shadow-2xl">

                <div class="flex items-center justify-between p-5 border-b border-slate-600/60 rounded-t-2xl">
                    <h3 class="text-xl font-bold text-white">Tambah Sub Wilayah (Kelas)</h3>
                    <button type="button" onclick="closeModal('modal-create-sub')" class="text-gray-400 bg-transparent hover:bg-slate-700 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>

                <form action="{{ route('superadmin.subwilayah.store') }}" method="POST" class="p-5">
                    @csrf
                    <!-- INI KUNCI RAHASIANYA: ID Wilayah otomatis terkirim tanpa terlihat User -->
                    <input type="hidden" name="wilayah_id" value="{{ $wilayah->id }}">

                    <div class="space-y-5">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-300">Nama Sub Wilayah / Kelas</label>
                            <input type="text" name="nama_sub_wilayah" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition-colors" placeholder="Contoh: X-TKJ 1" required>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-300">Kode Sub Wilayah</label>
                            <input type="text" name="kode_sub_wilayah" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition-colors uppercase" placeholder="Contoh: SUB-TKJ1" required>
                        </div>

                        <!-- Dropdown Pilih Guru -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-300">Wali Kelas / Guru Pengajar</label>
                            <select name="guru_id" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 transition-colors" required>
                                <option value="" disabled selected>-- Pilih Guru --</option>
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama }} ({{ $guru->nomor_induk }})</option>
                                @endforeach
                            </select>
                            @if($gurus->isEmpty())
                                <p class="mt-1 text-xs text-red-400">Peringatan: Belum ada akun Guru yang terdaftar di sistem.</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-slate-600/60">
                        <button type="button" onclick="closeModal('modal-create-sub')" class="text-gray-300 bg-transparent hover:bg-slate-700 rounded-lg text-sm font-medium px-5 py-2.5 transition-colors">Batal</button>
                        <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center gap-2 transition-colors shadow-lg shadow-indigo-500/20">
                            Simpan Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL EDIT SUB WILAYAH -->
    <!-- ========================================== -->
    <div id="modal-edit-sub" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="relative w-full max-w-md p-4 animate-fade-in-up">
            <div class="relative bg-[#1e243b] border border-slate-600 rounded-2xl shadow-2xl">
                <div class="flex items-center justify-between p-5 border-b border-slate-600/60 rounded-t-2xl">
                    <h3 class="text-xl font-bold text-white">Edit Sub Wilayah</h3>
                    <button type="button" onclick="closeModal('modal-edit-sub')" class="text-gray-400 bg-transparent hover:bg-slate-700 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>

                <form id="form-edit-sub" method="POST" class="p-5">
                    @csrf
                    @method('PUT')
                    <div class="space-y-5">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-300">Nama Sub Wilayah</label>
                            <input type="text" id="edit_nama_sub" name="nama_sub_wilayah" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-300">Kode Sub Wilayah</label>
                            <input type="text" id="edit_kode_sub" name="kode_sub_wilayah" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 uppercase" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-300">Wali Kelas</label>
                            <select id="edit_guru_sub" name="guru_id" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3" required>
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 mt-8 pt-5 border-t border-slate-600/60">
                        <button type="button" onclick="closeModal('modal-edit-sub')" class="text-gray-300 hover:bg-slate-700 rounded-lg text-sm px-5 py-2.5">Batal</button>
                        <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm px-5 py-2.5">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL HAPUS SUB WILAYAH -->
    <!-- ========================================== -->
    <div id="modal-delete-sub" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="relative w-full max-w-md p-4 animate-fade-in-up">
            <div class="relative bg-[#1e243b] border border-red-900/50 rounded-2xl shadow-2xl overflow-hidden text-center p-6">
                <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-4">
                    <svg class="text-red-500 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <h3 class="mb-2 text-xl font-bold text-white">Hapus Sub Wilayah?</h3>
                <p class="mb-6 text-sm text-gray-400">Pastikan kelas ini sudah tidak memiliki siswa. Tindakan ini tidak dapat dibatalkan.</p>
                <form id="form-delete-sub" method="POST" class="flex justify-center gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeModal('modal-delete-sub')" class="text-gray-300 bg-[#111827] hover:bg-slate-700 border border-slate-600 rounded-lg text-sm px-5 py-2.5">Batal</button>
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm px-5 py-2.5">Ya, Hapus Kelas</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Modal -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        function openEditSubModal(id, nama, kode, guruId) {
            document.getElementById('form-edit-sub').action = `/superadmin/sub-wilayah/${id}`;
            document.getElementById('edit_nama_sub').value = nama;
            document.getElementById('edit_kode_sub').value = kode;
            document.getElementById('edit_guru_sub').value = guruId;
            openModal('modal-edit-sub');
        }
        function openDeleteSubModal(id) {
            document.getElementById('form-delete-sub').action = `/superadmin/sub-wilayah/${id}`;
            openModal('modal-delete-sub');
        }
        function copyKode(text, buttonElement) {
            // Fungsi kecil untuk mengubah ikon menjadi centang hijau
            const showSuccessIcon = () => {
                const originalIcon = buttonElement.innerHTML;
                buttonElement.innerHTML = `
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                `;
                setTimeout(() => {
                    buttonElement.innerHTML = originalIcon;
                }, 2000);
            };

            // CARA 1: Gunakan Clipboard API modern jika tersedia (HTTPS / localhost)
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(showSuccessIcon).catch(err => {
                    console.error('Gagal menyalin API: ', err);
                });
            }
            else {
                let textArea = document.createElement("textarea");
                textArea.value = text;

                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);

                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    showSuccessIcon();
                } catch (err) {
                    console.error('Gagal menyalin Fallback: ', err);
                    alert('Browser Anda menolak fitur salin otomatis.');
                }
                textArea.remove();
            }
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

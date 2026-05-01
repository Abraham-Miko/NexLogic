@extends('layouts.superadmin')

@section('content')
<div class="p-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header & Tombol Kembali -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <a href="{{ route('superadmin.wilayah.show', $subWilayah->wilayah_id) }}" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white mb-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Wilayah
                </a>
                <h1 class="text-3xl font-bold text-white">Kelas: {{ $subWilayah->nama_sub_wilayah }}</h1>
                <p class="text-gray-400 mt-1">Kelola data siswa di sini.</p>
            </div>

            <!-- Tombol Tambah Siswa (Membuka Modal) -->
            <button onclick="openModal('modal-tambah-siswa')" class="bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 flex items-center gap-2 transition-colors shadow-lg shadow-green-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Tambah Siswa Baru
            </button>
        </div>

        <!-- Info Card Kelas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-[#1e243b] border border-slate-600/50 rounded-xl p-5">
                <p class="text-sm text-gray-400 font-medium mb-1">Wali Kelas / Guru</p>
                <p class="text-lg font-bold text-white">{{ $subWilayah->guru->nama ?? 'Belum Ditentukan' }}</p>
            </div>
            <div class="bg-[#1e243b] border border-slate-600/50 rounded-xl p-5">
                <p class="text-sm text-gray-400 font-medium mb-1">Total Siswa</p>
                <p class="text-lg font-bold text-white">{{ $subWilayah->users->count() }} Anak</p>
            </div>
            <div class="bg-[#1e243b] border border-slate-600/50 rounded-xl p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 font-medium mb-1">Kode Kelas</p>
                    <p class="text-lg font-mono font-bold text-indigo-400">{{ $subWilayah->kode_sub_wilayah }}</p>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Siswa -->
        <div class="bg-[#1e243b] border border-slate-600/50 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs text-gray-300 uppercase bg-slate-700/50 border-b border-slate-600/50">
                        <tr>
                            <th scope="col" class="px-6 py-4">No</th>
                            <th scope="col" class="px-6 py-4">Nomor Induk</th>
                            <th scope="col" class="px-6 py-4">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subWilayah->users as $index => $siswa)
                        <tr class="border-b border-slate-600/50 hover:bg-slate-700/20 transition-colors">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-mono text-gray-300">{{ $siswa->nomor_induk }}</td>
                            <td class="px-6 py-4 font-medium text-white">{{ $siswa->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $siswa->status == 'aktif' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                    {{ ucfirst($siswa->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openRemoveSiswaModal({{ $siswa->id }}, '{{ addslashes($siswa->nama) }}')" class="inline-flex items-center gap-1 text-red-400 hover:text-red-300 text-xs font-medium px-2.5 py-1.5 rounded-lg hover:bg-red-500/10 transition-colors border border-transparent hover:border-red-500/20">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zm11-2h-4m0 0l2-2m-2 2l2 2"></path></svg>
                                    Keluarkan
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-700/50 mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <h3 class="text-lg font-medium text-white mb-1">Belum ada siswa</h3>
                                <p class="text-gray-400 text-sm">Kelas ini masih kosong. Klik Tambah Siswa Baru untuk memulai.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- ========================================== -->
<!-- MODAL 1: CARI & PILIH SISWA -->
<!-- ========================================== -->
<div id="modal-tambah-siswa" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <!-- Tambahkan max-h-[80vh] agar modal tidak bablas ke bawah jika siswa banyak -->
        <div class="relative bg-[#1e243b] border border-slate-600 rounded-2xl shadow-2xl flex flex-col max-h-[80vh]">

            <div class="flex items-center justify-between p-5 border-b border-slate-600/60 shrink-0">
                <h3 class="text-xl font-bold text-white">Pilih Siswa</h3>
                <button type="button" onclick="closeModal('modal-tambah-siswa')" class="text-gray-400 hover:bg-slate-700 hover:text-white rounded-lg p-1.5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>

            <!-- Kolom Pencarian -->
            <div class="p-4 shrink-0 border-b border-slate-600/60 bg-slate-800/30">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <!-- Input search memanggil fungsi JS filterSiswa() -->
                    <input type="text" id="searchInput" onkeyup="filterSiswa()" class="bg-[#111827] border border-slate-600 text-white text-sm rounded-lg focus:ring-indigo-500 block w-full pl-10 p-2.5" placeholder="Ketik nama atau NIS siswa...">
                </div>
            </div>

            <!-- Daftar Siswa (Bisa di-scroll) -->
            <div class="p-2 overflow-y-auto grow custom-scrollbar">
                @forelse($calonSiswa as $siswa)
                    <!-- Saat diklik, panggil modal konfirmasi -->
                    <button type="button" onclick="openConfirmModal({{ $siswa->id }}, '{{ addslashes($siswa->nama) }}')" class="siswa-item flex flex-col w-full text-left p-3 mb-1 rounded-lg hover:bg-indigo-600/20 hover:border-indigo-500/50 border border-transparent transition-all">
                        <span class="font-medium text-white siswa-nama">{{ $siswa->nama }}</span>
                        <span class="text-xs text-gray-400 siswa-nis mt-0.5">NIS: {{ $siswa->nomor_induk }}</span>
                    </button>
                @empty
                    <div class="p-6 text-center">
                        <p class="text-gray-400 text-sm">Tidak ada siswa aktif yang belum mendapat kelas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL 2: KONFIRMASI MASUKKAN SISWA -->
<!-- ========================================== -->
<div id="modal-confirm-assign" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-sm p-4 animate-fade-in-up">
        <div class="relative bg-[#1e243b] border border-indigo-500/30 rounded-2xl shadow-2xl text-center p-6">

            <div class="w-16 h-16 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center mx-auto mb-4">
                <svg class="text-indigo-400 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>

            <h3 class="mb-2 text-xl font-bold text-white">Masukkan ke Kelas?</h3>
            <p class="mb-6 text-sm text-gray-400 leading-relaxed">
                Anda akan memasukkan <br>
                <strong id="confirm_nama_siswa" class="text-white text-base"></strong> <br>
                ke kelas ini.
            </p>

            <form action="{{ route('superadmin.subwilayah.assign_siswa', $subWilayah->id) }}" method="POST" class="flex justify-center gap-3">
                @csrf
                <input type="hidden" name="siswa_id" id="confirm_siswa_id">

                <button type="button" onclick="closeModal('modal-confirm-assign')" class="text-gray-300 bg-[#111827] hover:bg-slate-700 border border-slate-600 rounded-lg text-sm px-5 py-2.5">Batal</button>
                <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm px-5 py-2.5 shadow-lg shadow-indigo-600/20">Ya, Masukkan</button>
            </form>
        </div>
    </div>
</div>
<!-- ========================================== -->
<!-- MODAL 3: KONFIRMASI KELUARKAN SISWA -->
<!-- ========================================== -->
<div id="modal-remove-siswa" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-sm p-4 animate-fade-in-up">
        <div class="relative bg-[#1e243b] border border-red-900/50 rounded-2xl shadow-2xl text-center p-6">

            <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-4">
                <svg class="text-red-500 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zm11-2h-4m0 0l2-2m-2 2l2 2"></path></svg>
            </div>

            <h3 class="mb-2 text-xl font-bold text-white">Keluarkan Siswa?</h3>
            <p class="mb-6 text-sm text-gray-400 leading-relaxed">
                Anda akan mengeluarkan <strong id="remove_nama_siswa" class="text-white text-base"></strong> dari kelas ini.<br>
                <span class="text-xs text-amber-400/80 block mt-2">Data akun siswa tidak akan terhapus, hanya akan dikembalikan ke status "Belum Ada Kelas".</span>
            </p>

            <form id="form-remove-siswa" method="POST" class="flex justify-center gap-3">
                @csrf
                <!-- Tidak perlu @method('DELETE') karena kita menggunakan rute POST untuk proses Update -->
                <button type="button" onclick="closeModal('modal-remove-siswa')" class="text-gray-300 bg-[#111827] hover:bg-slate-700 border border-slate-600 rounded-lg text-sm px-5 py-2.5 transition-colors">Batal</button>
                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm px-5 py-2.5 shadow-lg shadow-red-600/20 transition-colors">Ya, Keluarkan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
    function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }
    // FUNGSI PENCARIAN SISWA (Live Search)
        function filterSiswa() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let items = document.querySelectorAll('.siswa-item');

            items.forEach(item => {
                let nama = item.querySelector('.siswa-nama').innerText.toLowerCase();
                let nis = item.querySelector('.siswa-nis').innerText.toLowerCase();

                // Cek apakah ketikan cocok dengan nama ATAU nis
                if(nama.includes(input) || nis.includes(input)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }
        function openRemoveSiswaModal(id, nama) {
            // 1. Tampilkan nama siswa di dalam modal
            document.getElementById('remove_nama_siswa').innerText = nama;

            // 2. Suntikkan URL Action form dengan ID siswa yang diklik
            // Sesuaikan prefix URL jika Anda menggunakan prefix khusus (misal: /superadmin/...)
            document.getElementById('form-remove-siswa').action = `/superadmin/sub-wilayah/remove-siswa/${id}`;

            // 3. Buka modalnya
            openModal('modal-remove-siswa');
        }

        // FUNGSI PEMBUKA MODAL KONFIRMASI
        function openConfirmModal(id, nama) {
            // 1. Tutup modal pencarian terlebih dahulu agar tidak bertumpuk
            closeModal('modal-tambah-siswa');

            // 2. Isi data ID dan Nama di modal konfirmasi
            document.getElementById('confirm_siswa_id').value = id;
            document.getElementById('confirm_nama_siswa').innerText = nama;

            // 3. Tampilkan modal konfirmasi
            openModal('modal-confirm-assign');
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
                timer: 2500 // Hilang otomatis setelah 2.5 detik
            });
        @endif
    });
</script>
@endsection

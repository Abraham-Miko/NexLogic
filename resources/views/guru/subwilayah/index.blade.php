@extends('layouts.guru')
@section('content')

<!-- 1. PEMBUNGKUS UTAMA ALPINE.JS (Membungkus halaman & modal) -->
<div x-data="{
    isTambahModalOpen: false,
    isDetailModalOpen: false,
    isLoadingDetail: false,
    detailSiswa: { nis: '', nama: '', inisial: '' },
    detailNilaiMateri: [],

    openDetailNilai(siswaData) {
        this.isDetailModalOpen = true;
        this.isLoadingDetail = true;
        
        this.detailSiswa.nis = siswaData.nis;
        this.detailSiswa.nama = siswaData.nama;
        this.detailSiswa.inisial = siswaData.nama.substring(0, 2).toUpperCase();

        // Ambil data detail nilai yang disuntikkan dari Blade
        this.detailNilaiMateri = siswaData.details;
        this.isLoadingDetail = false;
    },

    closeDetailModal() {
        this.isDetailModalOpen = false;
        setTimeout(() => { this.detailNilaiMateri = []; }, 300);
    }
}" class="relative">

    <!-- 2. KONTEN HALAMAN ASLI ANDA -->
    <div class="p-8">
        <!-- Header Page -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-white">{{ $kelas->nama_sub_wilayah }}</h2>
                <p class="text-sm text-gray-400">Jurusan: {{ $kelas->wilayah->nama_wilayah }}</p>
                <div class="flex items-center gap-2 mt-2">
                    <div class="flex items-center bg-[#111827] border border-slate-600/60 rounded-md overflow-hidden">
                        <span class="px-3 py-1.5 text-sm font-mono font-medium text-indigo-300 tracking-wider">
                            Kode : {{ $kelas->kode_sub_wilayah }}
                        </span>
                        <button onclick="copyKode('{{ $kelas->kode_sub_wilayah }}', this)"
                                class="p-1.5 bg-slate-700/50 hover:bg-indigo-600 transition-colors border-l border-slate-600/60"
                                title="Salin Kode">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <button onclick="openModal('modal-tambah-siswa')" class="bg-[#4c489d] hover:bg-[#5b56b6] text-white px-5 py-2 rounded-lg font-bold shadow-[0_0_15px_rgba(76,72,157,0.3)] transition">
                + Tambah Siswa
            </button>
        </div>

        <!-- Container Filter -->
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <div class="relative flex-1 min-w-[250px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="searchSiswa" placeholder="Cari Nama atau NISN..." class="block w-full pl-10 pr-3 py-2.5 bg-[#1f2937] border border-slate-700 rounded-lg text-sm text-white focus:outline-none focus:border-[#4c489d] focus:ring-1 focus:ring-[#4c489d] transition-all">
            </div>
            <div class="w-44">
                <select id="filterJK" class="w-full bg-[#1f2937] border border-slate-700 text-gray-300 text-sm rounded-lg focus:ring-[#4c489d] focus:border-[#4c489d] p-2.5 outline-none transition-all">
                    <option value="all">Semua Gender</option><option value="L">Laki-laki</option><option value="P">Perempuan</option>
                </select>
            </div>
            <div class="w-44">
                <select id="filterPreTest" class="w-full bg-[#1f2937] border border-slate-700 text-gray-300 text-sm rounded-lg focus:ring-[#4c489d] focus:border-[#4c489d] p-2.5 outline-none transition-all">
                    <option value="all">Nilai Pre-Test</option><option value=">=75">>= 75 (Tuntas)</option><option value="<75">< 75 (Remedial)</option><option value="<50">< 50 (Perlu Bimbingan)</option>
                </select>
            </div>
            <div class="w-44">
                <select id="filterPostTest" class="w-full bg-[#1f2937] border border-slate-700 text-gray-300 text-sm rounded-lg focus:ring-[#4c489d] focus:border-[#4c489d] p-2.5 outline-none transition-all">
                    <option value="all">Nilai Post-Test</option><option value=">=75">>= 75 (Tuntas)</option><option value="<75">< 75 (Remedial)</option><option value="<50">< 50 (Perlu Bimbingan)</option>
                </select>
            </div>
        </div>

        <!-- Tabel Siswa -->
        <div class="bg-[#111827] border border-slate-700 rounded-2xl overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#1f2937] text-gray-400 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="px-6 py-4">NIS</th><th class="px-6 py-4">Nama Lengkap</th><th class="px-6 py-4">Jenis Kelamin</th>
                        <th class="px-6 py-4 text-center">Nilai Pre-Test</th><th class="px-6 py-4 text-center">Nilai Post-Test</th>
                        <th class="px-6 py-4 text-center">Skor Puzzle</th><th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 text-gray-300">
                    @forelse($kelas->siswa as $siswa)
                        @php
                            $totalPre = 0;
                            $totalPost = 0;
                            $countPre = 0;
                            $countPost = 0;
                            $totalSkorPuzzle = 0;
                            $detailMateri = [];
                            $judulMateri = [
                                1 => 'Variabel & Tipe Data',
                                2 => 'Operator & Ekspresi',
                                3 => 'Input & Output',
                                4 => 'Percabangan (if/else)',
                                5 => 'Perulangan (for & while)',
                                6 => 'Fungsi & Parameter',
                            ];
                            
                            foreach($siswa->penilaians as $pen) {
                                if ($pen->skor_pre !== null) {
                                    $totalPre += $pen->skor_pre;
                                    $countPre++;
                                }
                                if ($pen->skor_post !== null) {
                                    $totalPost += $pen->skor_post;
                                    $countPost++;
                                }
                                if ($pen->skor_puzzle !== null) {
                                    $totalSkorPuzzle += $pen->skor_puzzle;
                                }
                            }
                            
                            $avgPre = $countPre > 0 ? round($totalPre / $countPre) : 0;
                            $avgPost = $countPost > 0 ? round($totalPost / $countPost) : 0;
                            
                            for($i=1; $i<=6; $i++) {
                                $pen = $siswa->penilaians->where('materi_ke', $i)->first();
                                $detailMateri[] = [
                                    'materi_id' => $i,
                                    'urutan' => $i,
                                    'judul_materi' => $judulMateri[$i],
                                    'pre_test' => $pen ? $pen->skor_pre : null,
                                    'post_test' => $pen ? $pen->skor_post : null,
                                ];
                            }
                        @endphp
                        <tr class="hover:bg-gray-800/50 transition">
                            <td class="px-6 py-4 font-mono">{{ $siswa->nomor_induk }}</td>
                            <td class="px-6 py-4 font-medium text-white">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $siswa->avatar_url }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                                    <span class="text-white font-medium">{{ $siswa->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4" data-gender="{{ $siswa->jenis_kelamin }}">
                                @if ($siswa->jenis_kelamin == 'L')
                                    <div class="flex items-center gap-2 text-blue-400">
                                        <div class="w-7 h-7 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="14" r="5"></circle><line x1="13.5" y1="10.5" x2="21" y2="3"></line><polyline points="16 3 21 3 21 8"></polyline></svg>
                                        </div>
                                        <span class="text-sm font-medium">Laki-laki</span>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2 text-pink-400">
                                        <div class="w-7 h-7 rounded-full bg-pink-500/10 border border-pink-500/20 flex items-center justify-center">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="5"></circle><line x1="12" y1="15" x2="12" y2="22"></line><line x1="9" y1="19" x2="15" y2="19"></line></svg>
                                        </div>
                                        <span class="text-sm font-medium">Perempuan</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-white text-center">{{ $avgPre }}</td>
                            <td class="px-6 py-4 font-medium text-white text-center">{{ $avgPost }}</td>
                            <td class="px-6 py-4 font-medium text-white text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                    {{ $totalSkorPuzzle }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                
                                <button @click="openDetailNilai({ nis: '{{ $siswa->nomor_induk }}', nama: '{{ addslashes($siswa->nama) }}', details: {{ json_encode($detailMateri) }} })" 
                                        class="text-[#4c489d] hover:text-indigo-400 bg-[#4c489d]/10 hover:bg-[#4c489d]/20 px-3 py-1.5 rounded-lg transition-colors border border-[#4c489d]/20 flex items-center gap-2 inline-flex">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Detail Nilai
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <p class="text-gray-500 mb-4">Belum ada siswa di kelas ini.</p>
                                    <button onclick="openModal('modal-tambah-siswa')" class="text-[#4c489d] font-bold hover:underline">Undang Siswa Sekarang</button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> <!-- /Penutup p-8 -->

    <!-- 3. KODE MODAL (Sekarang ada DI DALAM bungkus x-data) -->
    <div x-show="isDetailModalOpen" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center px-4 py-6 sm:px-0">
        <div x-show="isDetailModalOpen" x-transition.opacity class="fixed inset-0 bg-black/70 backdrop-blur-sm" @click="closeDetailModal()"></div>
        <div x-show="isDetailModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-[#1f2937] rounded-xl border border-gray-700 shadow-2xl w-full max-w-3xl flex flex-col relative z-50 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-700 bg-slate-800 flex justify-between items-start">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#4c489d]/20 text-[#4c489d] flex items-center justify-center font-bold text-lg border border-[#4c489d]/30" x-text="detailSiswa.inisial"></div>
                    <div>
                        <h2 class="text-xl font-bold text-white" x-text="detailSiswa.nama"></h2>
                        <p class="text-sm text-gray-400">NIS: <span x-text="detailSiswa.nis"></span></p>
                    </div>
                </div>
                <button @click="closeDetailModal()" class="text-gray-400 hover:text-white p-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6 bg-slate-900/50 max-h-[60vh] overflow-y-auto custom-scrollbar">
                <div x-show="isLoadingDetail" class="flex justify-center py-10">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-[#4c489d]"></div>
                </div>
                <div x-show="!isLoadingDetail">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-slate-800">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase rounded-tl-lg">Materi</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Pre-Test</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase rounded-tr-lg">Post-Test</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800 bg-[#1f2937]">
                            <template x-for="nilai in detailNilaiMateri" :key="nilai.materi_id">
                                <tr class="hover:bg-slate-800/50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-white" x-text="nilai.judul_materi"></div>
                                        <div class="text-xs text-gray-500">Materi ke-<span x-text="nilai.urutan"></span></div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border" :class="nilai.pre_test === null ? 'bg-gray-800 text-gray-500 border-gray-700' : (nilai.pre_test < 70 ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-green-500/10 text-green-400 border-green-500/20')"><span x-text="nilai.pre_test !== null ? nilai.pre_test : 'Belum Tes'"></span></span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border" :class="nilai.post_test === null ? 'bg-gray-800 text-gray-500 border-gray-700' : (nilai.post_test < 70 ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-green-500/10 text-green-400 border-green-500/20')"><span x-text="nilai.post_test !== null ? nilai.post_test : 'Belum Tes'"></span></span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-700 bg-slate-800 flex justify-end">
                <button @click="closeDetailModal()" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors">Tutup</button>
            </div>
        </div>
    </div>
<!-- ========================================== -->
<!-- MODAL 1: CARI & PILIH SISWA               -->
<!-- ========================================== -->
<div id="modal-tambah-siswa" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="modal-card bg-[#1f2937] border border-slate-700 relative rounded-2xl shadow-2xl flex flex-col max-h-[80vh]"
             style="box-shadow: 0 0 60px rgba(99,102,241,0.15), 0 25px 50px rgba(0,0,0,0.5);">

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-5 shrink-0"
                 style="border-bottom: 1px solid rgba(99,102,241,0.12);">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                         style="background: rgba(99,102,241,0.1); border: 1px solid rgba(99,102,241,0.25);">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Pilih Siswa</h3>
                </div>
                <button type="button" onclick="closeModal('modal-tambah-siswa')"
                        class="text-slate-500 hover:text-white rounded-lg p-1.5 transition-colors"
                        style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

            <!-- Search Input -->
            <div class="p-4 shrink-0" style="border-bottom: 1px solid rgba(99,102,241,0.08); background: rgba(99,102,241,0.02);">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <!-- Input search memanggil fungsi JS filterSiswa() -->
                    <input type="text" id="searchInput" onkeyup="filterSiswa()"
                           class="block w-full pl-10 pr-3 py-2.5 bg-[#111827] border border-slate-700 rounded-lg text-sm text-white focus:outline-none focus:border-[#4c489d] focus:ring-1 focus:ring-[#4c489d] transition-all"
                           placeholder="Ketik nama atau NIS siswa...">
                </div>
            </div>

            <!-- Daftar Siswa (Bisa di-scroll) -->
            <div class="p-2 overflow-y-auto grow" style="scrollbar-width: thin; scrollbar-color: rgba(99,102,241,0.2) transparent;">
                @forelse($calonSiswa as $siswa)
                    <!-- Saat diklik, panggil modal konfirmasi -->
                    <button type="button" onclick="openConfirmModal({{ $siswa->id }}, '{{ addslashes($siswa->nama) }}')"
                            class="siswa-item flex flex-col w-full text-left p-3 mb-1 rounded-lg transition-all"
                            style="border: 1px solid transparent;"
                            onmouseover="this.style.background='rgba(99,102,241,0.08)'; this.style.borderColor='rgba(99,102,241,0.2)';"
                            onmouseout="this.style.background='transparent'; this.style.borderColor='transparent';">
                        <span class="font-medium text-white siswa-nama text-sm">{{ $siswa->nama }}</span>
                        <span class="text-xs text-slate-500 siswa-nis mt-0.5 font-mono">NIS: {{ $siswa->nomor_induk }}</span>
                    </button>
                @empty
                    <div class="p-8 text-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3"
                             style="background: rgba(99,102,241,0.05); border: 1px solid rgba(99,102,241,0.12);">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <p class="text-slate-500 text-sm">Tidak ada siswa aktif yang belum mendapat kelas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL 2: KONFIRMASI MASUKKAN SISWA        -->
<!-- ========================================== -->
<div id="modal-confirm-assign" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-sm p-4 animate-fade-in-up">
        <div class="modal-card-confirm bg-[#1f2937] border border-slate-700 relative rounded-2xl shadow-2xl text-center p-6"
             style="box-shadow: 0 0 60px rgba(99,102,241,0.18), 0 25px 50px rgba(0,0,0,0.5);">

            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5"
                 style="background: rgba(99,102,241,0.08); border: 1px solid rgba(99,102,241,0.2);">
                <svg class="text-indigo-400 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>

            <h3 class="mb-2 text-xl font-bold text-white">Masukkan ke Kelas?</h3>
            <p class="mb-6 text-sm text-slate-400 leading-relaxed">
                Anda akan memasukkan<br>
                <strong id="confirm_nama_siswa" class="text-indigo-300 text-base"></strong><br>
                ke kelas ini.
            </p>

            <form action="{{ route('guru.subwilayah.assign_siswa', $subWilayah->id) }}" method="POST" class="flex justify-center gap-3">
                @csrf
                <input type="hidden" name="siswa_id" id="confirm_siswa_id">

                <button type="button" onclick="closeModal('modal-confirm-assign')"
                        class="text-slate-300 text-sm px-5 py-2.5 rounded-lg transition-colors"
                        style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);"
                        onmouseover="this.style.background='rgba(255,255,255,0.07)';"
                        onmouseout="this.style.background='rgba(255,255,255,0.04)';">
                    Batal
                </button>
                <button type="submit"
                        class="text-white text-sm px-5 py-2.5 rounded-lg font-semibold transition-all"
                        style="background: linear-gradient(135deg, #4338ca, #6366f1); border: 1px solid rgba(99,102,241,0.4); box-shadow: 0 0 20px rgba(99,102,241,0.25);"
                        onmouseover="this.style.boxShadow='0 0 30px rgba(99,102,241,0.4)';"
                        onmouseout="this.style.boxShadow='0 0 20px rgba(99,102,241,0.25)';">
                    Ya, Masukkan
                </button>
            </form>
        </div>
    </div>
</div>
</div> <!-- /PENUTUP X-DATA UTAMA -->

<!-- JAVASCRIPT FILTER & COPY ASLI ANDA -->
<script>
    const searchInput = document.getElementById('searchSiswa');
    const filterJK = document.getElementById('filterJK');
    const filterPre = document.getElementById('filterPreTest');
    const filterPost = document.getElementById('filterPostTest');

    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const genderValue = filterJK.value;
        const preValue = filterPre.value;
        const postValue = filterPost.value;

        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const nisn = row.cells[0]?.textContent.toLowerCase() || '';
            const nama = row.cells[1]?.textContent.toLowerCase() || '';
            const gender = row.cells[2]?.getAttribute('data-gender') || '';
            const preScore = parseFloat(row.cells[3]?.textContent) || 0;
            const postScore = parseFloat(row.cells[4]?.textContent) || 0;

            const matchesSearch = nisn.includes(searchTerm) || nama.includes(searchTerm);
            const matchesGender = genderValue === 'all' || gender === genderValue;

            const checkScore = (val, score) => {
                if (val === 'all') return true;
                if (val === '>=75') return score >= 75;
                if (val === '<75') return score < 75;
                if (val === '<50') return score < 50;
                return true;
            };

            if (matchesSearch && matchesGender && checkScore(preValue, preScore) && checkScore(postValue, postScore)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    [searchInput, filterJK, filterPre, filterPost].forEach(el => {
        if(el) el.addEventListener('input', applyFilters);
    });

    function copyKode(text, buttonElement) {
        const showSuccessIcon = () => {
            const originalIcon = buttonElement.innerHTML;
            buttonElement.innerHTML = `<svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;
            setTimeout(() => { buttonElement.innerHTML = originalIcon; }, 2000);
        };

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(showSuccessIcon).catch(err => console.error('Gagal menyalin API: ', err));
        } else {
            let textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.left = "-999999px";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try { document.execCommand('copy'); showSuccessIcon(); } 
            catch (err) { alert('Browser Anda menolak fitur salin otomatis.'); }
            textArea.remove();
        }
    }
    function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
    function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }
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
                background: '#080e1a',
                color: '#ffffff',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    });
</script>
@endsection
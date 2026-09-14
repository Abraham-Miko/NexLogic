@extends('layouts.guru')
@section('content')

<style>
    /* ── Page Header ── */
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.7rem; font-family: monospace;
        letter-spacing: 0.15em; text-transform: uppercase;
        color: #818cf8; margin-bottom: 4px;
    }
    .page-header-badge-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #818cf8;
        box-shadow: 0 0 8px rgba(129,140,248,0.9);
        animation: pulse-glow 2s ease infinite;
    }
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 8px rgba(129,140,248,0.9); }
        50% { box-shadow: 0 0 16px rgba(129,140,248,0.4); }
    }

    /* ── Status Badge ── */
    .badge-aktif {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 10px; border-radius: 20px;
        background: rgba(16,185,129,0.1);
        border: 1px solid rgba(16,185,129,0.25);
        color: #34d399; font-size: 0.72rem; font-weight: 600; font-family: monospace;
    }
    .badge-aktif-dot { width: 6px; height: 6px; border-radius: 50%; background: #10b981;
        box-shadow: 0 0 6px rgba(16,185,129,0.8); animation: pulse-dot 2s infinite; }
    .badge-nonaktif {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 10px; border-radius: 20px;
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.25);
        color: #f87171; font-size: 0.72rem; font-weight: 600; font-family: monospace;
    }
    .badge-nonaktif-dot { width: 6px; height: 6px; border-radius: 50%; background: #ef4444; }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; box-shadow: 0 0 6px rgba(16,185,129,0.8); }
        50% { opacity: 0.6; box-shadow: 0 0 2px rgba(16,185,129,0.4); }
    }

    /* ── Buttons ── */
    .btn-indigo-solid {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        background: linear-gradient(135deg, #4338ca, #6366f1);
        border: 1px solid rgba(99,102,241,0.3);
        color: #fff;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 0 16px rgba(99,102,241,0.2);
        white-space: nowrap;
    }
    .btn-indigo-solid:hover {
        box-shadow: 0 0 24px rgba(99,102,241,0.35);
        transform: translateY(-1px);
    }
    .btn-indigo-outline {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        background: rgba(99,102,241,0.06);
        border: 1px solid rgba(99,102,241,0.3);
        color: #818cf8;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s ease;
        white-space: nowrap;
    }
    .btn-indigo-outline:hover {
        background: rgba(99,102,241,0.1);
        box-shadow: 0 0 14px rgba(99,102,241,0.15);
    }

    /* ── Table Styling ── */
    .data-table-wrap {
        background: rgba(10, 16, 32, 0.7);
        border: 1px solid rgba(99, 102, 241, 0.1);
        border-radius: 14px;
        backdrop-filter: blur(8px);
        overflow: hidden;
    }
    .data-table-header {
        background: rgba(15, 23, 42, 0.8);
        border-bottom: 1px solid rgba(99, 102, 241, 0.1);
    }
    .data-table-row {
        transition: background-color 0.2s ease;
        border-bottom: 1px solid rgba(99, 102, 241, 0.05);
    }
    .data-table-row:hover { background: rgba(99, 102, 241, 0.05); }

    /* ── Inputs & Selects ── */
    .neon-input {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: #e2e8f0;
        border-radius: 10px;
        padding: 10px 16px;
        padding-left: 40px;
        font-size: 0.875rem;
        transition: all 0.25s ease;
        outline: none;
        width: 100%;
    }
    .neon-input:focus {
        border-color: rgba(99, 102, 241, 0.6);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .neon-select {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: #e2e8f0;
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 0.875rem;
        transition: all 0.25s ease;
        outline: none;
        appearance: none;
        width: 100%;
    }
    .neon-select:focus {
        border-color: rgba(99, 102, 241, 0.6);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .neon-select option { background: #0f172a; }

    /* ── Breadcrumb ── */
    .header-navigation {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 24px;
    }
    .back-link {
        display: flex; 
        align-items: center; 
        justify-content: center;
        transition: opacity 0.2s ease-in-out;
    }
    .back-link:hover { 
        opacity: 0.8; 
    }
    .back-link svg { 
        width: 20px; 
        height: 20px; 
        fill: #f8fafc; 
    }    
    .breadcrumb {
        display: flex; 
        align-items: center; 
        gap: 16px;
        font-size: 1.25rem; 
        font-weight: 500;
    }
    .breadcrumb a {
        color: #9ca3af; 
        text-decoration: none;
        transition: color 0.2s ease-in-out;
        font-size: 16px;
    }
    .breadcrumb svg { 
        width: 20px; 
        height: 20px; 
        color: #f8fafc;
    }
    .breadcrumb p {
        font-size: 16px;
        color: #9ca3af;
    }
    .breadcrumb span {
        font-size: 16px;
        color: #f8fafc;
    }

    /* Custom Scrollbar for Modal */
    .custom-scrollbar::-webkit-scrollbar { width: 8px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(10, 16, 32, 0.5); border-radius: 8px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(99, 102, 241, 0.3); border-radius: 8px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(99, 102, 241, 0.5); }
</style>

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
}" class="relative text-white min-h-screen">

    <!-- 2. KONTEN HALAMAN ASLI ANDA -->
    <div class="p-8 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <div class="header-navigation">
            <a href="{{ route('/') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <path d="M232,128a8,8,0,0,1-8,8H91.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L91.31,120H224A8,8,0,0,1,232,128ZM40,32a8,8,0,0,0-8,8V216a8,8,0,0,0,16,0V40A8,8,0,0,0,40,32Z"></path>
                </svg>
            </a>

            <div class="breadcrumb">
                <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <p>Detail Kelas</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span>{{ $kelas->wilayah->nama_wilayah ?? 'Tanpa Wilayah' }} - {{ $kelas->nama_sub_wilayah }}</span>
            </div>
        </div>
        
        <!-- Header Page -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <div class="page-header-badge">
                    <span class="page-header-badge-dot"></span>
                    Detail Kelas
                </div>
                <h2 class="text-3xl font-bold text-white mb-1" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 24px rgba(129,140,248,0.2);">{{ $kelas->nama_sub_wilayah }}</h2>
                <p class="text-slate-500">Jurusan: {{ $kelas->wilayah->nama_wilayah }}</p>
                
                <div class="flex items-center gap-2 mt-3">
                    <div class="flex items-center bg-indigo-500/10 border border-indigo-500/20 rounded-lg overflow-hidden">
                        <span class="px-4 py-2 text-sm font-mono font-medium text-indigo-300 tracking-wider">
                            Kode : {{ $kelas->kode_sub_wilayah }}
                        </span>
                        <button onclick="copyKode('{{ $kelas->kode_sub_wilayah }}', this)"
                                class="p-2.5 bg-indigo-500/20 hover:bg-indigo-500 transition-colors border-l border-indigo-500/20 group"
                                title="Salin Kode">
                            <svg class="w-4 h-4 text-indigo-300 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <button onclick="openModal('modal-tambah-siswa')" class="btn-indigo-solid">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Siswa
            </button>
        </div>

        <!-- Container Filter -->
        <div class="flex flex-wrap items-center gap-4 mb-6 bg-[rgba(10,16,32,0.7)] p-4 rounded-xl border border-indigo-500/10 backdrop-blur-sm">
            <div class="relative flex-1 min-w-[250px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="searchSiswa" placeholder="Cari Nama atau NISN..." class="neon-input">
            </div>
            <div class="w-44 relative">
                <select id="filterJK" class="neon-select">
                    <option value="all">Semua Gender</option><option value="L">Laki-laki</option><option value="P">Perempuan</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-indigo-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            <div class="w-44 relative">
                <select id="filterPreTest" class="neon-select">
                    <option value="all">Nilai Pre-Test</option><option value=">=75">>= 75 (Tuntas)</option><option value="<75">< 75 (Remedial)</option><option value="<50">< 50 (Perlu Bimbingan)</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-indigo-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            <div class="w-44 relative">
                <select id="filterPostTest" class="neon-select">
                    <option value="all">Nilai Post-Test</option><option value=">=75">>= 75 (Tuntas)</option><option value="<75">< 75 (Remedial)</option><option value="<50">< 50 (Perlu Bimbingan)</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-indigo-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>

        <!-- Tabel Siswa -->
        <div class="data-table-wrap">
            <table class="w-full text-left text-sm">
                <thead class="data-table-header text-indigo-300 uppercase text-[10px] tracking-wider font-mono">
                    <tr>
                        <th class="px-6 py-4">NIS</th><th class="px-6 py-4">Nama Lengkap</th><th class="px-6 py-4">Jenis Kelamin</th>
                        <th class="px-6 py-4 text-center">Nilai Pre-Test</th><th class="px-6 py-4 text-center">Nilai Post-Test</th>
                        <th class="px-6 py-4 text-center">Skor Puzzle</th><th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-500/10 text-gray-300">
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
                        <tr class="data-table-row">
                            <td class="px-6 py-4 font-mono text-indigo-200">{{ $siswa->nomor_induk }}</td>
                            <td class="px-6 py-4 font-medium text-white">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $siswa->avatar_url }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover border border-indigo-500/30">
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
                            <td class="px-6 py-4 font-medium text-white text-center">
                                <span class="badge-aktif" :class="{{ $avgPre }} < 70 ? 'badge-nonaktif' : 'badge-aktif'">
                                    <span :class="{{ $avgPre }} < 70 ? 'badge-nonaktif-dot' : 'badge-aktif-dot'"></span> {{ $avgPre }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-white text-center">
                                <span class="badge-aktif" :class="{{ $avgPost }} < 70 ? 'badge-nonaktif' : 'badge-aktif'">
                                    <span :class="{{ $avgPost }} < 70 ? 'badge-nonaktif-dot' : 'badge-aktif-dot'"></span> {{ $avgPost }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-white text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <svg class="w-4 h-4 text-amber-400 drop-shadow-[0_0_5px_rgba(251,191,36,0.5)]" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                    {{ $totalSkorPuzzle }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="openDetailNilai({ nis: '{{ $siswa->nomor_induk }}', nama: '{{ addslashes($siswa->nama) }}', details: {{ json_encode($detailMateri) }} })" 
                                        class="btn-indigo-outline px-3 py-1.5 text-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <p class="text-indigo-300 mb-4 font-medium">Belum ada siswa di kelas ini.</p>
                                    <button onclick="openModal('modal-tambah-siswa')" class="btn-indigo-solid">Undang Siswa Sekarang</button>
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
        <div x-show="isDetailModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-[rgba(10,16,32,0.95)] rounded-2xl border border-indigo-500/30 shadow-[0_0_50px_rgba(99,102,241,0.15)] w-full max-w-3xl flex flex-col relative z-50 overflow-hidden">
            <div class="px-6 py-5 border-b border-indigo-500/20 bg-indigo-500/10 flex justify-between items-start">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold text-lg border border-indigo-500/40" x-text="detailSiswa.inisial"></div>
                    <div>
                        <h2 class="text-xl font-bold text-white font-mono" x-text="detailSiswa.nama"></h2>
                        <p class="text-sm text-indigo-300 uppercase tracking-widest mt-1">NIS: <span x-text="detailSiswa.nis"></span></p>
                    </div>
                </div>
                <button @click="closeDetailModal()" class="text-indigo-400 hover:text-white p-2 rounded-lg hover:bg-indigo-500/20 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6 bg-[rgba(15,23,42,0.6)] max-h-[60vh] overflow-y-auto custom-scrollbar">
                <div x-show="isLoadingDetail" class="flex justify-center py-10">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-500"></div>
                </div>
                <div x-show="!isLoadingDetail">
                    <div class="data-table-wrap border border-indigo-500/20">
                        <table class="w-full divide-y divide-indigo-500/10">
                            <thead class="bg-indigo-500/5">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-indigo-300 uppercase tracking-wider font-mono">Materi</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-indigo-300 uppercase tracking-wider font-mono">Pre-Test</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-indigo-300 uppercase tracking-wider font-mono">Post-Test</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-indigo-500/10 text-gray-300">
                                <template x-for="nilai in detailNilaiMateri" :key="nilai.materi_id">
                                    <tr class="hover:bg-indigo-500/5 transition-colors">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white" x-text="nilai.judul_materi"></div>
                                            <div class="text-xs text-indigo-300/70">Materi ke-<span x-text="nilai.urutan"></span></div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold border font-mono" :class="nilai.pre_test === null ? 'bg-indigo-500/5 text-indigo-300/50 border-indigo-500/10' : (nilai.pre_test < 70 ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20')">
                                                <span class="w-1.5 h-1.5 rounded-full" :class="nilai.pre_test === null ? 'bg-indigo-300/30' : (nilai.pre_test < 70 ? 'bg-red-400' : 'bg-emerald-400')"></span>
                                                <span x-text="nilai.pre_test !== null ? nilai.pre_test : 'Belum Tes'"></span>
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold border font-mono" :class="nilai.post_test === null ? 'bg-indigo-500/5 text-indigo-300/50 border-indigo-500/10' : (nilai.post_test < 70 ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20')">
                                                <span class="w-1.5 h-1.5 rounded-full" :class="nilai.post_test === null ? 'bg-indigo-300/30' : (nilai.post_test < 70 ? 'bg-red-400' : 'bg-emerald-400')"></span>
                                                <span x-text="nilai.post_test !== null ? nilai.post_test : 'Belum Tes'"></span>
                                            </span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-indigo-500/20 bg-indigo-500/10 flex justify-end">
                <button @click="closeDetailModal()" class="btn-indigo-outline">Tutup</button>
            </div>
        </div>
    </div>
<!-- ========================================== -->
<!-- MODAL 1: CARI & PILIH SISWA               -->
<!-- ========================================== -->
<div id="modal-tambah-siswa" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="bg-[rgba(10,16,32,0.95)] border border-indigo-500/30 relative rounded-2xl shadow-[0_0_50px_rgba(99,102,241,0.15)] flex flex-col max-h-[80vh]">

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-5 shrink-0 border-b border-indigo-500/20 bg-indigo-500/10 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-indigo-500/20 border border-indigo-500/40">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-white uppercase tracking-widest text-sm">Pilih Siswa</h3>
                </div>
                <button type="button" onclick="closeModal('modal-tambah-siswa')"
                        class="text-indigo-400 hover:text-white rounded-lg p-1.5 transition-colors bg-indigo-500/10 hover:bg-indigo-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

            <!-- Search Input -->
            <div class="p-4 shrink-0 border-b border-indigo-500/10 bg-[rgba(15,23,42,0.6)]">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <!-- Input search memanggil fungsi JS filterSiswa() -->
                    <input type="text" id="searchInput" onkeyup="filterSiswa()"
                           class="neon-input !pl-10"
                           placeholder="Ketik nama atau NIS siswa...">
                </div>
            </div>

            <!-- Daftar Siswa (Bisa di-scroll) -->
            <div class="p-2 overflow-y-auto grow custom-scrollbar bg-[rgba(15,23,42,0.4)] rounded-b-2xl">
                @forelse($calonSiswa as $siswa)
                    <!-- Saat diklik, panggil modal konfirmasi -->
                    <button type="button" onclick="openConfirmModal({{ $siswa->id }}, '{{ addslashes($siswa->nama) }}')"
                            class="siswa-item flex flex-col w-full text-left p-3 mb-1 rounded-lg transition-all border border-transparent hover:border-indigo-500/30 hover:bg-indigo-500/10 group">
                        <span class="font-medium text-gray-300 group-hover:text-white siswa-nama text-sm">{{ $siswa->nama }}</span>
                        <span class="text-xs text-indigo-300/70 group-hover:text-indigo-300/90 siswa-nis mt-0.5 font-mono tracking-widest">NIS: {{ $siswa->nomor_induk }}</span>
                    </button>
                @empty
                    <div class="p-8 text-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 bg-indigo-500/10 border border-indigo-500/20">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <p class="text-indigo-300/70 text-sm">Tidak ada siswa aktif yang belum mendapat kelas.</p>
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
        <div class="bg-[rgba(10,16,32,0.95)] border border-indigo-500/30 relative rounded-2xl shadow-[0_0_50px_rgba(99,102,241,0.2)] text-center p-6">

            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 bg-indigo-500/10 border border-indigo-500/20 shadow-inner">
                <svg class="text-indigo-400 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>

            <h3 class="mb-2 text-xl font-bold text-white font-mono uppercase tracking-widest">Masukkan ke Kelas?</h3>
            <p class="mb-6 text-sm text-indigo-200/70 leading-relaxed">
                Anda akan memasukkan<br>
                <strong id="confirm_nama_siswa" class="text-indigo-300 text-base block mt-2 mb-1"></strong>
                ke kelas ini.
            </p>

            <form action="{{ route('guru.subwilayah.assign_siswa', $subWilayah->id ?? $kelas->id) }}" method="POST" class="flex justify-center gap-3">
                @csrf
                <input type="hidden" name="siswa_id" id="confirm_siswa_id">

                <button type="button" onclick="closeModal('modal-confirm-assign')"
                        class="btn-indigo-outline">
                    Batal
                </button>
                <button type="submit"
                        class="btn-indigo-solid">
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

        const rows = document.querySelectorAll('tbody tr.data-table-row');

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

    // Added filterSiswa function for the "Pilih Siswa" modal search input
    function filterSiswa() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const items = document.querySelectorAll('.siswa-item');

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(filter)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function copyKode(text, buttonElement) {
        const showSuccessIcon = () => {
            const originalIcon = buttonElement.innerHTML;
            buttonElement.innerHTML = `<svg class="w-4 h-4 text-emerald-400 drop-shadow-[0_0_8px_rgba(16,185,129,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;
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
                background: '#0a1020',
                color: '#e2e8f0',
                confirmButtonColor: '#4f46e5',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    });
</script>
@endsection
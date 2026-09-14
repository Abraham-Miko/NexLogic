<!-- Asumsi Anda menggunakan layout ini, sesuaikan jika berbeda -->
@extends('layouts.guru')
@section('content')

<style>
    /* ── Bento Grid Cards ── */
    .bento-card {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        backdrop-filter: blur(8px);
    }
    .bento-card:hover { transform: translateY(-3px); }
    .bento-card::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 16px;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    /* Stat card variants */
    .bento-indigo {
        background: rgba(99, 102, 241, 0.05);
        border: 1px solid rgba(99, 102, 241, 0.15);
    }
    .bento-indigo:hover {
        border-color: rgba(99, 102, 241, 0.4);
        box-shadow: 0 0 32px rgba(99, 102, 241, 0.12), inset 0 0 32px rgba(99,102,241,0.03);
    }
    .bento-indigo::after { background: radial-gradient(circle at 50% 0%, rgba(99,102,241,0.06), transparent 70%); }
    .bento-indigo:hover::after { opacity: 1; }

    .bento-emerald {
        background: rgba(16, 185, 129, 0.05);
        border: 1px solid rgba(16, 185, 129, 0.15);
    }
    .bento-emerald:hover {
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 0 32px rgba(16, 185, 129, 0.12), inset 0 0 32px rgba(16,185,129,0.03);
    }
    .bento-emerald::after { background: radial-gradient(circle at 50% 0%, rgba(16,185,129,0.06), transparent 70%); }
    .bento-emerald:hover::after { opacity: 1; }

    .bento-blue {
        background: rgba(59, 130, 246, 0.05);
        border: 1px solid rgba(59, 130, 246, 0.15);
    }
    .bento-blue:hover {
        border-color: rgba(59, 130, 246, 0.4);
        box-shadow: 0 0 32px rgba(59, 130, 246, 0.12), inset 0 0 32px rgba(59,130,246,0.03);
    }
    .bento-blue::after { background: radial-gradient(circle at 50% 0%, rgba(59,130,246,0.06), transparent 70%); }
    .bento-blue:hover::after { opacity: 1; }

    .bento-purple {
        background: rgba(124, 58, 237, 0.05);
        border: 1px solid rgba(124, 58, 237, 0.15);
    }
    .bento-purple:hover {
        border-color: rgba(124, 58, 237, 0.4);
        box-shadow: 0 0 32px rgba(124, 58, 237, 0.12), inset 0 0 32px rgba(124,58,237,0.03);
    }
    .bento-purple::after { background: radial-gradient(circle at 50% 0%, rgba(124,58,237,0.06), transparent 70%); }
    .bento-purple:hover::after { opacity: 1; }

    /* ── Stat Icon ── */
    .stat-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
    }

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

    /* ── Region Cards ── */
    .region-card {
        position: relative;
        background: rgba(10, 16, 32, 0.7);
        border: 1px solid rgba(99, 102, 241, 0.1);
        border-radius: 16px;
        backdrop-filter: blur(8px);
        overflow: hidden;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .region-card:hover {
        border-color: rgba(99, 102, 241, 0.25);
        box-shadow: 0 0 40px rgba(99, 102, 241, 0.07);
    }
    .region-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(to right, transparent, rgba(99,102,241,0.3), transparent);
    }

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
    .breadcrumb span {
        font-size: 16px;
        color: #f8fafc;
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
</style>

<div class="p-8" style="min-height: 100%;">
    <div class="max-w-7xl mx-auto">
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
                <span>Overview</span>
            </div>
        </div>

        <!-- ── Page Header ── -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <div class="page-header-badge">
                    <span class="page-header-badge-dot"></span>
                    Dashboard Ruang Guru
                </div>
                <h1 class="text-3xl font-bold text-white" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 24px rgba(129,140,248,0.2);">
                    Overview
                </h1>
                <p class="text-slate-500 mt-1">Kelola kelas dan pantau perkembangan siswa Anda.</p>
            </div>
            @if(count($daftarWilayah) > 0)
            <!-- Tombol Tambah Wilayah (Hanya muncul jika sudah punya minimal 1 wilayah) -->
            <button onclick="document.getElementById('modal-join').classList.remove('hidden')" class="btn-indigo-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Gabung Wilayah Lain
            </button>
            @endif
        </div>

        <!-- ========================================== -->
        <!-- BENTO GRID: KARTU STATISTIK UTAMA -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- Card 1: Total Kelas -->
            <div class="bento-card bento-purple p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Total Kelas</p>
                @php
                    $totalKelas = Auth::user()->kelasYangDiampu->count();
                @endphp
                <h3 class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $totalKelas }}</h3>
            </div>

            <!-- Card 2: Total Siswa -->
            <div class="bento-card bento-indigo p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Siswa Terdaftar</p>
                @php
                    $totalSiswa = Auth::user()->kelasYangDiampu->sum(function($kelas) {
                        return $kelas->siswa->count();
                    });
                @endphp
                <h3 class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $totalSiswa }}</h3>
            </div>

            <!-- Card 3: Wilayah Terhubung -->
            <div class="bento-card bento-emerald p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon text-emerald-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Wilayah Diikuti</p>
                <h3 class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ count($daftarWilayah) }}</h3>
            </div>

        </div>

        <!-- PESAN SUKSES/ERROR -->
        @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('error') }}
        </div>
        @endif

        <!-- KONTEN UTAMA -->
        @if(count($daftarWilayah) == 0)
            <!-- KONDISI 1: BELUM PUNYA WILAYAH SAMA SEKALI (EMPTY STATE) -->
            <div class="flex flex-col items-center justify-center mt-12">
                <div class="text-center max-w-md w-full bg-gray-900/50 p-8 rounded-2xl border border-gray-800 backdrop-blur-sm">
                    <div class="bg-indigo-500/10 p-4 rounded-full inline-block mb-4 border border-indigo-500/20">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4v-3.252l1.4-1.4a1.5 1.5 0 012.122 0l1.414 1.414a1.5 1.5 0 002.122 0l1.414-1.414a1.5 1.5 0 000-2.122l-1.414-1.414a1.5 1.5 0 010-2.122l1.4-1.4m6.603-3.603a6 6 0 00-8.486 8.486L4 17h2v2h2v2h3l4.318-4.318a6 6 0 008.486-8.486l-2.193-2.193z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Gabung ke Wilayah</h2>
                    <p class="text-gray-400 mb-6 text-sm">Anda belum mengelola wilayah manapun. Masukkan Kode Wilayah untuk memulai.</p>

                    <form action="/guru/wilayah/join" method="POST" class="flex flex-col gap-3">
                        @csrf
                        <input type="text" name="kode_wilayah" placeholder="Contoh: WL-RPL-2024" class="w-full bg-[rgba(15,23,42,0.8)] border border-indigo-500/20 text-white text-center px-4 py-3 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 uppercase transition-all" required>
                        <button type="submit" class="btn-indigo-solid w-full text-center flex justify-center py-3 text-sm">Verifikasi Kode</button>
                    </form>
                </div>
            </div>

        @else
            <!-- KONDISI 2: HYBRID DASHBOARD (MENAMPILKAN KARTU WILAYAH) -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @foreach($daftarWilayah as $wilayah)
                <div class="region-card p-6 flex flex-col h-full">

                    <!-- Info Jurusan/Wilayah -->
                    <div class="mb-5 flex flex-col items-start gap-2">
                        <span class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider bg-indigo-500/10 border border-indigo-500/20 px-2 py-1 rounded">Wilayah Terdaftar</span>
                        <h2 class="text-lg font-bold text-white truncate w-full" title="{{ $wilayah->nama_wilayah }}">{{ $wilayah->nama_wilayah }}</h2>
                    </div>

                    <!-- List Kelas (Sub Wilayah) -->
                    <div class="flex-grow mb-5">
                        @php
                            // Filter pintar: Hanya ambil kelas yang berada di wilayah ini DAN diajar oleh guru ini
                            $kelasDiWilayahIni = Auth::user()->kelasYangDiampu->where('wilayah_id', $wilayah->id);
                        @endphp

                        @if($kelasDiWilayahIni->count() > 0)
                            <div class="space-y-2">
                                @foreach($kelasDiWilayahIni as $kelas)
                                <a href="{{ route('guru.subwilayah.show', $kelas->id) }}" class="flex items-center justify-between p-3 rounded-lg bg-indigo-500/5 hover:bg-indigo-500/10 group border border-indigo-500/10 hover:border-indigo-500/30 transition-all">
                                <div class="flex items-center justify-between w-full group">
                                        <!-- Sisi Kiri: Icon dan Nama Kelas -->
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-md bg-indigo-500/10 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-500/20 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-sm text-gray-300 group-hover:text-white transition-colors">
                                                {{ $kelas->nama_sub_wilayah }}
                                            </span>
                                        </div>
                                    </div>
                                    <svg class="w-4 h-4 text-indigo-400/50 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                                @endforeach
                            </div>
                        @else
                            <div class="h-full flex flex-col items-center justify-center p-4 border-2 border-dashed border-indigo-500/20 rounded-xl bg-indigo-500/5">
                                <p class="text-xs text-indigo-300/60 text-center">Belum ada kelas yang Anda kelola di wilayah ini.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Tombol Buat Kelas -->
                    <div class="pt-4 border-t border-indigo-500/10">
                        <button onclick="openModalCreateKelas('{{ $wilayah->id }}', '{{ $wilayah->nama_wilayah }}')"
                                class="btn-indigo-outline w-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Kelas Baru
                        </button>
                    </div>

                </div>
                @endforeach

            </div>
        @endif
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL GABUNG WILAYAH (Hidden by default) -->
<!-- ========================================== -->
<div id="modal-join" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-[rgba(10,16,32,0.9)] border border-indigo-500/20 p-6 rounded-2xl w-full max-w-sm relative shadow-2xl">
        <!-- Tombol Close Modal -->
        <button onclick="document.getElementById('modal-join').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <h3 class="text-lg font-bold text-white mb-1">Gabung Wilayah Lain</h3>
        <p class="text-sm text-gray-400 mb-4">Masukkan kode wilayah baru Anda.</p>

        <form action="/guru/wilayah/join" method="POST" class="flex flex-col gap-3">
            @csrf
            <input type="text" name="kode_wilayah" placeholder="Kode Wilayah" class="bg-[rgba(15,23,42,0.8)] border border-indigo-500/20 text-white px-4 py-2 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 uppercase transition-all" required>
            <button type="submit" class="btn-indigo-solid w-full text-center flex justify-center mt-2">Gabung</button>
        </form>
    </div>
</div>
<!-- MODAL BUAT KELAS -->
<div id="modal-create-kelas" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-[rgba(10,16,32,0.9)] border border-indigo-500/20 rounded-2xl w-full max-w-md overflow-hidden shadow-2xl">
        <!-- Header -->
        <div class="bg-indigo-500/10 px-6 py-4 border-b border-indigo-500/20 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-white">Buat Kelas Baru</h3>
                <p id="display-nama-wilayah" class="text-xs text-indigo-300"></p>
            </div>
            <button onclick="closeModalCreateKelas()" class="text-indigo-400 hover:text-indigo-300 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Form -->
        <form action="{{ route('guru.subwilayah.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="wilayah_id" id="input-wilayah-id">

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Nama Sub Wilayah</label>
                <input type="text" name="nama_sub_wilayah"
                       placeholder="Contoh: 10-TKJ-AA"
                       class="w-full bg-[rgba(15,23,42,0.8)] border border-indigo-500/20 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 uppercase transition-all"
                       required>
                <p class="mt-2 text-[10px] text-gray-500 italic">Sistem akan mencatat Anda sebagai pengampu kelas ini.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Kode Sub Wilayah</label>
                <input type="text" name="kode_sub_wilayah"
                       placeholder="Contoh: TYF-78"
                       class="w-full bg-[rgba(15,23,42,0.8)] border border-indigo-500/20 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 uppercase transition-all"
                       required>
                <p class="mt-2 text-[10px] text-gray-500 italic">Kode harus berbeda. Inputan otomatis kapital.</p>
            </div>

            <button type="submit" class="btn-indigo-solid w-full text-center flex justify-center py-2.5 mt-2">
                Simpan Kelas
            </button>
        </form>
    </div>
</div>

<script>
    function openModalCreateKelas(id, nama) {
        document.getElementById('input-wilayah-id').value = id;
        document.getElementById('display-nama-wilayah').innerText = "Wilayah: " + nama;
        document.getElementById('modal-create-kelas').classList.remove('hidden');
    }

    function closeModalCreateKelas() {
        document.getElementById('modal-create-kelas').classList.add('hidden');
    }
</script>

@endsection


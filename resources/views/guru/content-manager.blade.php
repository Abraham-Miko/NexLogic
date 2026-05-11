@extends('layouts.guru')

@section('content')

<style>
    /* ── Common Styles ── */
    .bento-card {
        position: relative;
        background: rgba(10, 16, 32, 0.7);
        border: 1px solid rgba(99, 102, 241, 0.1);
        border-radius: 16px;
        backdrop-filter: blur(8px);
        overflow: hidden;
        transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
    }
    .bento-card:hover {
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 0 30px rgba(99, 102, 241, 0.1);
        transform: translateY(-2px);
    }
    .bento-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(to right, transparent, rgba(99,102,241,0.3), transparent);
    }

    .neon-action-btn {
        background: rgba(99,102,241,0.05);
        border: 1px solid rgba(99,102,241,0.2);
        transition: all 0.25s ease;
    }
    .neon-action-btn:hover {
        background: rgba(99,102,241,0.1);
        border-color: rgba(99,102,241,0.4);
        box-shadow: 0 0 15px rgba(99,102,241,0.15);
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
    }
    .neon-select:focus {
        border-color: rgba(99, 102, 241, 0.6);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    .neon-select option { background: #0f172a; }

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
</style>

<div class="p-8 text-white min-h-screen" x-data="contentManager()">
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
                <span>Content Manager</span>
            </div>
        </div>
        
        <!-- Header Page -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <div class="page-header-badge">
                    <span class="page-header-badge-dot"></span>
                    Content Manager
                </div>
                <h1 class="text-3xl font-bold text-white mb-2" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 24px rgba(129,140,248,0.2);">Kelola Materi</h1>
                <p class="text-slate-500 text-sm md:text-base mt-1">Kelola materi pembelajaran, pre-test, dan post-test untuk setiap kelas (Sub Wilayah).</p>
            </div>
        </div>

        <!-- Filter Wilayah -->
        <div class="bg-[rgba(10,16,32,0.7)] p-6 rounded-2xl mb-8 border border-indigo-500/20 shadow-lg backdrop-blur-md">
            <label for="sub-wilayah" class="block text-sm font-medium text-indigo-300 mb-3 uppercase tracking-wider">Pilih Kelas / Sub Wilayah</label>
            <div class="relative w-full md:w-1/2">
                <select id="sub-wilayah" x-model="selectedKelasId" @change="fetchMateri()" class="neon-select w-full cursor-pointer">
                    <option value="" class="bg-[#0f172a] text-gray-300">-- Pilih Kelas untuk dikelola --</option>
                    @foreach($daftarKelas as $kelas)
                        <option value="{{ $kelas->id }}" class="bg-[#0f172a] text-gray-300">{{ $kelas->wilayah->nama_wilayah }} - {{ $kelas->nama_sub_wilayah }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-indigo-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div x-show="!selectedKelasId" class="text-center py-20 bg-indigo-500/5 border border-indigo-500/10 rounded-2xl backdrop-blur-md">
            <div class="w-20 h-20 bg-indigo-500/10 rounded-full flex items-center justify-center mx-auto mb-4 border border-indigo-500/20">
                <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-white" style="font-family: 'Orbitron', monospace;">Pilih Kelas</h3>
            <p class="text-slate-400 mt-2">Pilih kelas di atas untuk mulai mengelola materi dan soal.</p>
        </div>

        <!-- Loading State -->
        <div x-show="isLoading" class="text-center py-20" style="display: none;">
            <div class="inline-block animate-spin rounded-full h-10 w-10 border-b-2 border-indigo-500"></div>
            <p class="text-indigo-300 mt-4 font-mono text-sm uppercase tracking-widest">Memuat data...</p>
        </div>

        <!-- Daftar Materi (Grid) -->
        <div x-show="selectedKelasId && !isLoading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" style="display: none;">
            
            <template x-for="item in materiList" :key="item.materi_ke">
                <div class="bento-card flex flex-col group relative">
                    <div class="p-6 flex-grow relative z-10">
                        
                        <div class="flex justify-between items-start mb-5">
                            <span x-show="item.is_aktif" class="bg-emerald-500/10 text-emerald-400 text-xs font-bold px-3 py-1 rounded-full border border-emerald-500/20 shadow-[0_0_10px_rgba(16,185,129,0.1)]">
                                <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1 align-middle animate-pulse"></span> Aktif
                            </span>
                            <span x-show="!item.is_aktif" class="bg-slate-700/50 text-slate-300 text-xs font-bold px-3 py-1 rounded-full border border-slate-600">
                                Draft
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2 leading-tight" x-text="item.judul"></h3>
                        <p class="text-sm text-indigo-300 mb-6 font-mono">Materi Pembelajaran ke-<span x-text="item.materi_ke"></span></p>
                        
                        <!-- Pre-Test & Post-Test Area -->
                        <div class="space-y-3 mb-2">
                            <!-- Pre-Test -->
                            <button @click="openModal(item, 'pre_test')" class="neon-action-btn w-full flex items-center justify-between p-3.5 rounded-xl transition-all group/btn">
                                <div class="flex items-center gap-3">
                                    <template x-if="item.pre_test_count > 0">
                                        <div class="w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </template>
                                    <template x-if="item.pre_test_count == 0">
                                        <div class="w-8 h-8 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-500 border border-amber-500/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                    </template>
                                    <span class="text-sm font-medium text-gray-300 group-hover/btn:text-white transition-colors">Kelola Pre-Test</span>
                                </div>
                                <span x-show="item.pre_test_count > 0" class="text-xs font-medium text-indigo-300 bg-indigo-500/10 border border-indigo-500/20 px-2.5 py-1 rounded-full"><span x-text="item.pre_test_count"></span> Soal</span>
                                <span x-show="item.pre_test_count == 0" class="text-xs text-amber-500/80 italic font-medium">Belum ada</span>
                            </button>
                            
                            <!-- Post-Test -->
                            <button @click="openModal(item, 'post_test')" class="neon-action-btn w-full flex items-center justify-between p-3.5 rounded-xl transition-all group/btn">
                                <div class="flex items-center gap-3">
                                    <template x-if="item.post_test_count > 0">
                                        <div class="w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </template>
                                    <template x-if="item.post_test_count == 0">
                                        <div class="w-8 h-8 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-500 border border-amber-500/20">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                    </template>
                                    <span class="text-sm font-medium text-gray-300 group-hover/btn:text-white transition-colors">Kelola Post-Test</span>
                                </div>
                                <span x-show="item.post_test_count > 0" class="text-xs font-medium text-indigo-300 bg-indigo-500/10 border border-indigo-500/20 px-2.5 py-1 rounded-full"><span x-text="item.post_test_count"></span> Soal</span>
                                <span x-show="item.post_test_count == 0" class="text-xs text-amber-500/80 italic font-medium">Belum ada</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Footer / Action Area -->
                    <div class="px-6 py-4 border-t border-indigo-500/10 bg-indigo-500/5 flex flex-col justify-center relative z-10">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2" :class="item.can_activate ? 'text-gray-300' : 'text-slate-500'">
                                <span class="text-sm font-medium uppercase tracking-wider text-[10px]">Akses Siswa</span>
                                <svg x-show="!item.can_activate" class="w-3 h-3 text-amber-500/70" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            </div>
                            
                            <!-- Toggle Switch -->
                            <div class="relative inline-block w-12 mr-1 align-middle select-none transition duration-200 ease-in" :class="!item.can_activate ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'">
                                <input type="checkbox" :id="'toggle' + item.materi_ke" class="absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none z-10 transition-all right-0" 
                                       :class="item.is_aktif ? 'border-emerald-500 right-0 shadow-[0_0_10px_rgba(16,185,129,0.8)]' : 'border-slate-500 left-0'"
                                       :disabled="!item.can_activate" 
                                       :checked="item.is_aktif"
                                       @change="toggleAktifasi(item)"
                                       style="top: 0; outline: none; box-shadow: none;"/>
                                <label :for="'toggle' + item.materi_ke" class="block overflow-hidden h-6 rounded-full transition-colors"
                                       :class="item.is_aktif ? 'bg-emerald-500' : 'bg-slate-700'"
                                       :style="item.can_activate ? 'cursor: pointer;' : 'cursor: not-allowed;'"></label>
                            </div>
                        </div>
                        
                        <div x-show="!item.can_activate" class="flex items-start gap-1.5 mt-1">
                            <svg class="w-3 h-3 text-amber-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <p class="text-[11px] text-amber-500/90 leading-tight">
                                Lengkapi Pre-test dan Post-test untuk mengaktifkan materi.
                            </p>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- MODAL "Kelola Soal" -->
        <div x-show="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 sm:px-0" style="display: none;">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>
            
            <!-- Modal Container -->
            <div class="bg-[rgba(10,16,32,0.95)] rounded-2xl border border-indigo-500/30 shadow-[0_0_50px_rgba(99,102,241,0.15)] w-full max-w-4xl max-h-[90vh] flex flex-col relative z-50 overflow-hidden">
                
                <!-- Modal Header -->
                <div class="px-6 py-5 border-b border-indigo-500/20 flex justify-between items-center bg-indigo-500/10">
                    <div class="flex gap-4 items-center">
                        <div class="w-12 h-12 rounded-xl bg-indigo-500/20 flex items-center justify-center shadow-inner border border-indigo-500/40 text-indigo-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white leading-none mb-1.5" style="font-family: 'Orbitron', monospace;">
                                Kelola Soal <span class="text-indigo-400" x-text="activeTestType == 'pre_test' ? 'PRE-TEST' : 'POST-TEST'"></span>
                            </h2>
                            <p class="text-xs text-indigo-300/70 uppercase tracking-widest font-mono">Materi: <span class="font-bold text-indigo-300" x-text="activeMateri.judul"></span></p>
                        </div>
                    </div>
                    <button @click="closeModal()" class="text-indigo-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-indigo-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div class="p-6 overflow-y-auto flex-grow flex flex-col md:flex-row gap-6 custom-scrollbar">
                    
                    <!-- Kiri: Form Tambah Soal -->
                    <div class="flex-1">
                        <div class="bg-[rgba(15,23,42,0.6)] border border-indigo-500/10 rounded-xl p-6 shadow-sm mb-6 relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent rounded-xl pointer-events-none"></div>
                            <div class="flex justify-between items-center mb-6 relative z-10">
                                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-widest">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.8)]"></span>
                                    Tambah Soal Baru
                                </h3>
                                
                                <!-- Tombol Copy Soal -->
                                <button @click="openCopyModal()" class="text-xs bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-300 px-3 py-1.5 rounded-lg border border-indigo-500/30 transition flex items-center gap-1.5 font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    Copy dari Kelas Lain
                                </button>
                            </div>
                            
                            <form @submit.prevent="saveSoal" class="relative z-10">
                                <!-- Pertanyaan -->
                                <div class="mb-5">
                                    <label class="block text-xs font-medium text-indigo-300 mb-2 uppercase tracking-wider">Pertanyaan</label>
                                    <textarea x-model="formSoal.soal" required rows="3" class="w-full bg-[rgba(10,16,32,0.8)] border border-indigo-500/20 text-white text-sm rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all block p-3.5 placeholder-slate-600 shadow-inner" placeholder="Ketik pertanyaan di sini..."></textarea>
                                </div>

                                <!-- Pilihan Ganda -->
                                <div class="mb-6">
                                    <label class="block text-xs font-medium text-indigo-300 mb-3 uppercase tracking-wider flex justify-between items-center">
                                        <span>Pilihan Jawaban</span>
                                        <span class="text-[10px] text-indigo-300/70 bg-indigo-500/10 border border-indigo-500/20 px-2 py-0.5 rounded">Tandai untuk jawaban benar</span>
                                    </label>
                                    <div class="space-y-3">
                                        <template x-for="opt in ['A', 'B', 'C', 'D']">
                                            <div class="flex items-center gap-3 bg-[rgba(10,16,32,0.8)] p-2 rounded-xl border transition-all group" :class="formSoal.jawaban_benar == opt ? 'border-emerald-500/50 bg-emerald-500/5 shadow-[0_0_15px_rgba(16,185,129,0.1)]' : 'border-indigo-500/10 focus-within:border-indigo-500/50'">
                                                <div class="flex items-center justify-center w-8 h-8 shrink-0 relative">
                                                    <input type="radio" name="correct_answer" :value="opt" x-model="formSoal.jawaban_benar" required class="w-5 h-5 text-emerald-500 bg-transparent border-slate-600 focus:ring-emerald-500 cursor-pointer appearance-none checked:bg-emerald-500 checked:border-emerald-500 rounded-full transition-all">
                                                    <div x-show="formSoal.jawaban_benar == opt" class="absolute w-2 h-2 bg-white rounded-full pointer-events-none"></div>
                                                </div>
                                                <span class="font-bold w-6 transition-colors font-mono text-lg" :class="formSoal.jawaban_benar == opt ? 'text-emerald-400' : 'text-slate-500'" x-text="opt + '.'"></span>
                                                <input type="text" :placeholder="'Masukkan opsi ' + opt + '...'" 
                                                       x-model="formSoal['opsi_' + opt.toLowerCase()]" required
                                                       class="w-full bg-transparent border-none text-white text-sm focus:ring-0 p-1.5 placeholder-slate-600 outline-none">
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                
                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="btn-indigo-solid w-full md:w-auto" :disabled="isSaving">
                                        <svg x-show="!isSaving" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                        <svg x-show="isSaving" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <span x-text="isSaving ? 'Menyimpan...' : 'Simpan Soal'"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Kanan: Daftar Soal -->
                    <div class="flex-1 flex flex-col">
                        <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2 uppercase tracking-widest border-b border-indigo-500/20 pb-3">
                            <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            Daftar Soal 
                            <span class="bg-indigo-500/20 text-indigo-300 text-[10px] px-2 py-0.5 rounded-full ml-1 border border-indigo-500/30 font-mono" x-text="daftarSoal.length"></span>
                        </h3>
                        
                        <div x-show="isLoadingSoal" class="text-center py-10">
                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-500"></div>
                        </div>

                        <div x-show="!isLoadingSoal && daftarSoal.length == 0" class="text-center py-10 bg-indigo-500/5 border border-indigo-500/20 border-dashed rounded-xl">
                            <p class="text-sm text-indigo-300/60 font-medium">Belum ada soal untuk tes ini.</p>
                        </div>

                        <div x-show="!isLoadingSoal && daftarSoal.length > 0" class="space-y-4 overflow-y-auto pr-2 custom-scrollbar" style="max-height: 500px;">
                            <template x-for="(soal, index) in daftarSoal" :key="soal.id">
                                <div class="bg-[rgba(15,23,42,0.6)] border border-indigo-500/20 p-5 rounded-xl relative group hover:border-indigo-500/50 transition-colors shadow-sm">
                                    <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button @click="deleteSoal(soal.id)" class="w-8 h-8 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 hover:text-white hover:bg-red-500 hover:border-red-500 flex items-center justify-center transition-all" title="Hapus Soal">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                    <div class="flex items-start gap-3 mb-4 pr-10">
                                        <div class="w-6 h-6 rounded-md bg-indigo-500/20 text-indigo-300 flex items-center justify-center text-xs font-bold font-mono border border-indigo-500/30 shrink-0 mt-0.5">
                                            <span x-text="index + 1"></span>
                                        </div>
                                        <p class="text-sm text-white font-medium leading-relaxed" x-text="soal.soal"></p>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 gap-2 text-sm text-slate-300 ml-9">
                                        <template x-for="opt in ['A', 'B', 'C', 'D']">
                                            <div class="flex gap-2 items-start p-2 rounded-lg border transition-colors" :class="soal.jawaban_benar == opt ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400 shadow-[0_0_10px_rgba(16,185,129,0.05)]' : 'bg-[rgba(10,16,32,0.5)] border-transparent'">
                                                <span class="font-bold font-mono" :class="soal.jawaban_benar == opt ? 'text-emerald-500' : 'text-slate-500'" x-text="opt + '.'"></span>
                                                <span x-text="soal['opsi_' + opt.toLowerCase()]"></span>
                                                <svg x-show="soal.jawaban_benar == opt" class="w-4 h-4 mt-0.5 ml-auto text-emerald-500 shrink-0 drop-shadow-[0_0_5px_rgba(16,185,129,0.8)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>
                
                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-indigo-500/20 bg-indigo-500/10 flex justify-end">
                    <button @click="closeModal()" class="btn-indigo-outline">
                        Tutup Panel
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL COPY SOAL -->
        <div x-show="isCopyModalOpen" class="fixed inset-0 z-[60] flex items-center justify-center px-4 py-6 sm:px-0" style="display: none;">
            <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" @click="isCopyModalOpen = false"></div>
            <div class="bg-[rgba(10,16,32,0.95)] rounded-2xl border border-indigo-500/30 shadow-[0_0_50px_rgba(99,102,241,0.2)] w-full max-w-lg flex flex-col relative z-50">
                <div class="px-6 py-5 border-b border-indigo-500/20 bg-indigo-500/10">
                    <h3 class="text-lg font-bold text-white uppercase tracking-widest text-sm flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.8)]"></span> Salin Soal</h3>
                    <p class="text-xs text-indigo-300 mt-2">Pilih kelas yang sudah memiliki soal <span class="font-bold text-white" x-text="activeTestType == 'pre_test' ? 'PRE-TEST' : 'POST-TEST'"></span> untuk materi ini.</p>
                </div>
                <div class="p-6">
                    <div x-show="isLoadingCopyOptions" class="text-center py-6">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-500"></div>
                    </div>
                    
                    <div x-show="!isLoadingCopyOptions && copyOptions.length == 0" class="text-center py-6 bg-amber-500/5 border border-amber-500/20 rounded-xl">
                        <svg class="w-8 h-8 text-amber-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <p class="text-sm text-amber-400 font-medium">Tidak ada sumber soal yang tersedia.</p>
                    </div>

                    <div x-show="!isLoadingCopyOptions && copyOptions.length > 0">
                        <label class="block text-xs font-medium text-indigo-300 mb-2 uppercase tracking-wider">Pilih Kelas Sumber</label>
                        <select x-model="selectedCopySource" class="neon-select w-full mb-6">
                            <option value="" class="bg-[#0f172a] text-gray-300">-- Pilih Kelas --</option>
                            <template x-for="opt in copyOptions" :key="opt.id">
                                <option :value="opt.id" class="bg-[#0f172a] text-gray-300" x-text="opt.wilayah.nama_wilayah + ' - ' + opt.nama_sub_wilayah" x-show="opt.id != selectedKelasId"></option>
                            </template>
                        </select>

                        <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-xl p-4 flex items-start gap-3">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-indigo-200/80 leading-relaxed"><strong>Perhatian:</strong> Menyalin soal akan menambahkan soal-soal tersebut ke dalam daftar soal di kelas ini tanpa menghapus soal yang sudah ada.</p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-indigo-500/20 bg-indigo-500/10 flex justify-end gap-3">
                    <button @click="isCopyModalOpen = false" class="btn-indigo-outline">Batal</button>
                    <button @click="executeCopy()" :disabled="!selectedCopySource || isExecutingCopy" class="btn-indigo-solid disabled:opacity-50">
                        <span x-show="!isExecutingCopy">Salin Soal</span>
                        <span x-show="isExecutingCopy" class="flex items-center gap-2">
                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Menyalin...
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="h-24 w-full"></div>
    </div>
</div>

<!-- Script Inline untuk Alpine.js yang sudah terhubung dengan resources/js/app.js -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('contentManager', () => ({
            selectedKelasId: '',
            isLoading: false,
            materiList: [],
            
            // Modal state
            isModalOpen: false,
            activeMateri: {},
            activeTestType: '', // pre_test or post_test
            
            // Form state
            formSoal: {
                soal: '',
                opsi_a: '',
                opsi_b: '',
                opsi_c: '',
                opsi_d: '',
                jawaban_benar: 'A'
            },
            isSaving: false,
            
            // Daftar soal state
            daftarSoal: [],
            isLoadingSoal: false,

            // Copy state
            isCopyModalOpen: false,
            copyOptions: [],
            isLoadingCopyOptions: false,
            selectedCopySource: '',
            isExecutingCopy: false,

            fetchMateri() {
                if (!this.selectedKelasId) {
                    this.materiList = [];
                    return;
                }
                
                this.isLoading = true;
                fetch(`/guru/content/kelas/${this.selectedKelasId}`)
                    .then(res => res.json())
                    .then(data => {
                        this.materiList = data.materi;
                        this.isLoading = false;
                    })
                    .catch(err => {
                        console.error(err);
                        this.isLoading = false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal memuat data kelas',
                            background: '#0a1020',
                            color: '#e2e8f0',
                            confirmButtonColor: '#4f46e5'
                        });
                    });
            },

            openModal(materi, type) {
                this.activeMateri = materi;
                this.activeTestType = type;
                this.isModalOpen = true;
                this.resetForm();
                this.fetchSoal();
            },

            closeModal() {
                this.isModalOpen = false;
                this.fetchMateri(); // Refresh list to update counts
            },

            resetForm() {
                this.formSoal = {
                    soal: '',
                    opsi_a: '',
                    opsi_b: '',
                    opsi_c: '',
                    opsi_d: '',
                    jawaban_benar: 'A'
                };
            },

            fetchSoal() {
                this.isLoadingSoal = true;
                fetch(`/guru/content/soal/${this.selectedKelasId}/${this.activeMateri.materi_ke}/${this.activeTestType}`)
                    .then(res => res.json())
                    .then(data => {
                        this.daftarSoal = data.data;
                        this.isLoadingSoal = false;
                    })
                    .catch(err => {
                        console.error(err);
                        this.isLoadingSoal = false;
                    });
            },

            saveSoal() {
                this.isSaving = true;
                const payload = {
                    _token: '{{ csrf_token() }}',
                    sub_wilayah_id: this.selectedKelasId,
                    materi_ke: this.activeMateri.materi_ke,
                    jenis_soal: this.activeTestType,
                    ...this.formSoal
                };

                fetch(`/guru/content/soal`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    this.isSaving = false;
                    if(data.message) {
                        this.resetForm();
                        this.fetchSoal();
                        
                        // Update local count temporarily for visual feedback
                        if(this.activeTestType === 'pre_test') this.activeMateri.pre_test_count++;
                        else this.activeMateri.post_test_count++;
                    }
                })
                .catch(err => {
                    console.error(err);
                    this.isSaving = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menyimpan soal',
                        background: '#0a1020',
                        color: '#e2e8f0',
                        confirmButtonColor: '#4f46e5'
                    });
                });
            },

            deleteSoal(id) {
                Swal.fire({
                    title: 'Hapus Soal?',
                    text: "Soal yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#334155',
                    confirmButtonText: 'Ya, Hapus!',
                    background: '#0a1020',
                    color: '#e2e8f0'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/guru/content/soal/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(() => {
                            this.fetchSoal();
                            // Update local count temporarily
                            if(this.activeTestType === 'pre_test') this.activeMateri.pre_test_count--;
                            else this.activeMateri.post_test_count--;
                        })
                        .catch(err => {
                            console.error(err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Gagal menghapus soal',
                                background: '#0a1020',
                                color: '#e2e8f0',
                                confirmButtonColor: '#4f46e5'
                            });
                        });
                    }
                });
            },

            toggleAktifasi(materi) {
                if(!materi.can_activate) return;

                const newStatus = !materi.is_aktif;
                
                fetch(`/guru/content/toggle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        sub_wilayah_id: this.selectedKelasId,
                        materi_ke: materi.materi_ke,
                        is_aktif: newStatus
                    })
                })
                .then(async res => {
                    if (!res.ok) {
                        const err = await res.json();
                        throw new Error(err.message || 'Gagal memperbarui status');
                    }
                    return res.json();
                })
                .then(data => {
                    materi.is_aktif = newStatus;
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: err.message,
                        background: '#0a1020',
                        color: '#e2e8f0',
                        confirmButtonColor: '#4f46e5'
                    });
                    // Revert UI toggle if failed (Alpine binding will update on next tick, but just to be sure we fetch again)
                    this.fetchMateri();
                });
            },

            openCopyModal() {
                this.isCopyModalOpen = true;
                this.isLoadingCopyOptions = true;
                this.selectedCopySource = '';
                
                fetch(`/guru/content/copy-options/${this.activeMateri.materi_ke}/${this.activeTestType}`)
                    .then(res => res.json())
                    .then(data => {
                        this.copyOptions = data.data;
                        this.isLoadingCopyOptions = false;
                    })
                    .catch(err => {
                        console.error(err);
                        this.isLoadingCopyOptions = false;
                    });
            },

            executeCopy() {
                if(!this.selectedCopySource) return;
                
                this.isExecutingCopy = true;
                
                fetch(`/guru/content/copy-soal`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        source_sub_wilayah_id: this.selectedCopySource,
                        target_sub_wilayah_id: this.selectedKelasId,
                        materi_ke: this.activeMateri.materi_ke,
                        jenis_soal: this.activeTestType
                    })
                })
                .then(res => res.json())
                .then(data => {
                    this.isExecutingCopy = false;
                    this.isCopyModalOpen = false;
                    this.fetchSoal();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Soal berhasil disalin',
                        background: '#0a1020',
                        color: '#e2e8f0',
                        confirmButtonColor: '#4f46e5'
                    });
                })
                .catch(err => {
                    console.error(err);
                    this.isExecutingCopy = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menyalin soal',
                        background: '#0a1020',
                        color: '#e2e8f0',
                        confirmButtonColor: '#4f46e5'
                    });
                });
            }
        }));
    });
</script>

<style>
    /* Custom Scrollbar for Modal */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(10, 16, 32, 0.5);
        border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(99, 102, 241, 0.3);
        border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(99, 102, 241, 0.5);
    }
</style>
@endsection

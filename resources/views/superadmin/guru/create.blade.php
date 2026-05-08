@extends('layouts.superadmin')

@section('content')

<style>
    /* ── Neon Input Focus ── */
    .neon-input {
        background: rgba(8, 14, 26, 0.8);
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: #e2e8f0;
        border-radius: 10px;
        padding: 10px 16px;
        width: 100%;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        outline: none;
        backdrop-filter: blur(4px);
    }
    .neon-input::placeholder { color: #475569; }
    .neon-input:focus {
        border-color: rgba(99, 102, 241, 0.7);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15), 0 0 20px rgba(99, 102, 241, 0.1);
    }
    .neon-input.error {
        border-color: rgba(239, 68, 68, 0.6);
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    /* ── Glass Card ── */
    .glass-card {
        background: rgba(15, 23, 42, 0.7);
        border: 1px solid rgba(99, 102, 241, 0.15);
        border-radius: 16px;
        backdrop-filter: blur(12px);
        position: relative;
        overflow: hidden;
    }
    .glass-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.04) 0%, transparent 60%);
        pointer-events: none;
    }
    /* Green accent for guru */
    .glass-card-green {
        background: rgba(15, 23, 42, 0.7);
        border: 1px solid rgba(16, 185, 129, 0.15);
        border-radius: 16px;
        backdrop-filter: blur(12px);
        position: relative;
        overflow: hidden;
    }
    .glass-card-green::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.04) 0%, transparent 60%);
        pointer-events: none;
    }

    /* ── Select ── */
    .neon-select {
        background: rgba(8, 14, 26, 0.8);
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: #e2e8f0;
        border-radius: 10px;
        padding: 10px 16px;
        width: 100%;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        outline: none;
        appearance: none;
        cursor: pointer;
    }
    .neon-select:focus {
        border-color: rgba(99, 102, 241, 0.7);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15), 0 0 20px rgba(99, 102, 241, 0.1);
    }
    .neon-select option { background: #0f172a; }

    /* ── Radio ── */
    .neon-radio-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px solid rgba(99, 102, 241, 0.15);
        color: #94a3b8;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }
    .neon-radio-label:has(input:checked) {
        border-color: rgba(99, 102, 241, 0.5);
        background: rgba(99, 102, 241, 0.08);
        color: #a5b4fc;
        box-shadow: 0 0 12px rgba(99, 102, 241, 0.1);
    }
    .neon-radio-label:hover {
        border-color: rgba(99, 102, 241, 0.35);
        color: #c7d2fe;
    }
    input[type="radio"].neon-radio {
        accent-color: #6366f1;
        width: 16px;
        height: 16px;
    }

    /* ── Submit Button ── */
    .btn-neon-green {
        width: 100%;
        padding: 13px 20px;
        border-radius: 12px;
        background: linear-gradient(135deg, #059669, #10b981);
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
        border: 1px solid rgba(16, 185, 129, 0.4);
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.3), 0 4px 15px rgba(16, 185, 129, 0.2);
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        letter-spacing: 0.02em;
    }
    .btn-neon-green:hover {
        background: linear-gradient(135deg, #047857, #059669);
        box-shadow: 0 0 30px rgba(16, 185, 129, 0.45), 0 4px 20px rgba(16, 185, 129, 0.3);
        transform: translateY(-1px);
    }
    .btn-neon-green:active { transform: translateY(0); }

    /* ── Import Button ── */
    .btn-neon-outline-indigo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        background: rgba(99, 102, 241, 0.06);
        border: 1px solid rgba(99, 102, 241, 0.3);
        color: #a5b4fc;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .btn-neon-outline-indigo:hover {
        background: rgba(99, 102, 241, 0.12);
        border-color: rgba(99, 102, 241, 0.55);
        box-shadow: 0 0 16px rgba(99, 102, 241, 0.15);
    }

    /* ── Back Button ── */
    .btn-back {
        padding: 9px 12px;
        border-radius: 10px;
        background: rgba(15, 23, 42, 0.7);
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: #64748b;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        text-decoration: none;
    }
    .btn-back:hover {
        background: rgba(99, 102, 241, 0.08);
        border-color: rgba(99, 102, 241, 0.4);
        color: #a5b4fc;
        box-shadow: 0 0 12px rgba(99, 102, 241, 0.1);
    }

    /* ── Section Title ── */
    .card-section-title {
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #64748b;
        padding-bottom: 12px;
        margin-bottom: 16px;
        border-bottom: 1px solid rgba(99, 102, 241, 0.12);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-section-title-green {
        border-bottom-color: rgba(16, 185, 129, 0.12);
    }
    .card-section-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #6366f1;
        box-shadow: 0 0 8px rgba(99, 102, 241, 0.8);
        flex-shrink: 0;
    }
    .card-section-dot-green {
        background: #10b981;
        box-shadow: 0 0 8px rgba(16, 185, 129, 0.8);
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
    .breadcrumb p {
        font-size: 16px;
        color: #9ca3af;
    }
    .breadcrumb span {
        font-size: 16px;
        color: #f8fafc;
    }
</style>

<div class="p-8" style="background: radial-gradient(ellipse at top left, rgba(16,185,129,0.04) 0%, transparent 60%), #080e1a; min-height: 100%;">
    <div class="max-w-5xl mx-auto">
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
                <p>Manajemen Akun</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('superadmin.guru') }}">Guru</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span>Tambah</span>
            </div>
        </div>
        
        <!-- ── Page Header ── -->
        <div class="flex items-center gap-4 mb-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-2 h-2 rounded-full bg-emerald-400" style="box-shadow: 0 0 8px rgba(52,211,153,0.8);"></div>
                    <span class="text-xs font-mono text-emerald-400 tracking-widest uppercase">Manajemen Guru</span>
                </div>
                <h2 class="text-2xl font-bold text-white" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 20px rgba(16,185,129,0.3);">
                    Tambah Guru Baru
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">Masukkan identitas dan kredensial login untuk Guru.</p>
            </div>
        </div>

        <!-- ── Form ── -->
        <form action="{{ route('superadmin.guru.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- KOLOM KIRI: Informasi Personal -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="glass-card-green p-6">
                        <div class="card-section-title card-section-title-green">
                            <span class="card-section-dot card-section-dot-green"></span>
                            Informasi Personal
                        </div>

                        <div class="space-y-5">
                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 tracking-wide uppercase">
                                    Nama Lengkap <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                       placeholder="Contoh: Budi Santoso" required
                                       class="neon-input @error('nama') error @enderror">
                                @error('nama')
                                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- NIG / Nomor Induk -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 tracking-wide uppercase">
                                    NIG / Nomor Induk <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="nomor_induk" value="{{ old('nomor_induk') }}"
                                       placeholder="Contoh: 0041234567" required
                                       class="neon-input @error('nomor_induk') error @enderror">
                                @error('nomor_induk')
                                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 tracking-wide uppercase">
                                    Jenis Kelamin
                                </label>
                                <div class="flex gap-3">
                                    <label class="neon-radio-label flex-1">
                                        <input type="radio" name="jenis_kelamin" value="L"
                                               class="neon-radio"
                                               {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                        <span>♂ Laki-laki</span>
                                    </label>
                                    <label class="neon-radio-label flex-1">
                                        <input type="radio" name="jenis_kelamin" value="P"
                                               class="neon-radio"
                                               {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                        <span>♀ Perempuan</span>
                                    </label>
                                </div>
                                @error('jenis_kelamin')
                                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: Pengaturan Akun -->
                <div class="space-y-5">
                    <div class="glass-card p-6">
                        <div class="card-section-title">
                            <span class="card-section-dot"></span>
                            Pengaturan Akun
                        </div>

                        <div class="space-y-5">
                            <!-- Password -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 tracking-wide uppercase">
                                    Password <span class="text-red-400">*</span>
                                </label>
                                <input type="password" name="password"
                                       placeholder="Minimal 6 karakter" required
                                       class="neon-input @error('password') error @enderror">
                                @error('password')
                                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Akun -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 tracking-wide uppercase">
                                    Status Akun
                                </label>
                                <div class="relative">
                                    <select name="status" required class="neon-select">
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                                        <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>🔴 Tidak Aktif</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('status')
                                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-neon-green">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Data Guru
                    </button>

                    <!-- Import Excel -->
                    <button type="button" onclick="openModal('modal-import-guru')"
                            class="btn-neon-outline-indigo w-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Import Excel
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<!-- ==================== MODAL IMPORT EXCEL ==================== -->
<div id="modal-import-guru"
     class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm">
    <div class="relative w-full max-w-md p-4">
        <div class="relative rounded-2xl overflow-hidden"
             style="background: rgba(10,16,32,0.95); border: 1px solid rgba(99,102,241,0.25); box-shadow: 0 0 40px rgba(99,102,241,0.1);">
            <!-- Glow top -->
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-60"></div>

            <div class="flex items-center justify-between px-6 py-4 border-b border-indigo-500/10">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-indigo-400" style="box-shadow: 0 0 6px rgba(99,102,241,0.8);"></div>
                    <h3 class="text-base font-bold text-white" style="font-family: 'Orbitron', monospace; letter-spacing: 0.05em;">Import Data Guru</h3>
                </div>
                <button type="button" onclick="closeModal('modal-import-guru')"
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:text-white hover:bg-white/10 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>

            <form action="{{ route('superadmin.guru.import') }}" method="POST" enctype="multipart/form-data" class="px-6 py-5">
                @csrf
                <div class="space-y-4">
                    <div class="p-3 rounded-lg text-xs text-indigo-300 bg-indigo-500/8 border border-indigo-500/20 flex items-start gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span><span class="font-semibold">Catatan:</span> Pastikan Anda sudah mengunduh dan mengisi data sesuai dengan Template Excel.</span>
                    </div>

                    <div>
                        <label class="block mb-2 text-xs font-semibold text-slate-400 uppercase tracking-wide" for="file_excel_guru">
                            Upload File Excel
                        </label>
                        <input class="block w-full text-sm text-slate-400 rounded-lg cursor-pointer
                                      bg-[#080e1a] border border-indigo-500/20
                                      focus:outline-none
                                      file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0
                                      file:text-sm file:font-semibold file:bg-indigo-600 file:text-white
                                      hover:file:bg-indigo-700 transition-all"
                               id="file_excel_guru" name="file_excel" type="file"
                               accept=".xlsx, .xls, .csv" required>
                        <p class="mt-1.5 text-xs text-slate-600">Format yang didukung: .xlsx, .xls, .csv</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-indigo-500/10">
                    <button type="button" onclick="closeModal('modal-import-guru')"
                            class="px-5 py-2.5 text-sm text-slate-400 hover:text-white rounded-lg hover:bg-white/5 transition">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2.5 text-sm font-semibold text-white rounded-lg flex items-center gap-2 transition"
                            style="background: linear-gradient(135deg,#4f46e5,#6366f1); box-shadow: 0 0 16px rgba(99,102,241,0.3);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
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

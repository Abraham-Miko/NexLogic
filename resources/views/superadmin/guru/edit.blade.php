@extends('layouts.superadmin')

@section('content')

<style>
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
        border-color: rgba(16, 185, 129, 0.7);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12), 0 0 20px rgba(16, 185, 129, 0.08);
    }
    .neon-input.error {
        border-color: rgba(239, 68, 68, 0.6);
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

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
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, transparent 60%);
        pointer-events: none;
    }
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
        border-color: rgba(16, 185, 129, 0.7);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
    }
    .neon-select option { background: #0f172a; }

    .neon-radio-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px solid rgba(16, 185, 129, 0.15);
        color: #94a3b8;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }
    .neon-radio-label:has(input:checked) {
        border-color: rgba(16, 185, 129, 0.5);
        background: rgba(16, 185, 129, 0.08);
        color: #6ee7b7;
        box-shadow: 0 0 12px rgba(16, 185, 129, 0.1);
    }
    .neon-radio-label:hover {
        border-color: rgba(16, 185, 129, 0.35);
        color: #a7f3d0;
    }
    input[type="radio"].neon-radio { accent-color: #10b981; width: 16px; height: 16px; }

    .btn-neon-update {
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
    }
    .btn-neon-update:hover {
        box-shadow: 0 0 30px rgba(16, 185, 129, 0.45), 0 4px 20px rgba(16, 185, 129, 0.3);
        transform: translateY(-1px);
    }

    .btn-back {
        padding: 9px 12px;
        border-radius: 10px;
        background: rgba(15, 23, 42, 0.7);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #64748b;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        text-decoration: none;
    }
    .btn-back:hover {
        background: rgba(16, 185, 129, 0.08);
        border-color: rgba(16, 185, 129, 0.4);
        color: #34d399;
    }

    .card-section-title {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #64748b;
        padding-bottom: 12px;
        margin-bottom: 16px;
        border-bottom: 1px solid rgba(16, 185, 129, 0.12);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-section-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 8px rgba(16, 185, 129, 0.8);
        flex-shrink: 0;
    }

    /* Password hint */
    .hint-text {
        font-size: 0.72rem;
        color: #475569;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
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

<div class="p-8" style="background: radial-gradient(ellipse at top right, rgba(16,185,129,0.04) 0%, transparent 60%), #080e1a; min-height: 100%;">
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
                <span>Edit</span>
            </div>
        </div>

        <!-- ── Page Header ── -->
        <div class="mb-4">
            <div class="flex items-center gap-2 mb-1">
                <div class="w-2 h-2 rounded-full bg-emerald-400" style="box-shadow: 0 0 8px rgba(52,211,153,0.8);"></div>
                <span class="text-xs font-mono text-emerald-400 tracking-widest uppercase">Edit Guru</span>
            </div>
            <h2 class="text-2xl font-bold text-white" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 20px rgba(16,185,129,0.3);">
                Edit Data Guru
            </h2>
            <p class="text-sm text-slate-500 mt-0.5">
                Memperbarui informasi untuk:
                <span class="text-emerald-400 font-semibold">{{ $guru->nama }}</span>
            </p>
        </div>

        <!-- ── Form ── -->
        <form action="{{ route('superadmin.guru.update', $guru->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- KOLOM KIRI: Data Personal -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="glass-card-green p-6">
                        <div class="card-section-title">
                            <span class="card-section-dot"></span>
                            Informasi Personal
                        </div>

                        <div class="space-y-5">
                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 tracking-wide uppercase">
                                    Nama Lengkap <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="nama"
                                       value="{{ old('nama', $guru->nama) }}" required
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
                                <input type="text" name="nomor_induk"
                                       value="{{ old('nomor_induk', $guru->nomor_induk) }}" required
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
                                               {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                        <span>♂ Laki-laki</span>
                                    </label>
                                    <label class="neon-radio-label flex-1">
                                        <input type="radio" name="jenis_kelamin" value="P"
                                               class="neon-radio"
                                               {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                        <span>♀ Perempuan</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: Pengaturan Akun -->
                <div class="space-y-5">
                    <div class="glass-card p-6">
                        <div class="card-section-title" style="border-bottom-color: rgba(99,102,241,0.12);">
                            <span class="card-section-dot" style="background:#6366f1; box-shadow: 0 0 8px rgba(99,102,241,0.8);"></span>
                            Pengaturan Akun
                        </div>

                        <div class="space-y-5">
                            <!-- Password Baru -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 tracking-wide uppercase">
                                    Password Baru
                                </label>
                                <input type="password" name="password"
                                       placeholder="Kosongkan jika tak diubah"
                                       class="neon-input @error('password') error @enderror">
                                <p class="hint-text">
                                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Hanya isi jika ingin mereset password guru.
                                </p>
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
                                        <option value="aktif" {{ old('status', $guru->status) == 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                                        <option value="tidak_aktif" {{ old('status', $guru->status) == 'tidak_aktif' ? 'selected' : '' }}>🔴 Tidak Aktif</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Button -->
                    <button type="submit" class="btn-neon-update">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Update Data Guru
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection

@extends('layouts.superadmin')

@section('content')

<style>
    /* ── Gaming Ambient ── */
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.7rem; font-family: monospace;
        letter-spacing: 0.15em; text-transform: uppercase;
        color: #818cf8; margin-bottom: 4px;
    }
    .page-header-badge-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #818cf8; box-shadow: 0 0 8px rgba(129,140,248,0.9);
        animation: pulse-badge 2s ease infinite;
    }
    @keyframes pulse-badge {
        0%, 100% { box-shadow: 0 0 8px rgba(129,140,248,0.9); }
        50% { box-shadow: 0 0 16px rgba(129,140,248,0.4); }
    }

    /* ── Sub Wilayah Card ── */
    .sub-card {
        position: relative;
        background: rgba(10, 16, 32, 0.65);
        border: 1px solid rgba(99, 102, 241, 0.1);
        border-radius: 14px;
        overflow: hidden;
        backdrop-filter: blur(8px);
        transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.25s ease;
        display: flex; flex-direction: column;
        height: 100%;
    }
    .sub-card:hover {
        border-color: rgba(99,102,241,0.3);
        box-shadow: 0 0 30px rgba(99,102,241,0.09);
        transform: translateY(-2px);
    }
    .sub-card-top-glow {
        position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(to right, transparent, rgba(99,102,241,0.3), transparent);
        opacity: 0; transition: opacity 0.3s ease;
    }
    .sub-card:hover .sub-card-top-glow { opacity: 1; }

    /* ── Action btns overlay ── */
    .card-actions {
        position: absolute; top: 12px; right: 12px;
        display: flex; gap: 4px;
        opacity: 0; transition: opacity 0.2s ease;
    }
    .sub-card:hover .card-actions { opacity: 1; }
    .card-action-btn {
        padding: 6px; border-radius: 7px;
        background: rgba(8,14,26,0.85);
        border: 1px solid rgba(255,255,255,0.06);
        color: #475569; cursor: pointer;
        transition: all 0.2s ease; display: flex;
        backdrop-filter: blur(6px);
    }
    .card-action-btn.edit:hover {
        color: #f59e0b; border-color: rgba(245,158,11,0.25);
        background: rgba(245,158,11,0.08);
    }
    .card-action-btn.del:hover {
        color: #f87171; border-color: rgba(239,68,68,0.25);
        background: rgba(239,68,68,0.08);
    }

    /* ── Kelas initial badge ── */
    .kelas-initial {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; font-weight: 700; color: #818cf8;
        font-family: 'Orbitron', monospace;
        background: rgba(99,102,241,0.08);
        border: 1px solid rgba(99,102,241,0.2);
        flex-shrink: 0;
        transition: box-shadow 0.3s ease;
    }
    .sub-card:hover .kelas-initial {
        box-shadow: 0 0 14px rgba(99,102,241,0.2);
    }

    /* ── Code copy button ── */
    .kode-wrap {
        display: flex; align-items: center;
        background: rgba(8,14,26,0.6);
        border: 1px solid rgba(99,102,241,0.12);
        border-radius: 8px; overflow: hidden;
    }
    .kode-wrap .kode-text {
        padding: 6px 12px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem; color: #818cf8;
        letter-spacing: 0.05em;
    }
    .kode-copy-btn {
        padding: 6px 8px;
        background: rgba(99,102,241,0.08);
        border-left: 1px solid rgba(99,102,241,0.12);
        color: #475569; cursor: pointer;
        transition: all 0.2s ease; display: flex;
    }
    .kode-copy-btn:hover {
        background: rgba(99,102,241,0.18);
        color: #818cf8;
    }

    /* ── Info row ── */
    .info-row {
        display: flex; align-items: flex-start; gap: 10px;
    }
    .info-row-icon { color: #334155; flex-shrink: 0; margin-top: 2px; }

    /* ── Sub card footer btn ── */
    .sub-card-btn {
        display: flex; align-items: center; justify-content: center; gap: 6px;
        width: 100%; padding: 10px;
        background: rgba(99,102,241,0.04);
        border: 1px solid rgba(99,102,241,0.1);
        border-radius: 9px; color: #64748b;
        font-size: 0.8rem; font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease; margin-top: auto;
    }
    .sub-card-btn:hover {
        background: rgba(99,102,241,0.1);
        border-color: rgba(99,102,241,0.25);
        color: #818cf8;
        box-shadow: 0 0 14px rgba(99,102,241,0.1);
    }

    /* ── Neon Buttons ── */
    .btn-neon-green {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 20px; border-radius: 10px;
        background: linear-gradient(135deg, #059669, #10b981);
        border: 1px solid rgba(16,185,129,0.3);
        color: #fff; font-size: 0.85rem; font-weight: 600;
        cursor: pointer; transition: all 0.25s ease;
        box-shadow: 0 0 18px rgba(16,185,129,0.2);
    }
    .btn-neon-green:hover {
        box-shadow: 0 0 28px rgba(16,185,129,0.35);
        transform: translateY(-1px);
    }

    /* ── Modal Styles ── */
    .gaming-modal {
        background: rgba(8, 14, 26, 0.92);
        border: 1px solid rgba(99, 102, 241, 0.25);
        border-radius: 18px;
        box-shadow: 0 0 60px rgba(99,102,241,0.12), 0 25px 50px rgba(0,0,0,0.6);
        position: relative; overflow: hidden;
    }
    .gaming-modal::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(to right, transparent, rgba(99,102,241,0.5), transparent);
    }
    .gaming-modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 24px;
        border-bottom: 1px solid rgba(99,102,241,0.1);
    }
    .gaming-modal-body { padding: 24px; }
    .gaming-modal-footer {
        display: flex; align-items: center; justify-content: flex-end; gap: 10px;
        padding: 16px 24px;
        border-top: 1px solid rgba(99,102,241,0.08);
    }
    .gaming-input {
        width: 100%;
        background: rgba(15, 23, 42, 0.9);
        border: 1px solid rgba(99,102,241,0.2);
        color: #e2e8f0; border-radius: 10px;
        padding: 10px 14px; font-size: 0.875rem;
        transition: all 0.2s ease; outline: none;
    }
    .gaming-input:focus {
        border-color: rgba(99,102,241,0.55);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
    }
    .gaming-input::placeholder { color: #334155; }
    .gaming-select {
        width: 100%;
        background: rgba(15, 23, 42, 0.9);
        border: 1px solid rgba(99,102,241,0.2);
        color: #e2e8f0; border-radius: 10px;
        padding: 10px 14px; font-size: 0.875rem;
        transition: all 0.2s ease; outline: none;
        appearance: none; cursor: pointer;
    }
    .gaming-select:focus {
        border-color: rgba(99,102,241,0.55);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
    }
    .gaming-select option { background: #080e1a; }
    .gaming-label {
        display: block; margin-bottom: 8px;
        font-size: 0.8rem; font-weight: 600;
        color: #94a3b8; letter-spacing: 0.03em;
    }
    .gaming-modal-close {
        width: 32px; height: 32px; border-radius: 8px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        color: #475569; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s ease;
    }
    .gaming-modal-close:hover {
        background: rgba(239,68,68,0.1);
        border-color: rgba(239,68,68,0.25);
        color: #f87171;
    }
    .btn-modal-cancel {
        padding: 9px 20px; border-radius: 9px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        color: #64748b; font-size: 0.85rem; font-weight: 500;
        cursor: pointer; transition: all 0.2s ease;
    }
    .btn-modal-cancel:hover { color: #94a3b8; background: rgba(255,255,255,0.06); }
    .btn-modal-primary {
        padding: 9px 22px; border-radius: 9px;
        background: linear-gradient(135deg, #4338ca, #6366f1);
        border: 1px solid rgba(99,102,241,0.4);
        color: #fff; font-size: 0.85rem; font-weight: 600;
        cursor: pointer; transition: all 0.25s ease;
        box-shadow: 0 0 16px rgba(99,102,241,0.25);
        display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-modal-primary:hover {
        box-shadow: 0 0 24px rgba(99,102,241,0.4);
        transform: translateY(-1px);
    }
    .btn-modal-danger {
        padding: 9px 22px; border-radius: 9px;
        background: linear-gradient(135deg, #b91c1c, #ef4444);
        border: 1px solid rgba(239,68,68,0.3);
        color: #fff; font-size: 0.85rem; font-weight: 600;
        cursor: pointer; transition: all 0.25s ease;
        box-shadow: 0 0 14px rgba(239,68,68,0.2);
        display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-modal-danger:hover {
        box-shadow: 0 0 24px rgba(239,68,68,0.35);
        transform: translateY(-1px);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.2s ease forwards; }
</style>

<div class="p-8" style="background: radial-gradient(ellipse at 85% 0%, rgba(99,102,241,0.05) 0%, transparent 50%), #080e1a; min-height: 100%;">
    <div class="max-w-7xl mx-auto">

        <!-- ── Header & Breadcrumb ── -->
        <div class="mb-8">
            <a href="{{ route('superadmin.wilayah') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-400 transition mb-5 group">
                <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Wilayah
            </a>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="page-header-badge">
                        <span class="page-header-badge-dot"></span>
                        Sub Wilayah / Kelas
                    </div>
                    <h2 class="text-2xl font-bold text-white" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 20px rgba(99,102,241,0.2);">
                        {{ $wilayah->nama_wilayah }}
                    </h2>
                    <p class="text-slate-500 text-sm mt-1">
                        Kode Induk:
                        <span class="font-mono text-indigo-400 bg-indigo-500/8 px-2 py-0.5 rounded border border-indigo-500/15 text-xs ml-1">{{ $wilayah->kode_wilayah }}</span>
                    </p>
                </div>

                <button onclick="openModal('modal-create-sub')" class="btn-neon-green">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Sub Wilayah Baru
                </button>
            </div>
        </div>

        <!-- ── Grid Sub Wilayah (Kelas) ── -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($subWilayahs as $sub)
            <div class="sub-card p-6">
                <div class="sub-card-top-glow"></div>

                <!-- Actions (hover reveal) -->
                <div class="card-actions">
                    <button onclick="openEditSubModal({{ $sub->id }}, '{{ $sub->nama_sub_wilayah }}', '{{ $sub->kode_sub_wilayah }}', {{ $sub->guru_id }})" class="card-action-btn edit" title="Edit Kelas">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button onclick="openDeleteSubModal({{ $sub->id }})" class="card-action-btn del" title="Hapus Kelas">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>

                <!-- Ikon & Nama Kelas -->
                <div class="flex items-center gap-4 mb-5">
                    <div class="kelas-initial">{{ substr($sub->nama_sub_wilayah, 0, 1) }}</div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-white truncate">{{ $sub->nama_sub_wilayah }}</h3>
                        <div class="kode-wrap mt-2 w-fit">
                            <span class="kode-text">{{ $sub->kode_sub_wilayah }}</span>
                            <button onclick="copyKode('{{ $sub->kode_sub_wilayah }}', this)" class="kode-copy-btn" title="Salin Kode">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Info Rows -->
                <div class="space-y-3 mb-5 flex-grow">
                    <div class="info-row">
                        <svg class="w-4 h-4 info-row-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <div>
                            <p class="text-xs text-slate-600 mb-0.5">Wali Kelas</p>
                            <p class="text-sm font-medium text-slate-300">{{ $sub->guru->nama ?? '-' }}
                                @if($sub->guru)<span class="text-xs text-slate-500 ml-1">({{ $sub->guru->nomor_induk }})</span>@endif
                            </p>
                        </div>
                    </div>
                    <div class="info-row">
                        <svg class="w-4 h-4 info-row-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <div>
                            <p class="text-xs text-slate-600 mb-0.5">Total Siswa</p>
                            <p class="text-sm font-medium text-slate-300"><span class="text-white font-bold">{{ $sub->users_count }}</span> orang terdaftar</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Button -->
                <a href="{{ route('superadmin.subwilayah.show', $sub->id) }}" class="sub-card-btn">
                    Lihat Daftar Siswa
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            @endforeach
        </div>

    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL TAMBAH SUB WILAYAH -->
<!-- ============================================================ -->
<div id="modal-create-sub" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/70 backdrop-blur-md transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="gaming-modal">
            <div class="gaming-modal-header">
                <div>
                    <p class="text-xs font-mono text-indigo-400/60 tracking-widest uppercase mb-0.5">Tambah Data</p>
                    <h3 class="text-lg font-bold text-white">Tambah Sub Wilayah (Kelas)</h3>
                </div>
                <button type="button" onclick="closeModal('modal-create-sub')" class="gaming-modal-close">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <form action="{{ route('superadmin.subwilayah.store') }}" method="POST">
                @csrf
                <input type="hidden" name="wilayah_id" value="{{ $wilayah->id }}">
                <div class="gaming-modal-body space-y-5">
                    <div>
                        <label class="gaming-label">Nama Sub Wilayah / Kelas</label>
                        <input type="text" name="nama_sub_wilayah" class="gaming-input" placeholder="Contoh: X-TKJ 1" required>
                    </div>
                    <div>
                        <label class="gaming-label">Kode Sub Wilayah</label>
                        <input type="text" name="kode_sub_wilayah" class="gaming-input uppercase" placeholder="Contoh: SUB-TKJ1" required>
                    </div>
                    <div>
                        <label class="gaming-label">Wali Kelas / Guru Pengajar</label>
                        <div class="relative">
                            <select name="guru_id" class="gaming-select" required>
                                <option value="" disabled selected>-- Pilih Guru --</option>
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama }} ({{ $guru->nomor_induk }})</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                        @if($gurus->isEmpty())
                            <p class="mt-1.5 text-xs text-red-400">⚠ Belum ada akun Guru yang terdaftar di sistem.</p>
                        @endif
                    </div>
                </div>
                <div class="gaming-modal-footer">
                    <button type="button" onclick="closeModal('modal-create-sub')" class="btn-modal-cancel">Batal</button>
                    <button type="submit" class="btn-modal-primary">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT SUB WILAYAH -->
<!-- ============================================================ -->
<div id="modal-edit-sub" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/70 backdrop-blur-md transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="gaming-modal" style="border-color: rgba(245,158,11,0.2); box-shadow: 0 0 60px rgba(245,158,11,0.07), 0 25px 50px rgba(0,0,0,0.6);">
            <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right, transparent, rgba(245,158,11,0.4), transparent);"></div>
            <div class="gaming-modal-header" style="border-bottom-color: rgba(245,158,11,0.08);">
                <div>
                    <p class="text-xs font-mono tracking-widest uppercase mb-0.5" style="color: rgba(251,191,36,0.5);">Edit Data</p>
                    <h3 class="text-lg font-bold text-white">Edit Sub Wilayah</h3>
                </div>
                <button type="button" onclick="closeModal('modal-edit-sub')" class="gaming-modal-close">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <form id="form-edit-sub" method="POST">
                @csrf
                @method('PUT')
                <div class="gaming-modal-body space-y-5">
                    <div>
                        <label class="gaming-label">Nama Sub Wilayah</label>
                        <input type="text" id="edit_nama_sub" name="nama_sub_wilayah" class="gaming-input" style="border-color: rgba(245,158,11,0.2);" required>
                    </div>
                    <div>
                        <label class="gaming-label">Kode Sub Wilayah</label>
                        <input type="text" id="edit_kode_sub" name="kode_sub_wilayah" class="gaming-input uppercase" style="border-color: rgba(245,158,11,0.2);" required>
                    </div>
                    <div>
                        <label class="gaming-label">Wali Kelas</label>
                        <div class="relative">
                            <select id="edit_guru_sub" name="guru_id" class="gaming-select" style="border-color: rgba(245,158,11,0.2);" required>
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gaming-modal-footer" style="border-top-color: rgba(245,158,11,0.07);">
                    <button type="button" onclick="closeModal('modal-edit-sub')" class="btn-modal-cancel">Batal</button>
                    <button type="submit" class="btn-modal-primary" style="background: linear-gradient(135deg, #b45309, #f59e0b); border-color: rgba(245,158,11,0.4); box-shadow: 0 0 16px rgba(245,158,11,0.2);">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL HAPUS SUB WILAYAH -->
<!-- ============================================================ -->
<div id="modal-delete-sub" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/70 backdrop-blur-md transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="gaming-modal" style="border-color: rgba(239,68,68,0.25); box-shadow: 0 0 60px rgba(239,68,68,0.1), 0 25px 50px rgba(0,0,0,0.6);">
            <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right, transparent, rgba(239,68,68,0.5), transparent);"></div>
            <div class="gaming-modal-body text-center pt-8 pb-6">
                <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-5" style="box-shadow: 0 0 20px rgba(239,68,68,0.15);">
                    <svg class="text-red-500 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Hapus Sub Wilayah?</h3>
                <p class="text-sm text-slate-400 max-w-xs mx-auto mb-6">Pastikan kelas ini sudah tidak memiliki siswa. Tindakan ini tidak dapat dibatalkan.</p>
                <form id="form-delete-sub" method="POST" class="flex items-center justify-center gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeModal('modal-delete-sub')" class="btn-modal-cancel">Batal</button>
                    <button type="submit" class="btn-modal-danger">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Ya, Hapus Kelas
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
    function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }

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
        const showSuccessIcon = () => {
            const originalIcon = buttonElement.innerHTML;
            buttonElement.innerHTML = `<svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;
            setTimeout(() => { buttonElement.innerHTML = originalIcon; }, 2000);
        };
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(showSuccessIcon).catch(err => { console.error('Gagal menyalin API: ', err); });
        } else {
            let textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed"; textArea.style.left = "-999999px"; textArea.style.top = "-999999px";
            document.body.appendChild(textArea); textArea.focus(); textArea.select();
            try { document.execCommand('copy'); showSuccessIcon(); } catch (err) { console.error('Gagal menyalin Fallback: ', err); }
            textArea.remove();
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                background: '#080e1a',
                color: '#e2e8f0',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    });
</script>
@endsection

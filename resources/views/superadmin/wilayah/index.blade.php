@extends('layouts.superadmin')

@section('content')

<style>
    /* ── Page Header Badge ── */
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
        animation: pulse-badge 2s ease infinite;
    }
    @keyframes pulse-badge {
        0%, 100% { box-shadow: 0 0 8px rgba(129,140,248,0.9); }
        50% { box-shadow: 0 0 16px rgba(129,140,248,0.4); }
    }

    /* ── Wilayah Card ── */
    .wilayah-card {
        position: relative;
        background: rgba(10, 16, 32, 0.65);
        border: 1px solid rgba(99, 102, 241, 0.12);
        border-radius: 14px;
        overflow: hidden;
        transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.25s ease;
        backdrop-filter: blur(8px);
    }
    .wilayah-card:hover {
        border-color: rgba(99, 102, 241, 0.35);
        box-shadow: 0 0 32px rgba(99, 102, 241, 0.09), inset 0 0 20px rgba(99,102,241,0.02);
        transform: translateY(-1px);
    }
    .wilayah-card-accent {
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, #6366f1, #818cf8);
        border-radius: 3px 0 0 3px;
        opacity: 0;
        transition: opacity 0.3s ease;
        box-shadow: 0 0 12px rgba(99,102,241,0.6);
    }
    .wilayah-card:hover .wilayah-card-accent { opacity: 1; }

    /* ── Neon Button ── */
    .btn-neon-green {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 20px; border-radius: 10px;
        background: linear-gradient(135deg, #059669, #10b981);
        border: 1px solid rgba(16,185,129,0.3);
        color: #fff; font-size: 0.85rem; font-weight: 600;
        cursor: pointer; transition: all 0.25s ease;
        box-shadow: 0 0 18px rgba(16,185,129,0.2);
        text-decoration: none;
    }
    .btn-neon-green:hover {
        box-shadow: 0 0 28px rgba(16,185,129,0.35);
        transform: translateY(-1px);
    }

    .btn-neon-indigo {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 16px; border-radius: 9px;
        background: rgba(99,102,241,0.1);
        border: 1px solid rgba(99,102,241,0.25);
        color: #818cf8; font-size: 0.8rem; font-weight: 500;
        cursor: pointer; transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-neon-indigo:hover {
        background: rgba(99,102,241,0.18);
        border-color: rgba(99,102,241,0.4);
        box-shadow: 0 0 14px rgba(99,102,241,0.18);
        color: #a5b4fc;
    }

    /* ── Stat Badge ── */
    .stat-badge {
        display: flex; flex-direction: column;
    }
    .stat-badge-num {
        font-size: 1.5rem; font-weight: 700; color: #fff;
        font-family: 'Orbitron', monospace;
    }
    .stat-badge-label {
        font-size: 0.65rem; font-weight: 700; color: #475569;
        text-transform: uppercase; letter-spacing: 0.1em;
    }

    /* ── Icon Wrapper ── */
    .wilayah-icon {
        width: 52px; height: 52px; border-radius: 12px;
        background: rgba(99,102,241,0.08);
        border: 1px solid rgba(99,102,241,0.18);
        display: flex; align-items: center; justify-content: center;
        color: #818cf8; flex-shrink: 0;
        transition: box-shadow 0.3s ease;
    }
    .wilayah-card:hover .wilayah-icon {
        box-shadow: 0 0 16px rgba(99,102,241,0.2);
    }

    /* ── Action Buttons ── */
    .action-icon-btn {
        padding: 8px; border-radius: 8px; color: #475569;
        background: transparent; border: 1px solid transparent;
        cursor: pointer; transition: all 0.2s ease; display: flex;
    }
    .action-icon-btn.edit:hover {
        color: #f59e0b; background: rgba(245,158,11,0.1);
        border-color: rgba(245,158,11,0.25);
        box-shadow: 0 0 10px rgba(245,158,11,0.12);
    }
    .action-icon-btn.del:hover {
        color: #f87171; background: rgba(239,68,68,0.1);
        border-color: rgba(239,68,68,0.25);
        box-shadow: 0 0 10px rgba(239,68,68,0.12);
    }

    /* ── Empty State ── */
    .empty-state {
        border: 2px dashed rgba(99,102,241,0.15);
        border-radius: 18px;
        padding: 60px 20px;
        display: flex; flex-direction: column;
        align-items: center; text-align: center;
        background: rgba(10,16,32,0.3);
    }

    /* ── Modal Styles ── */
    .gaming-modal {
        background: rgba(8, 14, 26, 0.92);
        border: 1px solid rgba(99, 102, 241, 0.25);
        border-radius: 18px;
        box-shadow: 0 0 60px rgba(99,102,241,0.12), 0 25px 50px rgba(0,0,0,0.6);
        position: relative;
        overflow: hidden;
    }
    .gaming-modal::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 1px;
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
    .animate-fade-in-up {
        animation: fadeInUp 0.2s ease forwards;
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
</style>

<div class="p-8" style="background: radial-gradient(ellipse at 85% 0%, rgba(99,102,241,0.05) 0%, transparent 50%), #080e1a; min-height: 100%;">
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
                <span>Manajemen Wilayah</span>
            </div>
        </div>
        <!-- ── Page Header ── -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <div class="page-header-badge">
                    <span class="page-header-badge-dot"></span>
                    Struktur Organisasi
                </div>
                <h2 class="text-2xl font-bold text-white" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 20px rgba(99,102,241,0.2);">
                    Manajemen Wilayah
                </h2>
                <p class="text-slate-500 text-sm mt-1">Kelola data Angkatan beserta daftar Kelas (Sub Wilayah) di dalamnya.</p>
            </div>

            <button class="btn-neon-green" onclick="openModal('modal-create')">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Wilayah Baru
            </button>
        </div>

        <!-- ── Daftar Wilayah ── -->
        <div class="flex flex-col gap-4">
            @forelse($wilayahs as $w)
            <div class="wilayah-card p-5 flex flex-col lg:flex-row items-center justify-between gap-4">
                <div class="wilayah-card-accent"></div>

                <!-- Kiri: Info Utama -->
                <div class="flex items-center gap-5 w-full lg:w-2/5 pl-3">
                    <div class="wilayah-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">{{ $w->nama_wilayah }}</h3>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="px-2.5 py-0.5 rounded-md bg-slate-800/80 text-xs font-mono text-indigo-300 border border-indigo-500/15">
                                {{ $w->kode_wilayah }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tengah: Statistik -->
                <div class="flex items-center gap-8 w-full lg:w-1/3 lg:border-x border-indigo-500/10 py-2 lg:px-8">
                    <div class="stat-badge">
                        <span class="stat-badge-num">{{ $w->sub_wilayahs_count }}</span>
                        <span class="stat-badge-label">Sub Wilayah</span>
                    </div>
                    <div class="w-px h-8 bg-indigo-500/10 hidden md:block"></div>
                    <div class="stat-badge">
                        <span class="stat-badge-num">{{ $w->users_count }}</span>
                        <span class="stat-badge-label">Siswa</span>
                    </div>
                </div>

                <!-- Kanan: Aksi -->
                <div class="flex items-center justify-end w-full lg:w-auto gap-2">
                    <a href="{{ route('superadmin.wilayah.show', $w->id) }}" class="btn-neon-indigo">
                        Masuk Sub Wilayah
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <div class="w-px h-6 bg-indigo-500/10 mx-1 hidden sm:block"></div>
                    <button onclick="openEditModal({{ $w->id }}, '{{ $w->nama_wilayah }}', '{{ $w->kode_wilayah }}')" class="action-icon-btn edit" title="Edit Data">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button onclick="openDeleteModal({{ $w->id }})" class="action-icon-btn del" title="Hapus Data">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="w-20 h-20 rounded-full bg-indigo-500/8 border border-indigo-500/15 flex items-center justify-center mb-5 text-indigo-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Belum Ada Data Wilayah</h3>
                <p class="text-slate-500 max-w-md mx-auto mb-6 text-sm">Sistem saat ini belum memiliki data Angkatan/Wilayah. Silakan buat wilayah pertama Anda untuk mulai menambahkan guru dan siswa.</p>
                <button onclick="openModal('modal-create')" class="btn-neon-green">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Wilayah Pertama
                </button>
            </div>
            @endforelse
        </div>

    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL TAMBAH WILAYAH -->
<!-- ============================================================ -->
<div id="modal-create" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/70 backdrop-blur-md transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="gaming-modal">
            <div class="gaming-modal-header">
                <div>
                    <p class="text-xs font-mono text-indigo-400/60 tracking-widest uppercase mb-0.5">Tambah Data</p>
                    <h3 class="text-lg font-bold text-white">Tambah Wilayah Baru</h3>
                </div>
                <button type="button" onclick="closeModal('modal-create')" class="gaming-modal-close">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>

            <form action="{{ route('superadmin.wilayah.store') }}" method="POST">
                @csrf
                <div class="gaming-modal-body space-y-5">
                    <div>
                        <label class="gaming-label">Nama Wilayah</label>
                        <input type="text" name="nama_wilayah" class="gaming-input" placeholder="Contoh: Angkatan 2024" required>
                    </div>
                    <div>
                        <label class="gaming-label">Kode Wilayah</label>
                        <input type="text" name="kode_wilayah" class="gaming-input uppercase" placeholder="Contoh: ANG-2024" required>
                    </div>
                </div>
                <div class="gaming-modal-footer">
                    <button type="button" onclick="closeModal('modal-create')" class="btn-modal-cancel">Batal</button>
                    <button type="submit" class="btn-modal-primary">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Wilayah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT WILAYAH -->
<!-- ============================================================ -->
<div id="modal-edit" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/70 backdrop-blur-md transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="gaming-modal" style="border-color: rgba(245,158,11,0.2); box-shadow: 0 0 60px rgba(245,158,11,0.07), 0 25px 50px rgba(0,0,0,0.6);">
            <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right, transparent, rgba(245,158,11,0.4), transparent);"></div>
            <div class="gaming-modal-header" style="border-bottom-color: rgba(245,158,11,0.08);">
                <div>
                    <p class="text-xs font-mono tracking-widest uppercase mb-0.5" style="color: rgba(251,191,36,0.5);">Edit Data</p>
                    <h3 class="text-lg font-bold text-white">Edit Wilayah</h3>
                </div>
                <button type="button" onclick="closeModal('modal-edit')" class="gaming-modal-close">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>

            <form id="form-edit-wilayah" method="POST">
                @csrf
                @method('PUT')
                <div class="gaming-modal-body space-y-5">
                    <div>
                        <label class="gaming-label">Nama Wilayah</label>
                        <input type="text" name="nama_wilayah" id="edit_nama_wilayah" class="gaming-input" style="border-color: rgba(245,158,11,0.2);" required>
                    </div>
                    <div>
                        <label class="gaming-label">Kode Wilayah</label>
                        <input type="text" name="kode_wilayah" id="edit_kode_wilayah" class="gaming-input uppercase" style="border-color: rgba(245,158,11,0.2);" required>
                    </div>
                </div>
                <div class="gaming-modal-footer" style="border-top-color: rgba(245,158,11,0.07);">
                    <button type="button" onclick="closeModal('modal-edit')" class="btn-modal-cancel">Batal</button>
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
<!-- MODAL HAPUS WILAYAH -->
<!-- ============================================================ -->
<div id="modal-delete" class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/70 backdrop-blur-md transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="gaming-modal" style="border-color: rgba(239,68,68,0.25); box-shadow: 0 0 60px rgba(239,68,68,0.1), 0 25px 50px rgba(0,0,0,0.6);">
            <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right, transparent, rgba(239,68,68,0.5), transparent);"></div>
            <div class="gaming-modal-body text-center pt-8 pb-6">
                <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-5" style="box-shadow: 0 0 20px rgba(239,68,68,0.15);">
                    <svg class="text-red-500 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Hapus Wilayah?</h3>
                <p class="text-sm text-slate-400 max-w-xs mx-auto mb-6">Tindakan ini tidak dapat dibatalkan. Pastikan wilayah ini sudah kosong dari Sub Wilayah sebelum menghapus.</p>

                <form id="form-delete-wilayah" method="POST" class="flex items-center justify-center gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeModal('modal-delete')" class="btn-modal-cancel">Batal</button>
                    <button type="submit" class="btn-modal-danger">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Ya, Hapus Data
                    </button>
                </form>
            </div>
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
    function openEditModal(id, nama, kode) {
        const form = document.getElementById('form-edit-wilayah');
        form.action = `/superadmin/wilayah/${id}`;
        document.getElementById('edit_nama_wilayah').value = nama;
        document.getElementById('edit_kode_wilayah').value = kode;
        openModal('modal-edit');
    }
    function openDeleteModal(id) {
        const form = document.getElementById('form-delete-wilayah');
        form.action = `/superadmin/wilayah/${id}`;
        openModal('modal-delete');
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

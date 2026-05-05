{{-- subwilayah.show.blade.php --}}
@extends('layouts.superadmin')

@section('content')

<style>
    /* ── Stat Cards ── */
    .stat-card {
        position: relative;
        border-radius: 14px;
        padding: 20px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        backdrop-filter: blur(8px);
    }
    .stat-card:hover { transform: translateY(-2px); }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, currentColor, transparent);
        opacity: 0.3;
    }
    .stat-card-indigo {
        background: rgba(99, 102, 241, 0.07);
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: #818cf8;
        box-shadow: 0 0 30px rgba(99, 102, 241, 0.06);
    }
    .stat-card-indigo:hover { box-shadow: 0 0 40px rgba(99, 102, 241, 0.14); }

    .stat-card-purple {
        background: rgba(124, 58, 237, 0.07);
        border: 1px solid rgba(124, 58, 237, 0.2);
        color: #a78bfa;
        box-shadow: 0 0 30px rgba(124, 58, 237, 0.06);
    }
    .stat-card-purple:hover { box-shadow: 0 0 40px rgba(124, 58, 237, 0.14); }

    .stat-card-cyan {
        background: rgba(6, 182, 212, 0.07);
        border: 1px solid rgba(6, 182, 212, 0.2);
        color: #22d3ee;
        box-shadow: 0 0 30px rgba(6, 182, 212, 0.06);
    }
    .stat-card-cyan:hover { box-shadow: 0 0 40px rgba(6, 182, 212, 0.14); }

    .stat-icon-wrap {
        width: 40px; height: 40px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 14px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
    }

    /* ── Table ── */
    .data-table-wrap {
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid rgba(99, 102, 241, 0.12);
        background: rgba(10, 16, 32, 0.6);
        backdrop-filter: blur(8px);
    }
    .data-table-wrap table { width: 100%; border-collapse: collapse; }
    .data-table-wrap thead tr {
        background: rgba(99, 102, 241, 0.05);
        border-bottom: 1px solid rgba(99, 102, 241, 0.1);
    }
    .data-table-wrap thead th {
        padding: 14px 20px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #64748b;
    }
    .data-table-wrap tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.04);
        transition: background 0.2s ease;
    }
    .data-table-wrap tbody tr:hover {
        background: rgba(99, 102, 241, 0.04);
    }
    .data-table-wrap tbody tr:last-child { border-bottom: none; }
    .data-table-wrap tbody td {
        padding: 14px 20px;
        font-size: 0.875rem;
        color: #94a3b8;
    }

    /* ── Badge Status ── */
    .badge-aktif {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 3px 10px;
        border-radius: 9999px;
        font-size: 0.72rem; font-weight: 600; letter-spacing: 0.04em;
        background: rgba(16, 185, 129, 0.08);
        border: 1px solid rgba(16, 185, 129, 0.25);
        color: #34d399;
    }
    .badge-aktif-dot {
        width: 5px; height: 5px; border-radius: 50%;
        background: #34d399;
        box-shadow: 0 0 6px #34d399;
        display: inline-block;
    }
    .badge-nonaktif {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 3px 10px;
        border-radius: 9999px;
        font-size: 0.72rem; font-weight: 600; letter-spacing: 0.04em;
        background: rgba(239, 68, 68, 0.08);
        border: 1px solid rgba(239, 68, 68, 0.25);
        color: #f87171;
    }
    .badge-nonaktif-dot {
        width: 5px; height: 5px; border-radius: 50%;
        background: #f87171;
        display: inline-block;
    }

    /* ── Action Buttons ── */
    .action-btn-remove {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px;
        border-radius: 8px;
        background: rgba(239, 68, 68, 0.06);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #f87171;
        font-size: 0.75rem; font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .action-btn-remove:hover {
        background: rgba(239, 68, 68, 0.12);
        border-color: rgba(239, 68, 68, 0.4);
        box-shadow: 0 0 12px rgba(239, 68, 68, 0.15);
        color: #fca5a5;
    }

    /* ── Primary Button ── */
    .btn-neon-green {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(16,185,129,0.15), rgba(5,150,105,0.2));
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #34d399;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 0 16px rgba(16,185,129,0.12);
        white-space: nowrap;
        cursor: pointer;
    }
    .btn-neon-green:hover {
        background: linear-gradient(135deg, rgba(16,185,129,0.22), rgba(5,150,105,0.28));
        box-shadow: 0 0 28px rgba(16,185,129,0.28);
        border-color: rgba(16, 185, 129, 0.6);
        transform: translateY(-1px);
        color: #6ee7b7;
    }

    /* ── Back link ── */
    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.8rem;
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s ease;
        margin-bottom: 6px;
    }
    .back-link:hover { color: #a78bfa; }

    /* ── Search Modal Input ── */
    .neon-search-modal {
        background: rgba(8, 14, 26, 0.9);
        border: 1px solid rgba(99, 102, 241, 0.25);
        color: #e2e8f0;
        border-radius: 10px;
        padding: 9px 16px 9px 40px;
        font-size: 0.875rem;
        width: 100%;
        transition: all 0.25s ease;
        outline: none;
    }
    .neon-search-modal::placeholder { color: #475569; }
    .neon-search-modal:focus {
        border-color: rgba(99, 102, 241, 0.55);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* ── Modal Backdrop & Card ── */
    .modal-card {
        background: rgba(8, 14, 26, 0.95);
        border: 1px solid rgba(99, 102, 241, 0.18);
        backdrop-filter: blur(20px);
    }
    .modal-card-danger {
        background: rgba(8, 14, 26, 0.95);
        border: 1px solid rgba(239, 68, 68, 0.2);
        backdrop-filter: blur(20px);
    }
    .modal-card-confirm {
        background: rgba(8, 14, 26, 0.95);
        border: 1px solid rgba(99, 102, 241, 0.25);
        backdrop-filter: blur(20px);
    }
</style>

<div class="p-8">
    <div class="max-w-7xl mx-auto">

        <!-- ── Header ── -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <a href="{{ route('superadmin.wilayah.show', $subWilayah->wilayah_id) }}" class="back-link">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Wilayah
                </a>
                <h1 class="text-2xl font-bold text-white mt-1" style="font-family: 'Orbitron', sans-serif; letter-spacing: 0.04em;">
                    Kelas: <span style="background: linear-gradient(135deg, #a78bfa, #818cf8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ $subWilayah->nama_sub_wilayah }}</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1">Kelola data siswa di sini.</p>
            </div>

            <!-- Tombol Tambah Siswa (Membuka Modal) -->
            <button onclick="openModal('modal-tambah-siswa')" class="btn-neon-green">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Tambah Siswa Baru
            </button>
        </div>

        <!-- ── Info Cards (Bento Grid) ── -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

            <!-- Card: Wali Kelas -->
            <div class="stat-card stat-card-purple">
                <div class="stat-icon-wrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500 mb-1">Wali Kelas / Guru</p>
                <p class="text-lg font-bold text-white">{{ $subWilayah->guru->nama ?? 'Belum Ditentukan' }}</p>
            </div>

            <!-- Card: Total Siswa -->
            <div class="stat-card stat-card-indigo">
                <div class="stat-icon-wrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500 mb-1">Total Siswa</p>
                <p class="text-3xl font-bold" style="font-family: 'Orbitron', sans-serif;">{{ $subWilayah->users->count() }}</p>
                <p class="text-xs text-slate-500 mt-1">Anak Terdaftar</p>
            </div>

            <!-- Card: Kode Kelas -->
            <div class="stat-card stat-card-cyan">
                <div class="stat-icon-wrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500 mb-1">Kode Kelas</p>
                <p class="text-xl font-bold font-mono">{{ $subWilayah->kode_sub_wilayah }}</p>
            </div>

        </div>

        <!-- ── Tabel Daftar Siswa ── -->
        <div class="data-table-wrap">

            <!-- Table Header Bar -->
            <div class="flex items-center justify-between px-5 py-4"
                 style="border-bottom: 1px solid rgba(99,102,241,0.1); background: rgba(99,102,241,0.03);">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-indigo-400" style="box-shadow: 0 0 6px #818cf8;"></div>
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Daftar Siswa</span>
                </div>
                <span class="text-xs font-mono text-slate-600">{{ $subWilayah->users->count() }} record</span>
            </div>

            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">Nomor Induk</th>
                            <th class="text-left">Nama Lengkap</th>
                            <th class="text-left">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subWilayah->users as $index => $siswa)
                        <tr>
                            <td>
                                <span class="text-slate-600 font-mono text-xs">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>
                                <span class="font-mono text-indigo-400 text-xs">{{ $siswa->nomor_induk }}</span>
                            </td>
                            <td>
                                <span class="text-white font-medium">{{ $siswa->nama }}</span>
                            </td>
                            <td>
                                @if($siswa->status == 'aktif')
                                    <span class="badge-aktif">
                                        <span class="badge-aktif-dot"></span> Aktif
                                    </span>
                                @else
                                    <span class="badge-nonaktif">
                                        <span class="badge-nonaktif-dot"></span> {{ ucfirst($siswa->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button onclick="openRemoveSiswaModal({{ $siswa->id }}, '{{ addslashes($siswa->nama) }}')"
                                        class="action-btn-remove">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zm11-2h-4m0 0l2-2m-2 2l2 2"/>
                                    </svg>
                                    Keluarkan
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4"
                                         style="background: rgba(99,102,241,0.05); border: 1px solid rgba(99,102,241,0.12);">
                                        <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-semibold text-white mb-1">Belum Ada Siswa</h3>
                                    <p class="text-sm text-slate-500 max-w-sm">Kelas ini masih kosong. Klik <span class="text-emerald-400 font-medium">Tambah Siswa Baru</span> untuk memulai.</p>
                                </div>
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
<!-- MODAL 1: CARI & PILIH SISWA               -->
<!-- ========================================== -->
<div id="modal-tambah-siswa" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-md p-4 animate-fade-in-up">
        <div class="modal-card relative rounded-2xl shadow-2xl flex flex-col max-h-[80vh]"
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
                           class="neon-search-modal"
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
        <div class="modal-card-confirm relative rounded-2xl shadow-2xl text-center p-6"
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

            <form action="{{ route('superadmin.subwilayah.assign_siswa', $subWilayah->id) }}" method="POST" class="flex justify-center gap-3">
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

<!-- ========================================== -->
<!-- MODAL 3: KONFIRMASI KELUARKAN SISWA       -->
<!-- ========================================== -->
<div id="modal-remove-siswa" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black/70 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative w-full max-w-sm p-4 animate-fade-in-up">
        <div class="modal-card-danger relative rounded-2xl shadow-2xl text-center p-6"
             style="box-shadow: 0 0 60px rgba(239,68,68,0.12), 0 25px 50px rgba(0,0,0,0.5);">

            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5"
                 style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2);">
                <svg class="text-red-400 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zm11-2h-4m0 0l2-2m-2 2l2 2"/>
                </svg>
            </div>

            <h3 class="mb-2 text-xl font-bold text-white">Keluarkan Siswa?</h3>
            <p class="mb-2 text-sm text-slate-400 leading-relaxed">
                Anda akan mengeluarkan <strong id="remove_nama_siswa" class="text-red-300 text-base"></strong> dari kelas ini.
            </p>
            <p class="mb-6 text-xs text-amber-400/80">
                Data akun siswa tidak akan terhapus, hanya akan dikembalikan ke status "Belum Ada Kelas".
            </p>

            <form id="form-remove-siswa" method="POST" class="flex justify-center gap-3">
                @csrf
                <!-- Tidak perlu @method('DELETE') karena kita menggunakan rute POST untuk proses Update -->
                <button type="button" onclick="closeModal('modal-remove-siswa')"
                        class="text-slate-300 text-sm px-5 py-2.5 rounded-lg transition-colors"
                        style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);"
                        onmouseover="this.style.background='rgba(255,255,255,0.07)';"
                        onmouseout="this.style.background='rgba(255,255,255,0.04)';">
                    Batal
                </button>
                <button type="submit"
                        class="text-white text-sm px-5 py-2.5 rounded-lg font-semibold transition-all"
                        style="background: linear-gradient(135deg, #b91c1c, #ef4444); border: 1px solid rgba(239,68,68,0.4); box-shadow: 0 0 20px rgba(239,68,68,0.2);"
                        onmouseover="this.style.boxShadow='0 0 30px rgba(239,68,68,0.35)';"
                        onmouseout="this.style.boxShadow='0 0 20px rgba(239,68,68,0.2)';">
                    Ya, Keluarkan
                </button>
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
                background: '#080e1a',
                color: '#ffffff',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    });
</script>

@endsection

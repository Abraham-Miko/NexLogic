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

    .stat-card-purple {
        background: rgba(124, 58, 237, 0.07);
        border: 1px solid rgba(124, 58, 237, 0.2);
        color: #a78bfa;
        box-shadow: 0 0 30px rgba(124, 58, 237, 0.06);
    }
    .stat-card-purple:hover { box-shadow: 0 0 40px rgba(124, 58, 237, 0.14); }

    .stat-card-green {
        background: rgba(16, 185, 129, 0.07);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #34d399;
        box-shadow: 0 0 30px rgba(16, 185, 129, 0.06);
    }
    .stat-card-green:hover { box-shadow: 0 0 40px rgba(16, 185, 129, 0.14); }

    .stat-card-red {
        background: rgba(239, 68, 68, 0.07);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #f87171;
        box-shadow: 0 0 30px rgba(239, 68, 68, 0.06);
    }
    .stat-card-red:hover { box-shadow: 0 0 40px rgba(239, 68, 68, 0.14); }

    .stat-card-blue {
        background: rgba(59, 130, 246, 0.07);
        border: 1px solid rgba(59, 130, 246, 0.2);
        color: #60a5fa;
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.06);
    }
    .stat-card-blue:hover { box-shadow: 0 0 40px rgba(59, 130, 246, 0.14); }

    .stat-icon-wrap {
        width: 40px; height: 40px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 14px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
    }

    /* ── Search & Filter ── */
    .neon-search {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #e2e8f0;
        border-radius: 10px;
        padding: 8px 16px 8px 40px;
        font-size: 0.875rem;
        width: 100%;
        transition: all 0.25s ease;
        outline: none;
    }
    .neon-search::placeholder { color: #475569; }
    .neon-search:focus {
        border-color: rgba(16, 185, 129, 0.6);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .neon-filter-select {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #94a3b8;
        border-radius: 10px;
        padding: 8px 32px 8px 14px;
        font-size: 0.875rem;
        transition: all 0.25s ease;
        outline: none;
        appearance: none;
        cursor: pointer;
    }
    .neon-filter-select:focus {
        border-color: rgba(16, 185, 129, 0.5);
        color: #e2e8f0;
    }
    .neon-filter-select option { background: #0f172a; }

    /* ── Table ── */
    .data-table-wrap {
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid rgba(16, 185, 129, 0.12);
        background: rgba(10, 16, 32, 0.6);
        backdrop-filter: blur(8px);
    }
    .data-table-wrap table { width: 100%; border-collapse: collapse; }
    .data-table-wrap thead tr {
        background: rgba(16, 185, 129, 0.05);
        border-bottom: 1px solid rgba(16, 185, 129, 0.1);
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
        background: rgba(16, 185, 129, 0.04);
    }
    .data-table-wrap tbody tr:last-child { border-bottom: none; }
    .data-table-wrap tbody td {
        padding: 14px 20px;
        font-size: 0.875rem;
        color: #94a3b8;
    }

    /* ── Buttons ── */
    .btn-green-solid {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        background: linear-gradient(135deg, #059669, #10b981);
        border: 1px solid rgba(16,185,129,0.3);
        color: #fff;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 0 16px rgba(16,185,129,0.2);
        white-space: nowrap;
    }
    .btn-green-solid:hover {
        box-shadow: 0 0 24px rgba(16,185,129,0.35);
        transform: translateY(-1px);
    }

    .btn-emerald-outline {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        background: rgba(16,185,129,0.06);
        border: 1px solid rgba(16,185,129,0.3);
        color: #34d399;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s ease;
        white-space: nowrap;
    }
    .btn-emerald-outline:hover {
        background: rgba(16,185,129,0.1);
        box-shadow: 0 0 14px rgba(16,185,129,0.15);
    }

    .btn-search {
        padding: 8px 16px;
        border-radius: 10px;
        background: rgba(16,185,129,0.1);
        border: 1px solid rgba(16,185,129,0.3);
        color: #34d399;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-search:hover {
        background: rgba(16,185,129,0.18);
        box-shadow: 0 0 12px rgba(16,185,129,0.2);
    }

    .action-btn-edit {
        padding: 6px; border-radius: 8px;
        color: #64748b; background: transparent;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        display: flex;
    }
    .action-btn-edit:hover {
        color: #34d399;
        background: rgba(16,185,129,0.1);
        border-color: rgba(16,185,129,0.3);
        box-shadow: 0 0 10px rgba(16,185,129,0.15);
    }
    .action-btn-delete {
        padding: 6px; border-radius: 8px;
        color: #64748b; background: transparent;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        display: flex; cursor: pointer;
    }
    .action-btn-delete:hover {
        color: #f87171;
        background: rgba(239,68,68,0.1);
        border-color: rgba(239,68,68,0.3);
        box-shadow: 0 0 10px rgba(239,68,68,0.15);
    }

    /* ── Status Badge ── */
    .badge-aktif {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 10px; border-radius: 20px;
        background: rgba(16,185,129,0.1);
        border: 1px solid rgba(16,185,129,0.25);
        color: #34d399; font-size: 0.72rem; font-weight: 600;
    }
    .badge-aktif-dot { width: 6px; height: 6px; border-radius: 50%; background: #10b981;
        box-shadow: 0 0 6px rgba(16,185,129,0.8); animation: pulse-dot 2s infinite; }
    .badge-nonaktif {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 10px; border-radius: 20px;
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.25);
        color: #f87171; font-size: 0.72rem; font-weight: 600;
    }
    .badge-nonaktif-dot { width: 6px; height: 6px; border-radius: 50%; background: #ef4444; }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; box-shadow: 0 0 6px rgba(16,185,129,0.8); }
        50% { opacity: 0.6; box-shadow: 0 0 2px rgba(16,185,129,0.4); }
    }

    /* ── Avatar ── */
    .guru-avatar {
        width: 34px; height: 34px; border-radius: 50%; object-fit: cover;
        border: 1px solid rgba(16,185,129,0.2);
        box-shadow: 0 0 8px rgba(16,185,129,0.08);
    }

    /* ── Page header gradient ── */
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.7rem; font-family: monospace;
        letter-spacing: 0.15em; text-transform: uppercase;
        color: #34d399; margin-bottom: 4px;
    }
    .page-header-badge-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #34d399; box-shadow: 0 0 8px rgba(52,211,153,0.8);
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

<main class="flex-1 flex flex-col max-h-screen" style="background: #080e1a;">
    <div class="flex-1 overflow-y-auto p-8"
         style="background: radial-gradient(ellipse at 80% 0%, rgba(16,185,129,0.05) 0%, transparent 55%), #080e1a;">
        <div class="max-w-7xl mx-auto space-y-7">
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
                    <span>Guru</span>
                </div>
            </div>

            <!-- ── Page Header ── -->
            <div>
                <div class="page-header-badge">
                    <span class="page-header-badge-dot"></span>
                    Manajemen Akun
                </div>
                <h2 class="text-2xl font-bold text-white" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 20px rgba(16,185,129,0.25);">
                    Manajemen Akun Guru
                </h2>
                <p class="text-slate-500 text-sm mt-1">Manajemen dan monitoring data Guru aktif dalam sistem.</p>
            </div>

            <!-- ── Stats Cards ── -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Total Guru -->
                <div class="stat-card stat-card-purple">
                    <div class="stat-icon-wrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Total Guru</p>
                    <p class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $totalGuru }}</p>
                </div>

                <!-- Guru Aktif -->
                <div class="stat-card stat-card-green">
                    <div class="stat-icon-wrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Guru Aktif</p>
                    <p class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $guruAktif }}</p>
                </div>

                <!-- Guru Tidak Aktif -->
                <div class="stat-card stat-card-red">
                    <div class="stat-icon-wrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Tidak Aktif</p>
                    <p class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $guruTidakAktif }}</p>
                </div>

                <!-- Akun Baru -->
                <div class="stat-card stat-card-blue">
                    <div class="stat-icon-wrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Akun Baru</p>
                    <p class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $guruBaru }}</p>
                </div>
            </div>

            <!-- ── Toolbar: Search + Actions ── -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Search & Filters -->
                <form method="GET" action="{{ route('superadmin.guru') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    <!-- Search -->
                    <div class="relative flex-1 min-w-[200px] max-w-xs">
                        <svg class="w-4 h-4 text-slate-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari Nama atau NIG..."
                               class="neon-search">
                    </div>

                    <!-- Gender Filter -->
                    <div class="relative">
                        <select name="jenis_kelamin" onchange="this.form.submit()" class="neon-filter-select">
                            <option value="">Semua Gender</option>
                            <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Pria</option>
                            <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Wanita</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <select name="status" onchange="this.form.submit()" class="neon-filter-select">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>

                    <button type="submit" class="btn-search">Cari</button>

                    @if(request('search') || request('jenis_kelamin') || request('status'))
                        <a href="{{ route('superadmin.guru') }}"
                           class="text-xs text-red-400 hover:text-red-300 flex items-center gap-1 transition px-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reset
                        </a>
                    @endif
                </form>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                    <a href="{{ route('superadmin.guru.template') }}" class="btn-emerald-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download Template
                    </a>
                    <a href="{{ route('superadmin.guru.create') }}" class="btn-green-solid">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Guru Baru
                    </a>
                </div>
            </div>

            <!-- ── Data Table ── -->
            <div class="data-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th class="w-10">
                                <input type="checkbox" class="rounded border-slate-600 bg-slate-800 text-emerald-500 focus:ring-emerald-500">
                            </th>
                            <th>NIG</th>
                            <th>Nama Lengkap</th>
                            <th>Jml Sub Wilayah</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($guru as $data)
                        <tr>
                            <td>
                                <input type="checkbox" class="rounded border-slate-600 bg-slate-800 text-emerald-500">
                            </td>
                            <td>
                                <span class="font-mono text-emerald-400 text-xs">{{ $data->nomor_induk }}</span>
                            </td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="{{ $data->avatar_url }}" alt="{{ $data->nama }}" class="guru-avatar">
                                    <span class="text-white font-medium">{{ $data->nama }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="text-slate-400">{{ $data->sub_wilayahs_count }}</span>
                            </td>
                            <td>
                                @if ($data->jenis_kelamin == 'L')
                                    <div class="flex items-center gap-2 text-blue-400">
                                        <div class="w-6 h-6 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="10" cy="14" r="5"/><line x1="13.5" y1="10.5" x2="21" y2="3"/><polyline points="16 3 21 3 21 8"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium">Laki-laki</span>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2 text-pink-400">
                                        <div class="w-6 h-6 rounded-full bg-pink-500/10 border border-pink-500/20 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="10" r="5"/><line x1="12" y1="15" x2="12" y2="22"/><line x1="9" y1="19" x2="15" y2="19"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium">Perempuan</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if ($data->status == 'aktif')
                                    <span class="badge-aktif">
                                        <span class="badge-aktif-dot"></span> Aktif
                                    </span>
                                @else
                                    <span class="badge-nonaktif">
                                        <span class="badge-nonaktif-dot"></span> Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('superadmin.guru.edit', $data->id) }}"
                                       class="action-btn-edit" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('superadmin.guru.destroy', $data->id) }}"
                                          method="POST" id="deleteForm-{{ $data->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="confirmDelete('{{ $data->id }}', '{{ $data->nama }}')"
                                                class="action-btn-delete" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 rounded-full flex items-center justify-center mb-4"
                                         style="background: rgba(16,185,129,0.05); border: 1px solid rgba(16,185,129,0.12);">
                                        <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-semibold text-white mb-1">Belum Ada Data Guru</h3>
                                    <p class="text-sm text-slate-500 max-w-sm">
                                        Saat ini belum ada data guru yang terdaftar. Anda bisa menambahkannya secara manual atau mengimpor data.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- ── Footer: Log Ticker + Pagination ── -->
    <div style="background: #080e1a; border-top: 1px solid rgba(16,185,129,0.08);">
        <!-- Terminal log -->
        <div class="px-6 py-2 border-b font-mono text-[11px] text-slate-600 tracking-wider overflow-hidden whitespace-nowrap"
             style="border-color: rgba(16,185,129,0.06);">
            <div class="w-full overflow-hidden">
                <div class="animate-ticker gap-8">
                    @forelse($logs as $log)
                        <span>
                            &gt; [{{ $log['waktu'] }}]
                            <span class="text-{{ $log['tipe_aksi'] == 'DELETE' ? 'red' : ($log['tipe_aksi'] == 'UPDATE' ? 'amber' : 'emerald') }}-400">
                                {{ $log['tipe_aksi'] }}
                            </span>: {{ $log['deskripsi'] }}&nbsp;&nbsp;&nbsp;
                        </span>
                    @empty
                        <span>&gt; Menunggu aktivitas sistem...</span>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="py-6 flex justify-center">
            {{ $guru->links('vendor.pagination.tailwind') }}
        </div>
    </div>

</main>

<script>
    function confirmDelete(id, guruName) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: "Data guru <span class='font-bold text-emerald-400'>" + guruName + "</span> akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#334155',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#0a1020',
            color: '#e2e8f0'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm-' + id).submit();
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                background: '#0a1020',
                color: '#e2e8f0',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    });
</script>
@endsection

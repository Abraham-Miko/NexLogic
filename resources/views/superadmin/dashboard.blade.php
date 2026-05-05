@extends('layouts.superadmin')
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

    .bento-amber {
        background: rgba(245, 158, 11, 0.05);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }
    .bento-amber:hover {
        border-color: rgba(245, 158, 11, 0.5);
        box-shadow: 0 0 24px rgba(245, 158, 11, 0.1);
    }

    .bento-red {
        background: rgba(239, 68, 68, 0.05);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    .bento-red:hover {
        border-color: rgba(239, 68, 68, 0.5);
        box-shadow: 0 0 24px rgba(239, 68, 68, 0.1);
    }

    /* ── Stat Icon ── */
    .stat-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
    }

    /* ── Chart containers ── */
    .chart-card {
        position: relative;
        background: rgba(10, 16, 32, 0.7);
        border: 1px solid rgba(99, 102, 241, 0.1);
        border-radius: 16px;
        backdrop-filter: blur(8px);
        overflow: hidden;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .chart-card:hover {
        border-color: rgba(99, 102, 241, 0.25);
        box-shadow: 0 0 40px rgba(99, 102, 241, 0.07);
    }
    .chart-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(to right, transparent, rgba(99,102,241,0.3), transparent);
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
</style>

<div class="p-8" style="min-height: 100%;">
    <div class="max-w-7xl mx-auto">

        <!-- ── Page Header ── -->
        <div class="mb-8">
            <div class="page-header-badge">
                <span class="page-header-badge-dot"></span>
                Command Center
            </div>
            <h1 class="text-3xl font-bold text-white" style="font-family: 'Orbitron', monospace; text-shadow: 0 0 24px rgba(129,140,248,0.2);">
                Dashboard
            </h1>
            <p class="text-slate-500 mt-1">Selamat datang kembali, kelola ringkasan sistem Anda di sini.</p>
        </div>

        <!-- ========================================== -->
        <!-- PERINGATAN KRITIS (ACTIONABLE ALERTS) -->
        <!-- ========================================== -->
        @if($siswaTanpaKelas > 0 || $kelasTanpaWali > 0)
        <div class="mb-6 space-y-3">

            @if($siswaTanpaKelas > 0)
            <div class="bento-card bento-amber flex items-center justify-between p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-amber-500/15 rounded-xl text-amber-400 border border-amber-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-sm">Siswa Membutuhkan Kelas</h4>
                        <p class="text-xs text-amber-400/80 mt-0.5">Ada <strong>{{ $siswaTanpaKelas }} siswa</strong> aktif yang belum ditempatkan di kelas manapun.</p>
                    </div>
                </div>
                <a href="{{ route('superadmin.siswa') }}" class="text-xs font-semibold text-amber-400 bg-amber-500/10 hover:bg-amber-500/20 px-4 py-2 rounded-lg transition-colors border border-amber-500/20 whitespace-nowrap shrink-0">
                    Tindak Lanjuti →
                </a>
            </div>
            @endif

            @if($kelasTanpaWali > 0)
            <div class="bento-card bento-red flex items-center justify-between p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-red-500/15 rounded-xl text-red-400 border border-red-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-sm">Kelas Tanpa Wali Guru</h4>
                        <p class="text-xs text-red-400/80 mt-0.5">Ada <strong>{{ $kelasTanpaWali }} kelas</strong> yang belum memiliki wali kelas.</p>
                    </div>
                </div>
                <a href="{{ route('superadmin.wilayah') }}" class="text-xs font-semibold text-red-400 bg-red-500/10 hover:bg-red-500/20 px-4 py-2 rounded-lg transition-colors border border-red-500/20 whitespace-nowrap shrink-0">
                    Tindak Lanjuti →
                </a>
            </div>
            @endif

        </div>
        @endif

        <!-- ========================================== -->
        <!-- BENTO GRID: KARTU STATISTIK UTAMA -->
        <!-- ========================================== -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <!-- Card 1: Total Siswa Aktif -->
            <div class="bento-card bento-indigo p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Total Siswa Aktif</p>
                <h3 class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $totalSiswa }}</h3>
            </div>

            <!-- Card 2: Total Guru -->
            <div class="bento-card bento-emerald p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon text-emerald-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Total Guru</p>
                <h3 class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $totalGuru }}</h3>
            </div>

            <!-- Card 3: Total Wilayah -->
            <div class="bento-card bento-blue p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Total Wilayah</p>
                <h3 class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $totalWilayah }}</h3>
            </div>

            <!-- Card 4: Total Kelas -->
            <div class="bento-card bento-purple p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Total Kelas</p>
                <h3 class="text-4xl font-bold text-white" style="font-family: 'Orbitron', monospace;">{{ $totalKelas }}</h3>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- BENTO GRID: GRAFIK -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            <!-- Grafik Donat: Rasio Gender -->
            <div class="chart-card p-5 col-span-1">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <p class="text-xs text-slate-500 tracking-widest uppercase mb-0.5" style="font-family: 'Orbitron'">Visualisasi</p>
                        <h3 class="text-base font-bold text-white">Rasio Gender Siswa</h3>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/15 flex items-center justify-center text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                    </div>
                </div>

                <div class="relative h-56 w-full flex justify-center">
                    <canvas id="genderChart"></canvas>
                </div>

                <div class="flex justify-center gap-6 mt-4 pt-4 border-t border-white/5">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-[0_0_6px_rgba(59,130,246,0.8)]"></span>
                        <span class="text-xs text-slate-400">Laki-laki <span class="text-white font-medium">({{ $siswaLaki }})</span></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-pink-500 shadow-[0_0_6px_rgba(236,72,153,0.8)]"></span>
                        <span class="text-xs text-slate-400">Perempuan <span class="text-white font-medium">({{ $siswaPerempuan }})</span></span>
                    </div>
                </div>
            </div>

            <!-- Grafik Batang: Distribusi Siswa per Kelas -->
            <div class="chart-card p-5 col-span-1 lg:col-span-2">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <p class="text-xs font-mono text-slate-500 tracking-widest uppercase mb-0.5">Analitik</p>
                        <h3 class="text-base font-bold text-white">Distribusi Siswa per Kelas</h3>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/15 flex items-center justify-center text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
                <div class="relative h-56 w-full">
                    <canvas id="kelasChart"></canvas>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Donat Chart: Gender ──
        const ctx = document.getElementById('genderChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $siswaLaki }}, {{ $siswaPerempuan }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.85)',
                        'rgba(236, 72, 153, 0.85)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(236, 72, 153, 1)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '78%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(8, 14, 26, 0.95)',
                        titleColor: '#fff',
                        bodyColor: '#94a3b8',
                        borderColor: 'rgba(99,102,241,0.2)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8
                    }
                }
            }
        });

        // ── Bar Chart: Distribusi Kelas ──
        const ctxKelas = document.getElementById('kelasChart').getContext('2d');
        new Chart(ctxKelas, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelKelas) !!},
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: {!! json_encode($dataSiswaKelas) !!},
                    backgroundColor: 'rgba(99, 102, 241, 0.75)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                    barPercentage: 0.6,
                    hoverBackgroundColor: 'rgba(129, 140, 248, 0.9)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(8, 14, 26, 0.95)',
                        titleColor: '#fff',
                        bodyColor: '#94a3b8',
                        borderColor: 'rgba(99,102,241,0.2)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#475569', stepSize: 5 },
                        grid: { color: 'rgba(99,102,241,0.06)' },
                        border: { color: 'rgba(99,102,241,0.1)' }
                    },
                    x: {
                        ticks: { color: '#475569' },
                        grid: { display: false },
                        border: { color: 'rgba(99,102,241,0.1)' }
                    }
                }
            }
        });
    });
</script>
@endsection

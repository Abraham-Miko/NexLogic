<x-app-layout>
    <style>
        .dashboard-container {
            padding: 40px;
            background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
            min-height: 100vh;
            color: white;
        }
        .welcome-hero {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(124, 58, 237, 0.3);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 24px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #a78bfa;
            margin-top: 8px;
        }
        .materi-list {
            background: rgba(15, 23, 42, 0.6);
            border-radius: 24px;
            padding: 32px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .materi-item {
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.2s;
        }
        .materi-item:last-child { border-bottom: none; }
        .materi-item:hover { background: rgba(124, 58, 237, 0.05); }

        .progress-mini-bar {
            width: 100px;
            height: 6px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-left: auto;
        }
        .progress-fill {
            height: 100%;
            background: #10b981;
            box-shadow: 0 0 10px #10b981;
        }
        .badge-locked {
            background: rgba(248, 113, 113, 0.1);
            color: #f87171;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
        }
    </style>

    <div class="dashboard-container">
        <div class="welcome-hero">
            <div>
                <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 8px;">
                    Selamat Datang, {{ explode(' ', $user->nama)[0] }}! 👋
                </h1>
                <p style="color: #94a3b8; font-size: 1.1rem;">
                    Siap untuk mengasah logika pemrogramanmu hari ini di {{ $subWilayah->nama_sub_wilayah ?? 'Kelas Belum Terdaftar' }}?
                </p>
            </div>
            <div style="text-align: right;">
                <span style="display: block; color: #94a3b8; margin-bottom: 4px;">Sub-Wilayah</span>
                <span style="font-weight: 700; color: #f8fafc;">{{ $subWilayah->nama_sub_wilayah ?? '-' }}</span>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <span style="color: #94a3b8;">Total Poin Dikumpulkan</span>
                <div class="stat-value">{{ number_format($totalXP) }} poin</div>
            </div>
            <div class="stat-card">
                <span style="color: #94a3b8;">Progress Keseluruhan</span>
                <div class="stat-value">{{ $overallProgress }}%</div>
                <div class="progress-mini-bar" style="width: 100%; margin-top: 12px;">
                    <div class="progress-fill" style="width: {{ $overallProgress }}%"></div>
                </div>
            </div>
            <div class="stat-card">
                <span style="color: #94a3b8;">Peringkat Kelas</span>
                <div class="stat-value">

                    @if (!empty($user->sub_wilayah_id))
                        {{-- Ganti 'sub_wilayah_id' dengan nama kolom yang sesuai di database Anda --}}
                        #{{ $userRank }}
                    @else
                        <p style="font-size: 2rem; display: block;">Belum Ada Wilayah</p>
                    @endif

                </div>
            </div>
        </div>

        <div class="materi-list">
            <h2 style="margin-bottom: 24px; font-weight: 700;">Ringkasan Materi</h2>
            @foreach($materis as $id => $data)
                <div class="materi-item">
                    <div style="width: 40px; height: 40px; background: rgba(124, 58, 237, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                        {{ $id }}
                    </div>
                    <div>
                        <h4 style="font-weight: 600;">{{ $data['judul'] }}</h4>
                        <span style="font-size: 0.8rem; color: #64748b;">{{ $data['level'] }}</span>
                    </div>

                    @if(!($statusMateri[$id] ?? false))
                        <div style="margin-left: auto;">
                            <span class="badge-locked">Terkunci oleh Guru</span>
                        </div>
                    @else
                        <div style="margin-left: auto; text-align: right;">
                            <span style="font-size: 0.85rem; color: #94a3b8; display: block; margin-bottom: 4px;">
                                {{ $progressMateri[$id] }}% Selesai
                            </span>
                            <div class="progress-mini-bar">
                                <div class="progress-fill" style="width: {{ $progressMateri[$id] }}%"></div>
                            </div>
                        </div>
                        <a href="{{ route('courses.show', $id) }}" style="margin-left: 24px; color: #a78bfa;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

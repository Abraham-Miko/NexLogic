<x-app-layout>
    <style>
        /* Base Dot Grid Background */
        .leaderboard-wrapper {
            position: relative;
            min-height: 100vh;
            background-color: var(--bg-deep);
            padding: 32px 48px;
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .leaderboard-wrapper::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, rgba(99, 102, 241, 0.15) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
            z-index: 0;
        }

        .content-container {
            position: relative;
            z-index: 1;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Top Bar & Breadcrumb */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .breadcrumb {
            font-size: 1rem;
            color: #94a3b8;
            font-weight: 500;
        }
        .breadcrumb span {
            color: #fff;
            margin-left: 8px;
        }

        /* Header Texts */
        .page-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 8px;
        }
        .page-subtitle {
            text-align: center;
            color: #a78bfa;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 60px;
        }

        /* Podium Layout */
        .podium-section {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 16px;
            margin-bottom: 60px;
            height: 280px;
        }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .podium-card {
            background: linear-gradient(180deg, rgba(99, 102, 241, 0.15) 0%, rgba(30, 41, 59, 0.8) 100%);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-top: 6px solid #8b5cf6;
            border-radius: 16px 16px 0 0;
            padding: 24px 16px;
            text-align: center;
            width: 200px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: slideUpFade 0.6s ease-out forwards;
            opacity: 0;
        }

        .podium-card.rank-1 {
            height: 260px;
            width: 220px;
            border-top-color: #a78bfa;
            background: linear-gradient(180deg, rgba(124, 58, 237, 0.2) 0%, rgba(30, 41, 59, 0.9) 100%);
            animation-delay: 0.2s;
            z-index: 2;
            box-shadow: 0 0 40px rgba(124, 58, 237, 0.2);
        }

        .podium-card.rank-2 { height: 200px; animation-delay: 0.1s; }
        .podium-card.rank-3 { height: 180px; animation-delay: 0.3s; }

        /* Podium Text & Badges */
        .rank-number {
            font-size: 2.5rem;
            font-weight: 800;
            font-family: 'JetBrains Mono', monospace;
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            text-shadow: 0 4px 12px rgba(0,0,0,0.5);
        }

        .avatar-img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            border: 2px solid rgba(167, 139, 250, 0.5);
            margin: 0 auto 12px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        .rank-1 .avatar-img {
            width: 80px;
            height: 80px;
            border: 3px solid #a78bfa;
        }

        .player-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: #f8fafc;
            margin-bottom: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .score-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 14px;
            border-radius: 999px;
            border: 1px solid rgba(251, 191, 36, 0.4);
            background: rgba(251, 191, 36, 0.1);
        }

        .star-text {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            color: #fbbf24;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
        }
        .star-text svg {
            width: 16px;
            height: 16px;
            fill: #fbbf24;
        }

        /* Leaderboard Table */
        .list-table-container {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 16px;
            padding: 12px;
            animation: slideUpFade 0.6s ease-out 0.5s forwards;
            opacity: 0;
            backdrop-filter: blur(10px);
        }

        .list-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .list-table th {
            padding: 16px;
            color: #94a3b8;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .list-table td {
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 1rem;
            color: #cbd5e1;
            vertical-align: middle;
        }

        .list-table tr:last-child td { border-bottom: none; }
        .list-table tr:hover td { background: rgba(124, 58, 237, 0.05); }

        .table-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 14px;
            vertical-align: middle;
            border: 1px solid rgba(255,255,255,0.1);
        }
    </style>

    <div class="leaderboard-wrapper">
        <div class="content-container">

            {{-- Header & Breadcrumb --}}
            <div class="top-header">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" style="color: #94a3b8; text-decoration: none;">Home</a> <span>> Leaderboard</span>
                </div>
            </div>

            {{-- Title --}}
            <h1 class="page-title">Peringkat Global</h1>
            <p class="page-subtitle">Berdasarkan Total Poin Sub-Wilayah: {{ $wilayah }}</p>

            {{-- Podium Section --}}
            <div class="podium-section">

                {{-- Rank 2 --}}
                <div class="podium-card rank-2">
                    <div class="rank-number">#2</div>
                    <img src="{{ $top3[2]['avatar'] }}" alt="Avatar" class="avatar-img">
                    <div class="player-name">{{ $top3[2]['nama'] }}</div>
                    <div class="score-badge">
                        <span class="star-text">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            {{ number_format($top3[2]['poin'], 0, ',', '.') }} Poin
                        </span>
                    </div>
                </div>

                {{-- Rank 1 --}}
                <div class="podium-card rank-1">
                    <div class="rank-number">#1</div>
                    <img src="{{ $top3[1]['avatar'] }}" alt="Avatar" class="avatar-img">
                    <div class="player-name">{{ $top3[1]['nama'] }}</div>
                    <div class="score-badge">
                        <span class="star-text">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            {{ number_format($top3[1]['poin'], 0, ',', '.') }} Poin
                        </span>
                    </div>
                </div>

                {{-- Rank 3 --}}
                <div class="podium-card rank-3">
                    <div class="rank-number">#3</div>
                    <img src="{{ $top3[3]['avatar'] }}" alt="Avatar" class="avatar-img">
                    <div class="player-name">{{ $top3[3]['nama'] }}</div>
                    <div class="score-badge">
                        <span class="star-text">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            {{ number_format($top3[3]['poin'], 0, ',', '.') }} Poin
                        </span>
                    </div>
                </div>
            </div>

            {{-- Table Section (Rank 4+) --}}
            <div class="list-table-container">
                <table class="list-table">
                    <thead>
                        <tr>
                            <th width="15%">Peringkat</th>
                            <th width="60%">Nama Pemain</th>
                            <th width="25%" style="text-align: right;">Total Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($others as $rank => $user)
                        <tr>
                            <td style="font-family: 'JetBrains Mono', monospace; font-weight: 600; color: #94a3b8;">
                                #{{ $rank }}
                            </td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <img src="{{ $user['avatar'] }}" alt="Avatar" class="table-avatar">
                                    <span style="font-weight: 600; color: #f8fafc;">{{ $user['nama'] }}</span>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div class="star-text" style="justify-content: flex-end;">
                                    {{ number_format($user['poin'], 0, ',', '.') }}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: #64748b; padding: 32px;">
                                Belum ada pemain lain di wilayah ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

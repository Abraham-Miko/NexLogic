<x-app-layout>
    <style>
        /* Base Dot Grid Background */
        .leaderboard-wrapper {
            position: relative;
            min-height: 100vh;
            background-color: var(--bg-deep);
            padding: 32px 48px;
            color: #fff;
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

        /* Custom Dropdown Styling */
        .custom-dropdown {
            position: relative;
            min-width: 180px;
        }
        
        .dropdown-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: #f8fafc;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            backdrop-filter: blur(8px);
        }
        
        .dropdown-trigger:hover:not(.disabled) {
            background-color: rgba(30, 41, 59, 0.9);
            border-color: rgba(148, 163, 184, 0.4);
        }
        
        .dropdown-trigger.disabled {
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: default;
            width: 140px;
            background-color: #0f172a;
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .dropdown-trigger svg {
            width: 18px;
            height: 18px;
            color: #94a3b8;
            transition: transform 0.3s ease;
        }
        
        .custom-dropdown.open .dropdown-trigger svg {
            transform: rotate(180deg);
        }

        .dropdown-menu-wilayah {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 100%;
            background-color: #0f172a;
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            padding: 8px;
            z-index: 50;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5), 0 8px 10px -6px rgba(0, 0, 0, 0.3);
        }

        .dropdown-item-wilayah {
            display: block;
            padding: 10px 14px;
            margin-bottom: 5px;
            color: #cbd5e1;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .dropdown-item-wilayah:hover, .dropdown-item-wilayah.active {
            background-color: rgba(124, 58, 237, 0.15);
            color: #a78bfa;
        }

        /* Header Texts */
        .page-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .page-subtitle {
            text-align: center;
            color: #94a3b8;
            font-size: 1rem;
            margin-bottom: 24px;
        }

        /* Custom Toggle Switch */
        .toggle-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 48px;
        }
        .toggle-label {
            font-size: 1rem;
            font-weight: 600;
            color: #94a3b8;
            transition: color 0.3s;
            cursor: pointer;
        }
        .toggle-label.active {
            color: #fff;
        }
        
        .switch-track {
            width: 54px;
            height: 28px;
            background-color: #1e293b;
            border-radius: 999px;
            position: relative;
            cursor: pointer;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.3);
            border: 1px solid #334155;
            transition: background-color 0.3s;
        }
        .switch-thumb {
            width: 22px;
            height: 22px;
            background: linear-gradient(135deg, #a78bfa, #7c3aed);
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(124, 58, 237, 0.6);
        }
        .is-star .switch-thumb {
            transform: translateX(26px);
        }

        /* Podium Layout */
        .podium-section {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 16px;
            margin-bottom: 60px;
            height: 280px; /* fixed height for podium */
        }

        /* Keyframes for Podium Entrance */
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
        
        .podium-card.rank-2 {
            height: 200px;
            animation-delay: 0.1s;
        }

        .podium-card.rank-3 {
            height: 180px;
            animation-delay: 0.3s;
        }

        /* Podium Text & Badges */
        .rank-number {
            font-size: 2.5rem;
            font-weight: 800;
            font-family: 'Orbitron', sans-serif;
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
            padding: 4px 12px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 0.8rem;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            color: #e2e8f0;
            background: rgba(0, 0, 0, 0.2);
        }

        .streak-indicator {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.65rem;
            font-weight: 700;
            color: #cbd5e1;
        }
        .streak-indicator span {
            font-size: 1.2rem;
            line-height: 1;
        }

        /* Leaderboard Table */
        .list-table-container {
            background: transparent;
            border-radius: 12px;
            overflow: hidden;
            animation: slideUpFade 0.6s ease-out 0.5s forwards;
            opacity: 0;
        }

        .list-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .list-table th {
            padding: 16px;
            color: #e2e8f0;
            font-weight: 700;
            font-size: 0.95rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .list-table td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.95rem;
            color: #cbd5e1;
            vertical-align: middle;
        }

        .list-table tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        .table-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 12px;
            vertical-align: middle;
        }

        .exp-text {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
        }
        
        .star-text {
            font-weight: 600;
            color: #fbbf24; /* Yellow color for stars */
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Value Transitions */
        .value-transition-enter {
            transition: all 0.3s ease-out;
            opacity: 1;
            transform: translateY(0);
        }
        .value-transition-enter-start {
            opacity: 0;
            transform: translateY(10px);
        }
        .value-transition-leave {
            transition: all 0.2s ease-in;
            opacity: 0;
            transform: translateY(-10px);
            position: absolute; /* prevent layout shift during leave */
        }
    </style>

    <div class="leaderboard-wrapper" x-data="{ tab: 'exp' }">
        <div class="content-container">
            
            {{-- Header & Breadcrumb --}}
            <div class="top-header">
                <div class="breadcrumb">
                    Home <span>> Leaderboard</span>
                </div>
                <div>
                    @php
                        $userRole = Auth::user()->role ?? 'siswa'; 
                    @endphp
                    
                    <div class="custom-dropdown" x-data="{ openDropdown: false }" :class="{ 'open': openDropdown }" @click.away="openDropdown = false">
                        @if($userRole === 'siswa')
                            <div class="dropdown-trigger disabled">
                                {{ $wilayah }}
                            </div>
                        @else
                            <button @click="openDropdown = !openDropdown" class="dropdown-trigger">
                                <div class="mr-11">{{ $wilayah }}</div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div class="dropdown-menu-wilayah" x-show="openDropdown" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" style="display: none;">
                                @foreach($availableWilayah as $w)
                                    <a href="{{ route('leaderboard.index', ['wilayah' => $w]) }}" class="dropdown-item-wilayah {{ $wilayah === $w ? 'active' : '' }}">
                                        {{ $w }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Title --}}
            <h1 class="page-title">Peringkat Wilayah {{ $wilayah }}</h1>
            <p class="page-subtitle">Lihat peringkatmu berdasarkan</p>

            {{-- Toggle Switch --}}
            <div class="toggle-container" :class="{ 'is-star': tab === 'star' }">
                <div class="toggle-label" :class="{ 'active': tab === 'exp' }" @click="tab = 'exp'">Top EXP</div>
                <div class="switch-track" @click="tab = tab === 'exp' ? 'star' : 'exp'">
                    <div class="switch-thumb"></div>
                </div>
                <div class="toggle-label" :class="{ 'active': tab === 'star' }" @click="tab = 'star'">Top Star</div>
            </div>

            {{-- Podium Section --}}
            <div class="podium-section">
                
                {{-- Rank 2 --}}
                <div class="podium-card rank-2">
                    <div class="rank-number">#2</div>
                    
                    {{-- Streak indicator (EXP only) --}}
                    <div class="streak-indicator" x-show="tab === 'exp'" x-transition.opacity>
                        <span>🔥</span>
                        {{ $top3[2]['streak'] }} Streak
                    </div>
                    
                    <img src="{{ $top3[2]['avatar'] }}" alt="Avatar" class="avatar-img">
                    <div class="player-name">{{ $top3[2]['nama'] }}</div>
                    
                    <div class="score-badge relative">
                        <span x-show="tab === 'exp'" x-transition:enter="value-transition-enter" x-transition:enter-start="value-transition-enter-start" x-transition:leave="value-transition-leave">{{ number_format($top3[2]['exp'], 0, ',', '.') }} EXP</span>
                        <span x-show="tab === 'star'" style="display:none;" class="star-text" x-transition:enter="value-transition-enter" x-transition:enter-start="value-transition-enter-start" x-transition:leave="value-transition-leave">⭐ {{ $top3[2]['star'] }}</span>
                    </div>
                </div>

                {{-- Rank 1 --}}
                <div class="podium-card rank-1">
                    <div class="rank-number">#1</div>
                    
                    {{-- Streak indicator (EXP only) --}}
                    <div class="streak-indicator" x-show="tab === 'exp'" x-transition.opacity>
                        <span>🔥</span>
                        {{ $top3[1]['streak'] }} Streak
                    </div>
                    
                    <img src="{{ $top3[1]['avatar'] }}" alt="Avatar" class="avatar-img">
                    <div class="player-name">{{ $top3[1]['nama'] }}</div>
                    
                    <div class="score-badge relative">
                        <span x-show="tab === 'exp'" x-transition:enter="value-transition-enter" x-transition:enter-start="value-transition-enter-start" x-transition:leave="value-transition-leave">{{ number_format($top3[1]['exp'], 0, ',', '.') }} EXP</span>
                        <span x-show="tab === 'star'" style="display:none;" class="star-text" x-transition:enter="value-transition-enter" x-transition:enter-start="value-transition-enter-start" x-transition:leave="value-transition-leave">⭐ {{ $top3[1]['star'] }}</span>
                    </div>
                </div>

                {{-- Rank 3 --}}
                <div class="podium-card rank-3">
                    <div class="rank-number">#3</div>
                    
                    {{-- Streak indicator (EXP only) --}}
                    <div class="streak-indicator" x-show="tab === 'exp'" x-transition.opacity>
                        <span>🔥</span>
                        {{ $top3[3]['streak'] }} Streak
                    </div>
                    
                    <img src="{{ $top3[3]['avatar'] }}" alt="Avatar" class="avatar-img">
                    <div class="player-name">{{ $top3[3]['nama'] }}</div>
                    
                    <div class="score-badge relative">
                        <span x-show="tab === 'exp'" x-transition:enter="value-transition-enter" x-transition:enter-start="value-transition-enter-start" x-transition:leave="value-transition-leave">{{ number_format($top3[3]['exp'], 0, ',', '.') }} EXP</span>
                        <span x-show="tab === 'star'" style="display:none;" class="star-text" x-transition:enter="value-transition-enter" x-transition:enter-start="value-transition-enter-start" x-transition:leave="value-transition-leave">⭐ {{ $top3[3]['star'] }}</span>
                    </div>
                </div>
            </div>

            {{-- Table Section --}}
            <div class="list-table-container">
                <table class="list-table">
                    <thead>
                        <tr>
                            <th width="15%">Peringkat</th>
                            <th width="45%">Nama</th>
                            <th width="20%">
                                <span x-show="tab === 'exp'">Total EXP</span>
                                <span x-show="tab === 'star'" style="display: none;">Total Star</span>
                            </th>
                            <th width="20%" style="text-align: right;">
                                <span x-show="tab === 'exp'">Streak</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($others as $rank => $user)
                        <tr>
                            <td>#{{ $rank }}</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <img src="{{ $user['avatar'] }}" alt="Avatar" class="table-avatar" style="margin-right: 0;">
                                    <span style="font-weight: 600; color: #f8fafc;">{{ $user['nama'] }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="exp-text" x-show="tab === 'exp'" x-transition.opacity>{{ number_format($user['exp'], 0, ',', '.') }} EXP</div>
                                <div class="star-text" x-show="tab === 'star'" style="display:none;" x-transition.opacity>⭐ {{ $user['star'] }}</div>
                            </td>
                            <td style="text-align: right;">
                                <div x-show="tab === 'exp'" x-transition.opacity class="exp-text">{{ $user['streak'] }} Streak</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

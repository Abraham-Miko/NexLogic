<aside class="sidebar" :class="{ 'expanded': sidebarOpen }">

    <style>
        /* ===================================================
           PENGATURAN DASAR & TRANSISI SIDEBAR
           =================================================== */
        .sidebar {
            background-color: #0f172a;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            width: 78px;
            overflow-x: hidden;
            transition: width 0.3s ease-in-out;
        }

        .sidebar.expanded {
            width: 200px;
        }

        /* ===================================================
           STYLE TOMBOL TOGGLE SIDEBAR (Neon White/Silver)
           =================================================== */
        .sidebar-toggle-wrapper {
            display: flex;
            padding: 8px 16px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar-toggle-btn {
            background: #1e293b; /* Background tombol sedikit lebih terang dari sidebar */
            border: 1px solid #334155;
            color: #94a3b8;
            border-radius: 8px;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease-in-out;
        }

        /* Hover effect ala Gaming (Glow Putih/Silver) */
        .sidebar-toggle-btn:hover {
            background-color: rgba(248, 250, 252, 0.08);
            color: #f8fafc;
            border-color: rgba(248, 250, 252, 0.4);
            box-shadow: 0 0 12px rgba(248, 250, 252, 0.2);
        }

        /* ===================================================
           --- STYLE DASAR NAVIGASI ---
           =================================================== */
        .nav-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 12px;
            border-radius: 12px;
            transition: all 0.3s ease-in-out;
        }

        .nav-item {
            display: flex;
            align-items: center;
            border-radius: 8px;
            text-decoration: none;
            color: #64748b; /* Warna teks redup default */
            font-weight: 500;
            border: 1px solid transparent;
            transition: all 0.25s ease-in-out;
        }

        .nav-item svg {
            width: 24px;
            height: 24px;
            color: currentColor;
            transition: transform 0.25s ease;
            flex-shrink: 0; /* Mencegah ikon gepeng saat transisi */
        }

        /* Sedikit animasi ikon saat kursor diarahkan */
        .nav-item:hover svg {
            transform: scale(1.1);
        }

        /* MASIH REVISI */
        .nav-label {
            transition: opacity 0.25s ease-in-out;
            white-space: nowrap;
            /* overflow: hidden; */
            max-width: 0;
            opacity: 0;
            margin-left: 0;
            transition: all 0.3s ease-in-out;
        }


        /* ===================================================
           PENGATURAN STATE: COLLAPSED vs EXPANDED (Penting)
           =================================================== */

        /* --- 1. STATE DEFAULT / COLLAPSED (Sidebar Menutup) --- */
        .sidebar:not(.expanded) .sidebar-toggle-wrapper {
            justify-content: center;
            padding: 8px;
        }

        .sidebar:not(.expanded) .nav-item {
            justify-content: center;
            padding: 12px; /* Padding sama rata agar kotak glow simetris */
            gap: 0;
        }

        .sidebar:not(.expanded) .nav-label {
            display: none; /* Sembunyikan teks label */
        }

        .sidebar:not(.expanded) .sidebar-footer {
            padding: 6px;
        }


        /* --- 2. STATE EXPANDED (Sidebar Terbuka) --- */
        .sidebar.expanded .sidebar-toggle-wrapper {
            justify-content: flex-start;
            padding: 12px 11px;
        }

        .sidebar.expanded .nav-item {
            justify-content: flex-start;
            padding: 12px 16px;
            gap: 12px; /* Beri jarak antara ikon dan teks */
        }

        .sidebar.expanded .nav-label {
            display: inline-block;
            opacity: 1;
        }


        /* ===================================================
           --- WARNA BERBEDA UNTUK TIAP ITEM (Hover & Active) ---
           =================================================== */

        /* 1. Home Page - Cyber Blue */
        .nav-home:hover {
            background-color: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.3);
        }
        .nav-home.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border-color: rgba(59, 130, 246, 0.3);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.15);
        }
        /* Mengubah warna garis penanda bawaan template */
        .nav-home.active::before, .nav-home.active::after {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }


        /* 2. Dashboard - Neon Purple */
        .nav-dashboard:hover {
            background-color: rgba(168, 85, 247, 0.1);
            border-color: rgba(168, 85, 247, 0.3);
        }
        .nav-dashboard.active {
            background-color: rgba(168, 85, 247, 0.1);
            color: #a855f7;
            border-color: rgba(168, 85, 247, 0.3);
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.15);
        }
        .nav-dashboard.active::before, .nav-dashboard.active::after {
            background-color: #a855f7;
            border-color: #a855f7;
        }


        /* 3. Course - Matrix Green */
        .nav-course:hover {
            background-color: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
        }
        .nav-course.active {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.15);
        }
        .nav-course.active::before, .nav-course.active::after {
            background-color: #10b981;
            border-color: #10b981;
        }


        /* 4. Puzzle - Lava Orange */
        .nav-puzzle:hover {
            background-color: rgba(249, 115, 22, 0.1);
            border-color: rgba(249, 115, 22, 0.3);
        }
        .nav-puzzle.active {
            background-color: rgba(249, 115, 22, 0.1);
            color: #f97316;
            border-color: rgba(249, 115, 22, 0.3);
            box-shadow: 0 0 15px rgba(249, 115, 22, 0.15);
        }
        .nav-puzzle.active::before, .nav-puzzle.active::after {
            background-color: #f97316;
            border-color: #f97316;
        }


        /* 5. Leaderboard - Gold / Yellow */
        .nav-leaderboard:hover {
            background-color: rgba(234, 179, 8, 0.1);
            border-color: rgba(234, 179, 8, 0.3);
        }
        .nav-leaderboard.active {
            background-color: rgba(234, 179, 8, 0.1);
            color: #eab308;
            border-color: rgba(234, 179, 8, 0.3);
            box-shadow: 0 0 15px rgba(234, 179, 8, 0.15);
        }
        .nav-leaderboard.active::before, .nav-leaderboard.active::after {
            background-color: #eab308;
            border-color: #eab308;
        }

        /* ===================================================
           STYLE TOMBOL PROFIL / LOGIN (Cyber Cyan Glow)
           =================================================== */
        .sidebar-footer {
            padding: 6px 12px;
            transition: all 0.3s ease-in-out;
        }

        /* Base style tombol profil mengikuti .nav-item */
        .nav-profile {
            color: #64748b;
            border: 1px solid transparent;
            transition: all 0.25s ease-in-out;
        }

        /* Hover effect ala Gaming (Glow Cyan / Aqua) */
        .nav-profile:hover{
            background-color: rgba(6, 182, 212, 0.1);
            border-color: rgba(6, 182, 212, 0.3);
        }
        .nav-profile.active {
            background-color: rgba(6, 182, 212, 0.1);
            color: #06b6d4;
            border-color: rgba(6, 182, 212, 0.3);
            box-shadow: 0 0 15px rgba(6, 182, 212, 0.15);
        }
        .nav-profile.active::before, .nav-profile.active::after {
            background-color: #06b6d4;
            border-color: #06b6d4;
        }

        /* Sedikit animasi ikon saat profil di-hover */
        .nav-profile:hover svg {
            transform: scale(1.1);
        }
    </style>

    {{-- Wrapper statis agar animasi mulus --}}
    <div class="sidebar-inner">

        {{-- Tombol Toggle Sidebar (Expand/Collapse) --}}
        <div class="sidebar-toggle-wrapper">
            <button class="sidebar-toggle-btn" @click="sidebarOpen = !sidebarOpen" :title="sidebarOpen ? 'Kecilkan Sidebar' : 'Perluas Sidebar'">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"
                    class="transition-transform duration-300" :class="{ 'rotate-180': !sidebarOpen }">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
        </div>

        {{-- Nav items --}}
        <nav class="nav-group">
            <hr style="opacity: 0.1; margin: 8px 0; border-color: #334155;">

            <a href="{{ route('/') }}" class="nav-item nav-home {{ request()->is('/') ? 'active' : '' }}" title="Home Page">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 2.5L21 10.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 11v8.5a1.5 1.5 0 001.5 1.5h11a1.5 1.5 0 001.5-1.5V11" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21v-6.5l3-2.5 3 2.5V21" />
                </svg>
                <span class="nav-label">Home Page</span>
            </a>

            <hr style="opacity: 0.1; margin: 8px 0; border-color: #334155;">

            @superadmin
                <a href="{{ route('superadmin.dashboard') }}" class="nav-item nav-dashboard {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}" title="Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                        <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                        <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                        <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                    </svg>
                    <span class="nav-label">Dashboard</span>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="nav-item nav-dashboard {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                        <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                        <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                        <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                    </svg>
                    <span class="nav-label">Dashboard</span>
                </a>
            @endsuperadmin

            <hr style="opacity: 0.1; margin: 8px 0; border-color: #334155;">

            <a href="{{ route('courses') }}" class="nav-item nav-course {{ request()->routeIs('courses*') ? 'active' : '' }}" title="Course">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="nav-label">Course</span>
            </a>

            <hr style="opacity: 0.1; margin: 8px 0; border-color: #334155;">

            @php
                // Cek aktif
                $isActive = request()->routeIs('puzzle.*');
            @endphp

            <a href="{{ route('puzzle.index') }}"
            class="nav-item nav-puzzle {{ $isActive ? 'active' : '' }}"
            title="Puzzle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                </svg>
                <span class="nav-label">Puzzle</span>
            </a>

            <hr style="opacity: 0.1; margin: 8px 0; border-color: #334155;">

            <a href="{{ route('leaderboard.index') }}" class="nav-item nav-leaderboard {{ request()->routeIs('leaderboard*') ? 'active' : '' }}" title="Leaderboard">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="nav-label">Leaderboard</span>
            </a>

            <hr style="opacity: 0.1; margin: 8px 0; border-color: #334155;">
        </nav>

        {{-- Footer / Profile --}}
        <div class="sidebar-footer">
            <hr style="opacity: 0.1; margin: 8px 0; border-color: #334155;">
            @auth
            <a href="{{ route('profile.edit') }}" class="nav-item nav-profile {{ request()->routeIs('profile*') ? 'active' : '' }}" title="Profile">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="nav-label">{{ explode(' ', trim(Auth::user()->nama))[0] }}</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="nav-item nav-profile" title="Login">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="nav-label">Login</span>
            </a>
            @endauth
        </div>

    </div>
</aside>

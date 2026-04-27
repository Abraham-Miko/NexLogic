{{-- <style>
    nav.nav-group::hover {
        background-color: rgba(236, 26, 236, 0.849);
    }
</style> --}}

<aside class="sidebar" :class="{ 'expanded': sidebarOpen }">

    {{-- Wrapper statis agar animasi mulus --}}
    <div class="sidebar-inner">

        {{-- Tombol Tutup Sidebar (Posisi di tengah) --}}
        <button class="sidebar-close-btn" @click="sidebarOpen = false" title="Tutup Sidebar">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" d="M15 5l-7 7 7 7"/>
            </svg>
        </button>

        {{-- Nav items --}}
        <nav class="nav-group">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                    <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                    <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                    <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                </svg>
            </a>

            <a href="" class="nav-item {{ request()->routeIs('materi*') ? 'active' : '' }}" title="Materi">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </a>

            <a href="" class="nav-item {{ request()->routeIs('tantangan*') ? 'active' : '' }}" title="Puzzle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                </svg>
            </a>

            <a href="" class="nav-item {{ request()->routeIs('leaderboard*') ? 'active' : '' }}" title="Leaderboard">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </a>
        </nav>

        {{-- Footer / Profile --}}
        <div class="sidebar-footer">
            @auth
            <a href="{{ route('profile.edit') }}" class="nav-item" title="Profile">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </a>
            @else
            <a href="{{ route('login') }}" class="nav-item" title="Login">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </a>
            @endauth
        </div>

    </div>
</aside>

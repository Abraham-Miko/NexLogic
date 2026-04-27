<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NexLogic</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Orbitron:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root {
                --sidebar-width-expanded: 72px; /* Dikecilkan untuk mode ikon-saja */
                --bg-deep: #080e1a;
                --bg-card: #0f172a;
                --sidebar-bg: #0a1020;
                --purple: #7c3aed;
                --purple-light: #a78bfa;
                --purple-glow: rgba(124, 58, 237, 0.35);
                --border: rgba(99, 102, 241, 0.15);
                --text-muted: #64748b;
                --text-dim: #94a3b8;
                --transition: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            }

            * { box-sizing: border-box; }

            html, body {
                margin: 0;
                padding: 0;
                background: var(--bg-deep);
                color: #e2e8f0;
                font-family: 'Plus Jakarta Sans', sans-serif;
                height: 100%;
                overflow: hidden;
            }

            /* ── App Shell ── */
            .app-shell {
                display: flex;
                flex-direction: column;
                height: 100vh;
                overflow: hidden;
                position: relative;
            }

            /* ── Topbar ── */
            .topbar {
                height: 60px;
                background: var(--bg-card);
                border-bottom: 1px solid var(--border);
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 28px;
                flex-shrink: 0;
                z-index: 60;
            }

            .topbar-logo {
                display: flex;
                align-items: center;
                gap: 10px;
                text-decoration: none;
                color: #fff;
            }

            .logo-orb {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: linear-gradient(135deg, #a78bfa, #7c3aed);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Orbitron', sans-serif;
                font-size: 12px;
                font-weight: 700;
                color: #fff;
                box-shadow: 0 0 12px var(--purple-glow);
            }

            .logo-name {
                font-family: 'Orbitron', sans-serif;
                font-size: 1rem;
                font-weight: 700;
                letter-spacing: 0.05em;
                color: #fff;
            }

            .topbar-actions {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .btn-login {
                padding: 7px 20px;
                border-radius: 8px;
                background: transparent;
                border: 1px solid var(--border);
                color: var(--text-dim);
                font-size: 0.85rem;
                font-weight: 500;
                text-decoration: none;
                transition: color 0.2s, border-color 0.2s, background 0.2s;
            }
            .btn-login:hover {
                color: #fff;
                border-color: rgba(167, 139, 250, 0.4);
                background: rgba(124, 58, 237, 0.08);
            }

            .user-dropdown-btn {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 6px 14px;
                border-radius: 8px;
                background: rgba(124, 58, 237, 0.08);
                border: 1px solid var(--border);
                color: var(--text-dim);
                font-size: 0.85rem;
                cursor: pointer;
                transition: all 0.2s;
            }
            .user-dropdown-btn:hover {
                color: #fff;
                border-color: rgba(167, 139, 250, 0.4);
            }

            /* ── Content Wrapper ── */
            .content-wrapper {
                display: flex;
                flex: 1;
                overflow: hidden;
            }

            /* ── Sidebar ── */
            .sidebar {
                width: 0;
                background: var(--sidebar-bg);
                border-right: 0px solid transparent;
                transition: width var(--transition), border-color var(--transition);
                overflow: hidden;
                flex-shrink: 0;
                z-index: 50;
            }

            .sidebar.expanded {
                width: var(--sidebar-width-expanded);
                border-right: 1px solid var(--border);
            }

            .sidebar-inner {
                width: var(--sidebar-width-expanded);
                height: 100%;
                display: flex;
                flex-direction: column;
                align-items: center; /* Posisikan semua konten ke tengah */
                padding: 16px 0;
            }

            /* Tombol Tutup Sidebar */
            .sidebar-close-btn {
                align-self: center; /* Pindah ke tengah */
                margin: 0 0 16px 0; /* Ubah jarak margin */
                width: 36px;
                height: 36px;
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid var(--border);
                color: var(--text-muted);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.2s ease;
            }
            .sidebar-close-btn:hover {
                background: rgba(248, 113, 113, 0.15);
                color: #fca5a5;
                border-color: rgba(248, 113, 113, 0.3);
            }

            .nav-group {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 6px;
                flex: 1;
            }

            .nav-item {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center; /* Logo dipindah ke tengah */
                padding: 0; /* Hapus padding samping */
                height: 48px;
                color: var(--text-muted);
                text-decoration: none;
                transition: color 0.2s, background 0.2s;
                position: relative;
            }

            .nav-item svg {
                flex-shrink: 0;
                width: 22px;
                height: 22px;
            }

            .nav-item:hover {
                color: #e2e8f0;
                background: rgba(255,255,255,0.04);
            }

            .nav-item.active {
                color: var(--purple-light);
                background: rgba(124, 58, 237, 0.1);
            }

            .nav-item.active::before {
                content: '';
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                width: 3px;
                height: 60%;
                border-radius: 0 3px 3px 0;
                background: var(--purple);
            }

            /* Teks disembunyikan secara permanen */
            .nav-label {
                display: none;
            }

            .sidebar-footer {
                margin-top: auto;
                width: 100%;
                border-top: 1px solid var(--border);
                padding-top: 12px;
            }

            /* ── Page slot ── */
            .page-slot {
                flex: 1;
                overflow-y: auto;
                background: var(--bg-deep);
            }
            .page-slot::-webkit-scrollbar { width: 4px; }
            .page-slot::-webkit-scrollbar-track { background: transparent; }
            .page-slot::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

            /* ── Floating Open Button (Kiri Bawah) ── */
            .floating-open-btn {
                position: fixed;
                bottom: 32px;
                left: 32px;
                width: 54px;
                height: 54px;
                border-radius: 50%;
                background: linear-gradient(135deg, #7c3aed, #6d28d9);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4), 0 0 0 1px rgba(167, 139, 250, 0.2);
                cursor: pointer;
                border: none;
                z-index: 100;
                transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.2s ease;
            }
            .floating-open-btn:hover {
                transform: scale(1.08) translateY(-4px);
                box-shadow: 0 12px 32px rgba(124, 58, 237, 0.6), 0 0 0 1px rgba(167, 139, 250, 0.4);
            }
            .floating-open-btn:active {
                transform: scale(0.95);
            }
        </style>
    </head>
    <body>
        <div class="app-shell" x-data="{ sidebarOpen: true }">

            {{-- ── Topbar ── --}}
            @include('layouts.top_navigation')

            {{-- ── Wrapper untuk Sidebar & Page Content ── --}}
            <div class="content-wrapper">

                {{-- Sidebar Navigation --}}
                @include('layouts.side_navigation')

                {{-- Page Content --}}
                <main class="page-slot">
                    {{ $slot }}
                </main>

            </div>

            {{-- ── Floating Button Pembuka Sidebar (Pojok Kiri Bawah) ── --}}
            <button x-show="!sidebarOpen"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-8 scale-50"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-8 scale-50"
                    class="floating-open-btn"
                    @click="sidebarOpen = true"
                    title="Buka Menu">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
                </svg>
            </button>

        </div>
    </body>
</html>

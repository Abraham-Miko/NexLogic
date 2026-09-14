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
                --sidebar-width-collapsed: 72px; /* Lebar saat ikon-saja */
                --sidebar-width-expanded: 255px; /* Lebar saat teks muncul */
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

            /* ── Content Wrapper ── */
            .content-wrapper {
                display: flex;
                flex: 1;
                overflow: hidden;
            }

            /* ── Sidebar ── */
            .sidebar {
                width: var(--sidebar-width-collapsed);
                background: var(--sidebar-bg);
                border-right: 1px solid var(--border);
                transition: width var(--transition);
                overflow: hidden;
                flex-shrink: 0;
                z-index: 50;
            }

            .sidebar.expanded {
                width: var(--sidebar-width-expanded);
            }

            .sidebar-inner {
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                padding: 16px 0;
            }

            /* Tombol Toggle Sidebar */
            .sidebar-toggle-wrapper {
                display: flex;
                align-items: center;
                justify-content: flex-start; /* Mematok tombol di sebelah kiri */
                width: 100%;
                margin-bottom: 16px;
                padding: 0 18px; /* 18px kiri + 36px tombol + 18px kanan = tepat di tengah saat ukuran 72px */
            }

            .sidebar-toggle-btn {
                width: 36px;
                height: 36px;
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid var(--border);
                color: var(--text-muted);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.2s ease;
            }
            .sidebar-toggle-btn:hover {
                background: rgba(124, 58, 237, 0.15);
                color: var(--purple-light);
                border-color: rgba(124, 58, 237, 0.3);
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
                justify-content: flex-start;
                padding: 0 25px; /* Menempatkan ikon 22px pas di tengah dari lebar 72px */
                gap: 16px; /* Jarak ikon ke teks */
                height: 48px;
                color: var(--text-muted);
                text-decoration: none;
                transition: color 0.2s, background 0.2s;
                position: relative;
                white-space: nowrap;
            }

            .nav-item svg {
                flex-shrink: 0;
                width: 22px;
                height: 22px;
            }

            .nav-label {
                font-weight: 500;
                font-size: 0.95rem;
                opacity: 0;
                transition: opacity 0.2s ease;
            }

            .sidebar.expanded .nav-label {
                opacity: 1;
                transition: opacity 0.4s ease 0.1s; /* Delay halus agar teks muncul setelah panel terbuka */
            }

            .nav-item:hover {
                color: #e2e8f0;
                background: rgba(255, 255, 255, 0.04);
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
        </style>
    </head>
    <body>
        <div class="app-shell" x-data="{ sidebarOpen: false }">

            {{-- ── Topbar ── --}}
            {{-- @include('layouts.top_navigation') --}}

            {{-- ── Wrapper untuk Sidebar & Page Content ── --}}
            <div class="content-wrapper">

                {{-- Sidebar Navigation --}}
                @include('layouts.side_navigation')

                {{-- Page Content --}}
                <main class="page-slot">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>
</html>


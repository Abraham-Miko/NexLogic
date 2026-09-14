{{-- superadmin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NexLogic | Superadmin</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Orbitron:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root {
                --sidebar-width-collapsed: 72px;
                --sidebar-width-expanded: 255px;
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
                margin: 0; padding: 0;
                background: var(--bg-deep);
                color: #e2e8f0;
                font-family: 'Plus Jakarta Sans', sans-serif;
                height: 100%;
                overflow: hidden;
            }

            /* ── DOT GRID BACKGROUND (dari welcome.blade.php) ── */
            body::before {
                content: '';
                position: fixed;
                inset: 0;
                background-image: radial-gradient(circle, rgba(99, 102, 241, 0.18) 1px, transparent 1px);
                background-size: 28px 28px;
                mask-image: radial-gradient(ellipse 100% 100% at 50% 50%, #000 50%, transparent 100%);
                -webkit-mask-image: radial-gradient(ellipse 100% 100% at 50% 50%, #000 50%, transparent 100%);
                pointer-events: none;
                z-index: 0;
            }

            /* ── Ticker Animation ── */
            @keyframes ticker {
                0%   { transform: translateX(100%); }
                100% { transform: translateX(-100%); }
            }
            .animate-ticker {
                display: inline-flex;
                animation: ticker 25s linear infinite;
            }
            .animate-ticker:hover { animation-play-state: paused; }

            /* ── App Shell ── */
            .app-shell {
                display: flex;
                flex-direction: column;
                height: 100vh;
                overflow: hidden;
                position: relative;
            }

            /* ── Global Ambient Glow ── */
            .app-shell::before {
                content: '';
                position: fixed;
                top: -200px;
                right: -200px;
                width: 600px;
                height: 600px;
                background: radial-gradient(circle, rgba(124,58,237,0.06) 0%, transparent 70%);
                pointer-events: none;
                z-index: 0;
            }
            .app-shell::after {
                content: '';
                position: fixed;
                bottom: -150px;
                left: 50px;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(99,102,241,0.04) 0%, transparent 70%);
                pointer-events: none;
                z-index: 0;
            }

            /* ── Topbar ── */
            .topbar {
                height: 60px;
                background: rgba(10, 16, 32, 0.95);
                border-bottom: 1px solid var(--border);
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 28px;
                flex-shrink: 0;
                z-index: 60;
                backdrop-filter: blur(12px);
                position: relative;
            }

            .topbar-logo {
                display: flex; align-items: center; gap: 10px;
                text-decoration: none; color: #fff;
            }

            .logo-orb {
                width: 32px; height: 32px; border-radius: 50%;
                background: linear-gradient(135deg, #a78bfa, #7c3aed);
                display: flex; align-items: center; justify-content: center;
                font-family: 'Orbitron', sans-serif;
                font-size: 12px; font-weight: 700; color: #fff;
                box-shadow: 0 0 16px var(--purple-glow), 0 0 32px rgba(124,58,237,0.15);
            }

            .logo-name {
                font-family: 'Orbitron', sans-serif;
                font-size: 1rem; font-weight: 700;
                letter-spacing: 0.05em; color: #fff;
            }

            .topbar-actions {
                display: flex; align-items: center; gap: 12px;
            }

            .btn-login {
                padding: 7px 20px;
                border-radius: 8px;
                background: transparent;
                border: 1px solid var(--border);
                color: var(--text-dim);
                font-size: 0.85rem; font-weight: 500;
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
                display: flex; flex: 1; overflow: hidden;
                position: relative; z-index: 1;
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
                position: relative;
            }
            .sidebar::before {
                content: '';
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background: linear-gradient(180deg, rgba(124,58,237,0.03) 0%, transparent 50%);
                pointer-events: none;
            }
            .sidebar.expanded {
                width: var(--sidebar-width-expanded);
            }

            .sidebar-inner {
                width: 100%; height: 100%;
                display: flex; flex-direction: column;
                padding: 16px 0;
            }

            .sidebar-toggle-wrapper {
                display: flex; align-items: center;
                justify-content: flex-start;
                width: 100%; margin-bottom: 16px;
                padding: 0 18px;
            }

            .sidebar-toggle-btn {
                width: 36px; height: 36px;
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid var(--border);
                color: var(--text-muted);
                display: flex; align-items: center; justify-content: center;
                cursor: pointer;
                transition: all 0.2s ease;
            }
            .sidebar-toggle-btn:hover {
                background: rgba(124, 58, 237, 0.15);
                color: var(--purple-light);
                border-color: rgba(124, 58, 237, 0.3);
                box-shadow: 0 0 12px rgba(124,58,237,0.2);
            }

            .nav-group {
                width: 100%; display: flex;
                flex-direction: column; gap: 6px; flex: 1;
            }

            .nav-item {
                width: 100%; display: flex; align-items: center;
                justify-content: flex-start;
                padding: 0 25px; gap: 16px; height: 48px;
                color: var(--text-muted);
                text-decoration: none;
                transition: color 0.2s, background 0.2s;
                position: relative; white-space: nowrap;
            }
            .nav-item svg { flex-shrink: 0; width: 22px; height: 22px; }

            .nav-label {
                font-weight: 500; font-size: 0.95rem;
                opacity: 0; transition: opacity 0.2s ease;
            }
            .sidebar.expanded .nav-label {
                opacity: 1;
                transition: opacity 0.4s ease 0.1s;
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
                position: absolute; left: 0; top: 50%;
                transform: translateY(-50%);
                width: 3px; height: 60%;
                border-radius: 0 3px 3px 0;
                background: var(--purple);
                box-shadow: 0 0 8px var(--purple);
            }

            .sidebar-footer {
                margin-top: auto; width: 100%;
                border-top: 1px solid var(--border);
                padding-top: 12px;
            }

            /* ── Page slot ── */
            .page-slot {
                flex: 1; overflow-y: auto;
                background: var(--bg-deep);
                position: relative; z-index: 1;
            }
            .page-slot::-webkit-scrollbar { width: 4px; }
            .page-slot::-webkit-scrollbar-track { background: transparent; }
            .page-slot::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

            /* ── Fade-in-up animation for modals ── */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px) scale(0.98); }
                to   { opacity: 1; transform: translateY(0) scale(1); }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.25s ease forwards;
            }
        </style>
    </head>
<body class="text-gray-300">
    <div class="min-h-screen flex" style="position: relative; z-index: 1;">

        @include('layouts.sidebar-admin')

        <main class="flex-1 flex flex-col max-h-screen overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

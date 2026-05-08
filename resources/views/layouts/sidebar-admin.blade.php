<!-- ==================== SIDEBAR SUPER ADMIN ==================== -->
<aside class="w-72 flex flex-col justify-between py-6 px-4 shrink-0" style="background: #080e1a; border-right: 1px solid rgba(99,102,241,0.15);">

    <style>
        /* ===================================================
           GAMING SIDEBAR — NEON THEME
           =================================================== */
        .sa-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: #64748b;
            font-weight: 500;
            font-size: 0.9rem;
            border: 1px solid transparent;
            transition: all 0.25s ease-in-out;
            position: relative;
        }
        .sa-nav-item svg {
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }
        .sa-nav-item:hover svg {
            transform: scale(1.15);
        }

        /* ── Glow bar mixin ── */
        .sa-nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 55%;
            border-radius: 0 3px 3px 0;
        }

        /* Dashboard — Neon Purple */
        .sa-nav-dashboard:hover {
            background: rgba(124, 58, 237, 0.08);
            border-color: rgba(124, 58, 237, 0.3);
            color: #a78bfa;
        }
        .sa-nav-dashboard.active {
            background: rgba(124, 58, 237, 0.12);
            border-color: rgba(124, 58, 237, 0.4);
            color: #a78bfa;
            box-shadow: 0 0 18px rgba(124, 58, 237, 0.2), inset 0 0 12px rgba(124, 58, 237, 0.05);
        }
        .sa-nav-dashboard.active::before {
            background: linear-gradient(to bottom, #7c3aed, #a78bfa);
            box-shadow: 0 0 8px rgba(124, 58, 237, 0.6);
        }

        /* Siswa — Cyber Blue */
        .sa-nav-siswa:hover {
            background: rgba(59, 130, 246, 0.08);
            border-color: rgba(59, 130, 246, 0.3);
            color: #60a5fa;
        }
        .sa-nav-siswa.active {
            background: rgba(59, 130, 246, 0.12);
            border-color: rgba(59, 130, 246, 0.4);
            color: #60a5fa;
            box-shadow: 0 0 18px rgba(59, 130, 246, 0.2), inset 0 0 12px rgba(59, 130, 246, 0.05);
        }
        .sa-nav-siswa.active::before {
            background: linear-gradient(to bottom, #2563eb, #60a5fa);
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.6);
        }

        /* Guru — Matrix Green */
        .sa-nav-guru:hover {
            background: rgba(16, 185, 129, 0.08);
            border-color: rgba(16, 185, 129, 0.3);
            color: #34d399;
        }
        .sa-nav-guru.active {
            background: rgba(16, 185, 129, 0.12);
            border-color: rgba(16, 185, 129, 0.4);
            color: #34d399;
            box-shadow: 0 0 18px rgba(16, 185, 129, 0.2), inset 0 0 12px rgba(16, 185, 129, 0.05);
        }
        .sa-nav-guru.active::before {
            background: linear-gradient(to bottom, #059669, #34d399);
            box-shadow: 0 0 8px rgba(16, 185, 129, 0.6);
        }

        /* Wilayah — Lava Orange */
        .sa-nav-wilayah:hover {
            background: rgba(249, 115, 22, 0.08);
            border-color: rgba(249, 115, 22, 0.3);
            color: #fb923c;
        }
        .sa-nav-wilayah.active {
            background: rgba(249, 115, 22, 0.12);
            border-color: rgba(249, 115, 22, 0.4);
            color: #fb923c;
            box-shadow: 0 0 18px rgba(249, 115, 22, 0.2), inset 0 0 12px rgba(249, 115, 22, 0.05);
        }
        .sa-nav-wilayah.active::before {
            background: linear-gradient(to bottom, #ea580c, #fb923c);
            box-shadow: 0 0 8px rgba(249, 115, 22, 0.6);
        }

        /* Dropdown toggle */
        .sa-dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 11px 16px;
            border-radius: 10px;
            color: #64748b;
            font-weight: 500;
            font-size: 0.9rem;
            border: 1px solid transparent;
            background: transparent;
            cursor: pointer;
            transition: all 0.25s ease-in-out;
        }
        .sa-dropdown-toggle:hover {
            background: rgba(255,255,255,0.03);
            border-color: rgba(255,255,255,0.06);
            color: #94a3b8;
        }
        /* When dropdown is open and child is active, highlight the toggle header too */
        .sa-dropdown-active-header {
            color: #94a3b8 !important;
        }

        /* Sub-menu connector line */
        .sa-submenu {
            margin-left: 36px;
            margin-top: 4px;
            padding-left: 16px;
            border-left: 1px solid rgba(99,102,241,0.2);
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* Divider */
        .sa-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(99,102,241,0.2), transparent);
            margin: 6px 4px;
        }

        /* Profile footer button — Cyber Cyan */
        .sa-profile-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 10px;
            color: #64748b;
            font-weight: 500;
            font-size: 0.9rem;
            border: 1px solid transparent;
            transition: all 0.25s ease-in-out;
            text-decoration: none;
            position: relative;
            cursor: pointer;
        }
        .sa-profile-btn:hover {
            background: rgba(6, 182, 212, 0.08);
            border-color: rgba(6, 182, 212, 0.3);
            color: #22d3ee;
            box-shadow: 0 0 14px rgba(6, 182, 212, 0.1);
        }
        .sa-profile-btn:hover svg {
            transform: scale(1.1);
        }
        .sa-profile-btn svg {
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }

        /* Logout — Red Neon */
        .sa-logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 10px;
            color: #64748b;
            font-weight: 500;
            font-size: 0.9rem;
            border: 1px solid transparent;
            background: transparent;
            cursor: pointer;
            transition: all 0.25s ease-in-out;
            width: 100%;
            text-align: left;
        }
        .sa-logout-btn:hover {
            background: rgba(239, 68, 68, 0.08);
            border-color: rgba(239, 68, 68, 0.3);
            color: #f87171;
            box-shadow: 0 0 14px rgba(239, 68, 68, 0.1);
        }
        .sa-logout-btn:hover svg {
            transform: scale(1.1) translateX(2px);
        }
        .sa-logout-btn svg {
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }

        /* Logo orb */
        .sa-logo-orb {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #a78bfa, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', 'JetBrains Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            box-shadow: 0 0 20px rgba(124, 58, 237, 0.5), 0 0 40px rgba(124, 58, 237, 0.15);
            flex-shrink: 0;
            letter-spacing: 0.05em;
        }

        /* Scanline decoration on logo */
        .sa-logo-orb::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 10px;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,0.05) 2px,
                rgba(0,0,0,0.05) 4px
            );
            pointer-events: none;
        }
        .sa-logo-orb { position: relative; }
    </style>

    <div>
        <!-- ── Logo ── -->
        <a href="{{ route('/') }}" class="ml-12 mb-10 block">
            <div class="w-32 h-auto">
                @include('components.application-logo')
            </div>
        </a>

        <!-- ── Navigation ── -->
        <nav class="space-y-1 mt-12">

            <!-- Dashboard -->
            <a href="{{ route('superadmin.dashboard') }}"
               class="sa-nav-item sa-nav-dashboard {{ request()->routeIs('superadmin.dashboard*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-linecap="round" stroke-width="1.8"/>
                    <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-linecap="round" stroke-width="1.8"/>
                    <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-linecap="round" stroke-width="1.8"/>
                    <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-linecap="round" stroke-width="1.8"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <div class="sa-divider"></div>

            <!-- Manajemen Akun Dropdown -->
            <div x-data="{ open: {{ request()->routeIs('superadmin.siswa*') || request()->routeIs('superadmin.guru*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="sa-dropdown-toggle" :class="{ 'sa-dropdown-active-header': open }">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Manajemen Akun</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300 flex-shrink-0"
                         :class="{ 'rotate-180': open }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="sa-submenu">

                    <!-- Siswa — Cyber Blue -->
                    <a href="{{ route('superadmin.siswa') }}"
                       class="sa-nav-item sa-nav-siswa {{ request()->routeIs('superadmin.siswa*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Siswa</span>
                    </a>

                    <!-- Guru — Matrix Green -->
                    <a href="{{ route('superadmin.guru') }}"
                       class="sa-nav-item sa-nav-guru {{ request()->routeIs('superadmin.guru*') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                        <span>Guru</span>
                    </a>
                </div>
            </div>

            <div class="sa-divider"></div>

            <!-- Manajemen Wilayah — Lava Orange -->
            <a href="{{ route('superadmin.wilayah') }}"
                class="sa-nav-item sa-nav-wilayah {{ request()->routeIs('superadmin.wilayah*') || request()->routeIs('superadmin.subwilayah*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                <span>Manajemen Wilayah</span>
            </a>
        </nav>
    </div>

    <!-- ── Footer Profile & Logout ── -->
    <div>
        <div class="sa-divider mb-3"></div>

        <!-- Profile -->
        <a href="#" class="sa-profile-btn">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center flex-shrink-0 text-xs font-bold text-white shadow-lg shadow-violet-500/30">
                SA
            </div>
            <div class="min-w-0">
                <p class="text-[10px] text-slate-500 leading-tight tracking-widest uppercase font-mono">Logged in as</p>
                <p class="text-sm font-semibold text-white truncate">Super Admin</p>
            </div>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-1">
            @csrf
            <button type="submit" class="sa-logout-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>

</aside>

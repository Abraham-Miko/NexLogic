<style>
    .topbar-logo {
        position: absolute;
        top: 2rem;
        left: 1.5rem;
        z-index: 50;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: opacity 0.2s ease;
    }

    .topbar-logo:hover {
        opacity: 0.8;
    }
    
    .btn-login, .btn-register {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.25s ease;
        height: 38px;
        box-sizing: border-box;
    }

    .btn-login {
        background: transparent;
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: #dfd3d3;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        color: #fff;
        border-color: rgba(167, 139, 250, 0.4);
        background: rgba(124, 58, 237, 0.08);
    }

    .btn-register {
        background: linear-gradient(135deg, #553aed, #2834d9);
        color: #fff;
        border: none;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 24px rgba(124, 58, 237, 0.5), 0 6px 16px rgba(0,0,0,0.3) !important;
        color: #fff;
    }

    .btn-register:active {
        transform: translateY(0);
    }

    /* --- TOMBOL DROPDOWN PROFIL --- */
    .user-dropdown-btn {
        display: flex;
        align-items: center;
        gap: 8px; 
        padding: 5px 14px 5px 6px; 
        border-radius: 30px;
        background: rgba(124, 58, 237, 0.08);
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: #94a3b8;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        height: 38px;
    }

    .user-dropdown-btn:hover {
        color: #fff;
        border-color: rgba(167, 139, 250, 0.5);
        background: rgba(124, 58, 237, 0.2);
        box-shadow: 0 0 15px rgba(124, 58, 237, 0.3);
    }

    /* --- GAMING & MODERN DROPDOWN MENU --- */
    .dropdown-menu {
        background: rgba(15, 23, 42, 0.85); /* Agak transparan */
        backdrop-filter: blur(12px); /* Efek kaca */
        border: 1px solid rgba(124, 58, 237, 0.4);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), 0 0 20px rgba(124, 58, 237, 0.2), inset 0 0 10px rgba(124, 58, 237, 0.1);
        border-radius: 12px;
        padding: 8px;
        overflow: hidden;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        color: #94a3b8;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        width: 100%;
        background: transparent;
        border: none;
        text-align: left;
        font-family: inherit;
    }

    .dropdown-item svg {
        width: 18px;
        height: 18px;
        opacity: 0.7;
        transition: all 0.2s;
    }

    /* Efek Hover Khas Gaming (Bergeser + Glow) */
    .dropdown-item-edit-profil:hover {
        color: #fff;
        background: rgba(124, 58, 237, 0.15);
        transform: translateX(4px); /* Bergeser sedikit ke kanan */
        box-shadow: inset 3px 0 0 #a78bfa; /* Garis nyala di sebelah kiri */
    }

    .dropdown-item-dashboard:hover {
        color: #fff;
        background: rgba(88, 237, 58, 0.15);
        transform: translateX(4px); /* Bergeser sedikit ke kanan */
        box-shadow: inset 3px 0 0 #94fa8b; /* Garis nyala di sebelah kiri */
    }
    
    .dropdown-item:hover svg {
        opacity: 1;
        color: #a78bfa;
        transform: scale(1.1);
    }

    /* Khusus Tombol Logout (Warna Merah) */
    .dropdown-item.danger:hover {
        background: rgba(248, 113, 113, 0.12);
        color: #fca5a5;
        box-shadow: inset 3px 0 0 #fca5a5;
    }
    .dropdown-item.danger:hover svg {
        color: #fca5a5;
    }

    /* Garis Pemisah (Gradient Fading) */
    .dropdown-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.4), transparent);
        margin: 6px 0;
        border: none;
    }
</style>

<navbar class="topbar">
    <a href="{{ route('/') }}" class="topbar-logo" style="margin-left: 3em">
        @include('components.application-logo')
    </a>

    <div class="topbar-actions">
        @auth
            <div x-data="{ open: false }" class="relative">
                
                <button @click="open = !open" class="user-dropdown-btn">
                    {{-- Foto Profil (Hanya 1 huruf awal berkat &length=1) --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=7c3aed&color=fff&rounded=true&length=1" 
                         alt="Profil" 
                         style="width: 26px; height: 26px; border-radius: 50%; object-fit: cover; flex-shrink: 0;">
                    
                    <span>Halo, {{ explode(' ', trim(Auth::user()->name))[0] }}</span>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px; flex-shrink: 0;" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                {{-- Menu Dropdown Modern --}}
                <div x-show="open" @click.outside="open = false"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-[-10px] scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-[-10px] scale-95"
                     class="absolute right-0 mt-3 w-56 z-50 dropdown-menu">
                    
                    <a href="{{ route('profile.edit') }}" class="dropdown-item dropdown-item-edit-profil">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Edit Profil
                    </a>

                    <hr class="dropdown-divider">

                    <a href="{{ route('dashboard') }}" class="dropdown-item dropdown-item-dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                            <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                            <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                            <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                        </svg>
                        Dashboard
                    </a>

                    <hr class="dropdown-divider">
                    
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item danger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('login') }}" class="btn-login">Log in</a>
            </div>
        @endauth
    </div>
</navbar>
<style>
    /* ── Penyesuaian Tombol agar Seragam ── */

    /* Standarisasi gaya dasar untuk semua tombol di topbar */
    .btn-login, .btn-register {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 20px; /* Padding yang sama */
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.25s ease;
        height: 38px; /* Tinggi yang sama */
        box-sizing: border-box;
    }

    /* Gaya khusus Log In (Secondary/Outline) */
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

    /* Gaya khusus Sign Up (Primary/Solid) */
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
</style>

<navbar class="topbar">
    <a href="{{ route('/') }}" class="topbar-logo" style="margin-left: 3em">
        <text class="logo-name"><span style="color: #01f5fd">Nex</span><span style="color: #fc4949">Logic</span></text>
    </a>

    <div class="topbar-actions">
        @auth
            {{-- Bagian Dropdown User tetap sama --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="user-dropdown-btn">
                    <span>{{ Auth::user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" @click.outside="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 rounded-xl shadow-2xl py-1 z-50"
                     style="background:#0f172a; border:1px solid rgba(99,102,241,0.2); top: 100%;">
                    <a href="{{ route('profile.edit') }}"
                       style="display:block; padding:10px 16px; font-size:0.85rem; color:#94a3b8; text-decoration:none; transition:color 0.15s;"
                       onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                style="width:100%; text-align:left; padding:10px 16px; font-size:0.85rem; color:#f87171; background:none; border:none; cursor:pointer; font-family:inherit; transition:color 0.15s;"
                                onmouseover="this.style.color='#fca5a5'" onmouseout="this.style.color='#f87171'">
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

<x-guest-layout>

    <style>
        /* ===== LAYOUT WRAPPER ===== */
        *, *::before, *::after { box-sizing: border-box; }

        .profile-page {
            margin: 0;
            font-family: 'Orbitron', sans-serif;
            color: #e2e8f0;
            overflow-x: hidden;
            margin-left: 4rem;
            min-height: 100vh;
            position: relative;
            background: #060c18;
        }

        /* ===== ANIMATED BACKGROUND ===== */
        .bg-layer {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }

        .bg-dots {
            background-image: radial-gradient(circle, rgba(99, 102, 241, 0.18) 1px, transparent 1px);
            background-size: 28px 28px;
            width: 100%;
            height: 100%;
            position: absolute;
            inset: 0;
        }

        .bg-aurora {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .aurora-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            animation: float 12s ease-in-out infinite;
            opacity: 0.12;
        }

        .aurora-blob:nth-child(1) {
            width: 700px; height: 700px;
            background: radial-gradient(circle, #6366f1, transparent 70%);
            top: -200px; left: -200px;
            animation-delay: 0s;
        }

        .aurora-blob:nth-child(2) {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #22d3ee, transparent 70%);
            top: 40%; right: -150px;
            animation-delay: -4s;
        }

        .aurora-blob:nth-child(3) {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #a78bfa, transparent 70%);
            bottom: -100px; left: 30%;
            animation-delay: -8s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(40px, -40px) scale(1.05); }
            66%       { transform: translate(-30px, 30px) scale(0.97); }
        }

        .page-content {
            position: relative;
            z-index: 1;
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 32px 80px;
        }

        /* ===== PAGE HEADER ===== */
        .page-heading {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 0.35em;
            color: #ffffff;
            text-transform: uppercase;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ===== HERO CARD ===== */
        .hero-card {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(10, 16, 30, 0.95) 100%);
            border: 1px solid rgba(99, 102, 241, 0.25);
            border-radius: 28px;
            padding: 48px 52px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 48px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(16px);
            box-shadow: 0 0 0 1px rgba(255,255,255,0.04) inset, 0 32px 64px rgba(0,0,0,0.5);
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99,102,241,0.6), rgba(34,211,238,0.4), transparent);
        }

        .hero-card-shine {
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(99,102,241,0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ===== AVATAR ===== */
        .avatar-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .avatar-rings {
            position: absolute;
            inset: -14px;
            border-radius: 50%;
        }

        .avatar-rings::before,
        .avatar-rings::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            animation: spin 8s linear infinite;
        }

        .avatar-rings::before {
            inset: 0;
            border: 1.5px solid transparent;
            border-top-color: #6366f1;
            border-right-color: #6366f1;
        }

        .avatar-rings::after {
            inset: 6px;
            border: 1px solid transparent;
            border-bottom-color: #22d3ee;
            border-left-color: #22d3ee;
            animation-direction: reverse;
            animation-duration: 6s;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .avatar-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1e1b4b, #0f172a);
            border: 2px solid rgba(99,102,241,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .avatar-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-dot {
            position: absolute;
            bottom: 4px; right: 4px;
            width: 20px; height: 20px;
            border-radius: 50%;
            border: 3px solid #060c18;
            z-index: 2;
        }

        .status-dot.active {
            background: #22c55e;
            box-shadow: 0 0 10px #22c55e, 0 0 20px rgba(34,197,94,0.4);
            animation: pulse-green 2s ease-in-out infinite;
        }

        @keyframes pulse-green {
            0%, 100% { box-shadow: 0 0 10px #22c55e, 0 0 20px rgba(34,197,94,0.4); }
            50%       { box-shadow: 0 0 16px #22c55e, 0 0 32px rgba(34,197,94,0.6); }
        }

        /* ===== HERO INFO ===== */
        .hero-info {
            flex: 1;
        }

        .hero-meta {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .hero-name {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #f8fafc;
            letter-spacing: 0.02em;
            line-height: 1.1;
            text-shadow: 0 0 30px rgba(99,102,241,0.4);
        }

        /* MASIH REVISI */
        .role-pill {
            padding: 5px 18px;
            border-radius: 100px;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-left: 2rem;
        }

        .role-siswa     { background: rgba(34,211,238,0.08);  color: #34BBF5; border: 1px solid rgba(34,211,238,0.3); }
        .role-guru      { background: rgba(167,139,250,0.08); color: #8B5CF6; border: 1px solid rgba(153, 122, 248, 0.3); }
        .role-super_admin,
        .role-admin     { background: rgba(248,113,113,0.08); color: #F65C5C; border: 1px solid rgba(253, 78, 78, 0.3);
                          box-shadow: 0 0 12px rgba(248,113,113,0.15); }

        .hero-sub {
            font-size: 1rem;
            color: #888; /* Warna teks agak redup agar ID menonjol */
            margin: 20px 0;
            letter-spacing: 0.05em;
        }

        .hero-sub span {
            color: #fff;
            font-weight: 600;
            padding: 2px 8px;
            position: relative;
            z-index: 1;
        }

        .hero-sub span::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #fd5151;
            box-shadow: 0 0 12px #fd5151;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-primary {
            padding: 10px 28px;
            background: linear-gradient(135deg, #553aed, #2834d9);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 8px 24px rgba(79,70,229,0.35);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(79,70,229,0.5);
        }

        .btn-primary:hover::before { opacity: 1; }

        .btn-secondary {
            padding: 10px 28px;
            background: transparent;
            color: #94a3b8;
            border: 1px solid rgba(148,163,184,0.2);
            border-radius: 14px;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .btn-secondary:hover {
            border-color: rgba(148,163,184,0.4);
            color: #e2e8f0;
            background: rgba(148,163,184,0.05);
        }

        /* ===== SECTION TITLE ===== */
        .section-label {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 0.3em;
            color: #ffffff;
            text-transform: uppercase;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ===== INFO GRID ===== */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .info-card {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 18px;
            padding: 24px 28px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: default;
        }

        .info-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99,102,241,0.04), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .info-card:hover {
            border-color: rgba(99,102,241,0.35);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(99,102,241,0.15);
        }

        .info-card:hover::after { opacity: 1; }

        .info-card-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 1.1rem;
        }

        .ic-blue   { background: rgba(99,102,241,0.12);  }
        .ic-cyan   { background: rgba(34,211,238,0.1);   }
        .ic-green  { background: rgba(34,197,94,0.1);    }

        .info-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #475569;
            margin-bottom: 8px;
        }

        .info-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #e2e8f0;
        }

        .info-value.status-active { color: #4ade80; }
        .info-value.status-inactive { color: #fbbf24; }

        /* ===== EDIT FORM PANEL ===== */
        .edit-panel {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(99,102,241,0.2);
            border-radius: 24px;
            padding: 36px 40px;
            margin-bottom: 28px;
            backdrop-filter: blur(12px);
            display: none;
            position: relative;
        }

        .edit-panel.open {
            display: block;
            animation: slideDown 0.35s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            margin-bottom: -2rem;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .edit-panel-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            color: #e2e8f0;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .edit-panel-title span.dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #F65C5C;
            box-shadow: 0 0 10px #F65C5C;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-group.full { grid-column: 1 / -1; }

        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #64748b;
        }

        .form-input {
            background: rgba(8,14,26,0.8);
            border: 1px solid rgba(99,102,241,0.2);
            border-radius: 12px;
            padding: 12px 16px;
            color: #e2e8f0;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            outline: none;
            transition: all 0.2s ease;
            width: 100%;
        }

        .form-input:focus {
            border-color: rgba(99,102,241,0.6);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }

        .form-input::placeholder { color: #334155; }

        select.form-input option { background: #0f172a; }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        /* ===== PASSWORD PANEL ===== */
        .password-panel {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(99,102,241,0.2);
            border-radius: 24px;
            padding: 36px 40px;
            margin-bottom: 28px;
            backdrop-filter: blur(12px);
            display: none;
        }

        .password-panel.open {
            display: block;
            animation: slideDown 0.35s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            margin-bottom: -2rem;
        }

        .form-input-icon {
            position: relative;
        }

        .form-input-icon .form-input { padding-right: 44px; }

        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #475569;
            cursor: pointer;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-pw:hover { color: #94a3b8; }

        /* ===== ACTIVITY GRID ===== */
        .activity-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .activity-card {
            background: rgba(15, 23, 42, 0.5);
            border: 1px dashed rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 28px;
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            border-color: rgba(99,102,241,0.2);
            background: rgba(15,23,42,0.7);
        }

        .activity-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .activity-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .ai-purple { background: rgba(167,139,250,0.1); }
        .ai-amber  { background: rgba(251,191,36,0.08); }

        .activity-card-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: #cbd5e1;
            letter-spacing: 0.03em;
        }

        .activity-empty {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #334155;
            font-size: 0.85rem;
            font-style: italic;
            letter-spacing: 0.02em;
        }

        /* ===== XP BAR ===== */
        .xp-bar-track {
            height: 6px;
            background: rgba(255,255,255,0.05);
            border-radius: 100px;
            overflow: hidden;
            margin-top: 8px;
        }

        .xp-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #6366f1, #22d3ee);
            border-radius: 100px;
            width: 0%;
            animation: xpGrow 1.5s ease forwards 0.5s;
        }

        @keyframes xpGrow { to { width: 35%; } }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .profile-page { margin-left: 3.5rem; }
            .page-content { padding: 28px 16px 60px; }
            .hero-card { flex-direction: column; text-align: center; padding: 32px 24px; gap: 24px; }
            .hero-actions { justify-content: center; }
            .info-grid { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .activity-grid { grid-template-columns: 1fr; }
            .hero-meta { justify-content: center; }
        }

        /* ===== FLASH MESSAGE ===== */
        .flash-msg {
            padding: 14px 20px;
            border-radius: 14px;
            margin-bottom: 24px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .flash-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25); color: #4ade80; }
        .flash-error   { background: rgba(239,68,68,0.1);  border: 1px solid rgba(239,68,68,0.25);  color: #f87171; }

        /* ===== DIVIDER ===== */
        .glowing-hr {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(99,102,241,0.3), transparent);
            margin: 0 0 28px;
        }
    </style>

    <div class="profile-page">

        {{-- Background Effects --}}
        <div class="bg-layer">
            <div class="bg-dots"></div>
            <div class="bg-aurora">
                <div class="aurora-blob"></div>
                <div class="aurora-blob"></div>
                <div class="aurora-blob"></div>
            </div>
        </div>

        <div class="page-content">

            {{-- Page Heading --}}
            <p class="page-heading">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <circle cx="6" cy="6" r="5" stroke="#ffffff" stroke-width="1.5"/>
                    <circle cx="6" cy="6" r="2" fill="#ffffff"/>
                </svg>
                User Profile
            </p>

            {{-- Flash Messages --}}
            @if (session('status') === 'profile-updated')
                <div class="flash-msg flash-success">
                    <span>✓</span> Profil berhasil diperbarui.
                </div>
            @endif
            @if (session('status') === 'password-updated')
                <div class="flash-msg flash-success">
                    <span>✓</span> Password berhasil diubah.
                </div>
            @endif
            @if ($errors->any())
                <div class="flash-msg flash-error">
                    <span>⚠</span> {{ $errors->first() }}
                </div>
            @endif

            {{-- ====== HERO CARD ====== --}}
            <div class="hero-card">
                <div class="hero-card-shine"></div>

                {{-- Avatar --}}
                <div class="avatar-wrapper">
                    <div class="avatar-rings"></div>
                    <div class="avatar-img">
                        @if(Auth::user()->avatar ?? false)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
                        @else
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="18" r="10" fill="#6366f1" opacity="0.7"/>
                                <ellipse cx="24" cy="38" rx="16" ry="10" fill="#6366f1" opacity="0.5"/>
                            </svg>
                        @endif
                    </div>
                    <div class="status-dot {{ Auth::user()->status === 'aktif' ? 'active' : '' }}"></div>
                </div>

                {{-- Info --}}
                <div class="hero-info">
                    <div class="hero-meta">
                        <h1 class="hero-name">{{ Auth::user()->nama }}</h1>
                        <span class="role-pill role-{{ Auth::user()->role }}">
                            {{ strtoupper(str_replace('_', ' ', Auth::user()->role)) }}
                        </span>
                    </div>
                    <p class="hero-sub">Nomor Induk : <span>{{ Auth::user()->nomor_induk }}</span></p>

                    <div class="hero-actions">
                        <button class="btn-primary" onclick="togglePanel('editPanel', 'pwPanel')">
                            <div class="flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                Edit Profile
                            </div>
                        </button>
                        <button class="btn-secondary" onclick="togglePanel('pwPanel', 'editPanel')" style="color: #F65C5C; border-color: rgba(246,92,92,0.3); box-shadow: 0 0 12px rgba(246,92,92,0.15);">
                            <div class="flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2zm10-10V7a4 4 0 0 0-8 0v4h8z" />
                                </svg>
                                Ganti Password
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ====== EDIT PROFILE PANEL ====== --}}
            <div class="edit-panel" id="editPanel">
                <div class="edit-panel-title">
                    <span class="dot"></span>
                    Edit Informasi Profil
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-grid">
                        <div class="form-group full">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-input"
                                   value="{{ old('nama', Auth::user()->nama) }}"
                                   placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-input">
                                <option value="" {{ is_null(Auth::user()->jenis_kelamin) ? 'selected' : '' }}>Pilih...</option>
                                <option value="L" {{ Auth::user()->jenis_kelamin === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ Auth::user()->jenis_kelamin === 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor Induk</label>
                            <input type="text" class="form-input"
                                   value="{{ Auth::user()->nomor_induk }}"
                                   disabled style="opacity:0.45; cursor:not-allowed;">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary" onclick="closeAll()">Batal</button>
                        <button type="submit" class="btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            {{-- ====== CHANGE PASSWORD PANEL ====== --}}
            <div class="password-panel" id="pwPanel">
                <div class="edit-panel-title">
                    <span class="dot"></span>
                    Ganti Password
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group full">
                            <label class="form-label">Password Saat Ini</label>
                            <div class="form-input-icon">
                                <input type="password" id="cur_pw" name="current_password" class="form-input"
                                       placeholder="Masukkan password lama" required>
                                <button type="button" class="toggle-pw" onclick="togglePw('cur_pw')">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <div class="form-input-icon">
                                <input type="password" id="new_pw" name="password" class="form-input"
                                       placeholder="Min. 8 karakter" required>
                                <button type="button" class="toggle-pw" onclick="togglePw('new_pw')">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <div class="form-input-icon">
                                <input type="password" id="conf_pw" name="password_confirmation" class="form-input"
                                       placeholder="Ulangi password baru" required>
                                <button type="button" class="toggle-pw" onclick="togglePw('conf_pw')">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary" onclick="closeAll()">Batal</button>
                        <button type="submit" class="btn-primary">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

            {{-- ====== DETAIL INFO ====== --}}
            <p class="section-label" style="margin-top: 4rem">Detail Informasi</p>

            <div class="info-grid">

                <div class="info-card">
                    <div class="info-card-icon ic-blue">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="2">
                            <path stroke-linecap="round" d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM6 21v-1a6 6 0 0112 0v1"/>
                        </svg>
                    </div>
                    <p class="info-label">Jenis Kelamin</p>
                    <p class="info-value">
                        {{ Auth::user()->jenis_kelamin == 'L' ? '♂ Laki-laki' : (Auth::user()->jenis_kelamin == 'P' ? '♀ Perempuan' : 'Tidak Diatur') }}
                    </p>
                </div>

                <div class="info-card">
                    <div class="info-card-icon ic-green">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2">
                            <path stroke-linecap="round" d="M9 12l2 2 4-4M22 12a10 10 0 11-20 0 10 10 0 0120 0z"/>
                        </svg>
                    </div>
                    <p class="info-label">Status Akun</p>
                    <p class="info-value {{ Auth::user()->status == 'aktif' ? 'status-active' : 'status-inactive' }}">
                        {{ Auth::user()->status == 'aktif' ? '● Aktif' : '○ Tidak Aktif' }}
                    </p>
                </div>

                <div class="info-card">
                    <div class="info-card-icon ic-cyan">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22d3ee" stroke-width="2">
                            <path stroke-linecap="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="info-label">Sub Kode Wilayah</p>
                    <p class="info-value">{{ Auth::user()->sub_kode_wilayah ?? Auth::user()->sub_wilayah_id ?? 'Tidak Diatur' }}</p>
                </div>

            </div>

            {{-- ====== ACTIVITY SECTION ====== --}}
            <p class="section-label">Aktivitas & Pencapaian</p>

            <div class="activity-grid">

                <div class="activity-card">
                    <div class="activity-card-header">
                        <div class="activity-icon ai-purple">🎮</div>
                        <span class="activity-card-title">Progress Belajar</span>
                    </div>
                    {{-- Placeholder: Ganti dengan data asli dari DB --}}
                    <div class="activity-empty">Belum ada aktivitas belajar terbaru.</div>
                    <div class="xp-bar-track">
                        <div class="xp-bar-fill"></div>
                    </div>
                    <p style="font-size:0.7rem; color:#334155; margin-top:6px; text-align:right;">0 / 100 XP</p>
                </div>

                <div class="activity-card">
                    <div class="activity-card-header">
                        <div class="activity-icon ai-amber">🏆</div>
                        <span class="activity-card-title">Pencapaian Terbaru</span>
                    </div>
                    <div class="activity-empty">Selesaikan modul untuk mendapatkan lencana!</div>
                </div>

            </div>

        </div>{{-- end .page-content --}}
    </div>{{-- end .profile-page --}}

    <script>
        function togglePanel(show, hide) {
            const showEl = document.getElementById(show);
            const hideEl = document.getElementById(hide);

            const isOpen = showEl.classList.contains('open');
            hideEl.classList.remove('open');

            if (isOpen) {
                showEl.classList.remove('open');
            } else {
                showEl.classList.add('open');
                setTimeout(() => showEl.scrollIntoView({ behavior: 'smooth', block: 'start' }), 80);
            }
        }

        function closeAll() {
            document.getElementById('editPanel').classList.remove('open');
            document.getElementById('pwPanel').classList.remove('open');
        }

        function togglePw(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        // Auto-open error panels
        @if($errors->updatePassword->any())
            document.getElementById('pwPanel').classList.add('open');
        @elseif($errors->any())
            document.getElementById('editPanel').classList.add('open');
        @endif
    </script>
</x-guest-layout>

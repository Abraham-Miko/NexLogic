<x-guest-layout>
    <style>
        /* ── Background & Layout ── */
        .login-wrapper {
            position: relative;
            min-height: 100vh;
            background-color: #080e1a;
            display: flex;
            flex-direction: column; /* Menumpuk elemen secara vertikal */
            align-items: center;    /* Menengahkah secara horizontal */
            justify-content: center; /* Menengahkah secara vertikal */
            padding: 24px;
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Dot grid background */
        .login-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(99, 102, 241, 0.28) 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, #000 40%, transparent 100%);
            -webkit-mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, #000 40%, transparent 100%);
            pointer-events: none;
            z-index: 0;
        }

        /* Ambient Glows */
        .glow-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.15) 0%, transparent 70%);
            top: -100px;
            left: -100px;
            pointer-events: none;
            z-index: 0;
        }
        .glow-2 {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(34, 211, 238, 0.1) 0%, transparent 70%);
            bottom: -50px;
            right: -50px;
            pointer-events: none;
            z-index: 0;
        }

        /* ── Login Card ── */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 20px;
            padding: 40px 32px;
            backdrop-filter: blur(16px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(99,102,241,0.1);
            animation: fadeSlideUp 0.6s ease both;
        }

        /* Typography */
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
        }
        .login-subtitle {
            color: #94a3b8;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* ── Form Elements ── */
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            color: #cbd5e1;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-input {
            width: 100%;
            background: rgba(8, 14, 26, 0.6);
            border: 1px solid rgba(99, 102, 241, 0.25);
            color: #fff;
            padding: 12px 16px;
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .form-input:focus {
            outline: none;
            border-color: #a78bfa;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
        }
        .form-input::placeholder {
            color: #475569;
        }

        /* Options row (Remember me & Forgot Password) */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #94a3b8;
            font-size: 0.85rem;
            cursor: pointer;
        }
        .remember-me input[type="checkbox"] {
            accent-color: #7c3aed;
            width: 16px;
            height: 16px;
            border-radius: 4px;
            background: rgba(8, 14, 26, 0.6);
            border: 1px solid rgba(99, 102, 241, 0.3);
            cursor: pointer;
        }
        .forgot-link {
            color: #a78bfa;
            font-size: 0.85rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .forgot-link:hover {
            color: #fff;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px;
            border-radius: 12px;
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
            transition: all 0.25s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.5);
        }
        .btn-submit:active {
            transform: translateY(0);
        }

        /* Footer Link */
        .login-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 0.85rem;
            color: #94a3b8;
        }
        .login-footer a {
            color: #22d3ee;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        .login-footer a:hover {
            color: #fff;
            text-shadow: 0 0 8px rgba(34, 211, 238, 0.5);
        }

        .form-input.is-invalid {
            border-color: rgba(248, 113, 113, 0.5) !important;
            background: rgba(248, 113, 113, 0.05) !important;
        }

        .form-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.15) !important;
        }

        .form-options {
            display: flex;
            align-items: center;
            /* Ubah dari space-between menjadi flex-end */
            justify-content: flex-end;
            margin-bottom: 24px;
            position: relative;
            z-index: 20;
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

<body>
    <div class="login-wrapper">
        <div class="glow-1"></div>
        <div class="glow-2"></div>

        {{-- Tombol Kembali (Tepat di atas kotak) --}}
        <div style="margin-bottom: 20px; z-index: 30; animation: fadeSlideUp 0.6s ease both;">
            <a href="{{ url()->previous() }}"
            style="display: inline-flex; align-items: center; gap: 8px; padding: 7px 18px; border-radius: 100px; background: rgba(70, 58, 237, 0.12); border: 1px solid rgba(58, 70, 237, 0.35); color: #8b9cfa; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; text-decoration: none; font-family: 'JetBrains Mono', monospace; transition: all 0.3s ease;"
            onmouseover="this.style.background='rgba(70, 58, 237, 0.25)'; this.style.color='#fff';"
            onmouseout="this.style.background='rgba(70, 58, 237, 0.12)'; this.style.color='#8b9cfa';">
                <text>Kembali</text>
            </a>
        </div>

        {{-- Kotak Login --}}
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Lanjutkan petualangan coding-mu hari ini.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- nomor_induk --}}
                <div class="form-group">
                    <label for="nomor_induk" class="form-label">Nomor Induk</label>
                    <input id="nomor_induk" type="string" name="nomor_induk"
                        class="form-input @error('nomor_induk') is-invalid @enderror"
                        placeholder="22000000" required autofocus autocomplete="username">

                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password"
                        class="form-input @error('password') is-invalid @enderror"
                        placeholder="••••••••" required autocomplete="current-password">

                </div>

                {{-- Peringatan Error (Tampil di atas tombol login) --}}
                @if ($errors->any())
                    <div style="background-color: #fef2f2; border: 1px solid #fca5a5; border-radius: 6px; padding: 12px; margin-bottom: 24px;">
                        <div style="color: #ef4444; font-size: 0.875rem; font-weight: 600; display: flex; align-items: center; margin-bottom: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px; margin-right: 6px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Error:
                        </div>
                        <ul style="color: #b91c1c; font-size: 0.75rem; margin: 0; padding-left: 26px; list-style-type: disc;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="btn-submit" style="margin-top: 24px">
                    Log In
                </button>
            </form>
        </div>
    </div>
</body>

</x-guest-layout>

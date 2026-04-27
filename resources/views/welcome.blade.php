<x-app-layout>
    <style>
        /* Hanya berisi CSS yang tidak bisa di-inline */

        /* 1. Pseudo-element untuk background dot-grid */
        .hero-section::before {
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

        /* 2. Pseudo-classes (Hover & Active) untuk tombol */
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 36px rgba(124, 58, 237, 0.6), 0 8px 24px rgba(0,0,0,0.35) !important;
        }
        .btn-primary:active { transform: translateY(0); }

        .btn-secondary:hover {
            color: #fff !important;
            border-color: rgba(167, 139, 250, 0.55) !important;
            background: rgba(124, 58, 237, 0.08) !important;
        }

        /* 3. Animasi (Keyframes) */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(-50%) translateY(0); }
            50% { transform: translateY(-50%) translateY(-12px); }
        }

        /* Class bantuan untuk memanggil animasi */
        .anim-fade-1 { animation: fadeSlideUp 0.6s ease both; }
        .anim-fade-2 { animation: fadeSlideUp 0.6s 0.1s ease both; }
        .anim-fade-3 { animation: fadeSlideUp 0.6s 0.2s ease both; }
        .anim-fade-4 { animation: fadeSlideUp 0.6s 0.3s ease both; }
        .anim-fade-5 { animation: fadeSlideUp 0.6s 0.45s ease both; }
        .anim-float { animation: float 4s ease-in-out infinite; }

        /* 4. Media Query untuk Responsivitas Layar HP */
        @media (max-width: 900px) {
            .hero-decoration { display: none !important; }
            .hero-content { padding: 40px 24px !important; }
        }

        /* Section Container */
        .features-section {
            padding: 80px 5%;
            max-width: 1400px;
            margin: 0    auto;
            position: relative;
            z-index: 10;
        }

        /* Header Section */
        .section-label {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #22d3ee; /* Warna Cyan */
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 12px;
            font-family: 'JetBrains Mono';
        }

        .section-label::before {
            content: '';
            display: block;
            width: 24px;
            height: 2px;
            background-color: #22d3ee;
        }

        .section-title {
            font-family: 'Orbitron';
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 48px;
            line-height: 1.2;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feature-card {
            background: #0f172a;
            border: 1px solid rgba(99, 102, 241, 0.15);
            border-radius: 16px;
            padding: 28px 24px;
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: rgba(34, 211, 238, 0.4);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(34, 211, 238, 0.1);
        }

        .feature-icon {
            font-size: 1.8rem;
            margin-bottom: 16px;
            display: inline-block;
        }

        .feature-heading {
            color: #22d3ee;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .feature-desc {
            color: #94a3b8;
            font-size: 0.85rem;
            line-height: 1.6;
            font-weight: 400;
        }

        .promotion-text {
            font-size: 1rem;
            color: #64748b;
            line-height: 1.7;
            max-width: 100%;
            margin: 0 auto 40px;
        }

        /* Responsivitas untuk layar HP & Tablet */
        @media (max-width: 900px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
            .features-section {
                padding: 60px 24px;
            }
        }
    </style>

    <first-section class="hero-section" style="position: relative; min-height: calc(100vh - 60px); background-color: #080e1a; overflow: hidden; display: flex; align-items: center;">

        {{-- Ambient glow blobs --}}
        <div style="position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(70, 58, 237, 0.18) 0%, transparent 70%); top: -100px; left: 50px; pointer-events: none; z-index: 0;"></div>
        <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(99, 109, 241, 0.12) 0%, transparent 70%); bottom: -20px; right: 100px; pointer-events: none; z-index: 0;"></div>

        <div class="hero-content" style="position: relative; z-index: 1; padding: 60px 60px 60px 72px; max-width: 760px;">

            {{-- Badge --}}
            <div class="anim-fade-1" style="display: inline-flex; align-items: center; gap: 8px; padding: 7px 18px; border-radius: 100px; background: rgba(70, 58, 237, 0.12); border: 1px solid rgba(58, 70, 237, 0.35); color: #8b9cfa; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 28px; font-family: 'JetBrains Mono', monospace;">
                🚀&nbsp; Platform Belajar Coding #1 untuk SMA/K
            </div>

            {{-- Heading --}}
            <h1 class="anim-fade-2" style="font-family: 'Orbitron', sans-serif; font-size: clamp(2.6rem, 5.5vw, 4rem); font-weight: 900; line-height: 1.1; color: #fff; margin: 0 0 20px; letter-spacing: -0.01em;">
                Belajar <span style="background: linear-gradient(135deg, #a09eec 0%, #5867ee 50%, #3d14f0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Coding,</span><br>
                Naik Level!
            </h1>

            {{-- Subtext --}}
            <p class="anim-fade-3" style="font-size: 1rem; color: #64748b; line-height: 1.7; max-width: 480px; margin-bottom: 40px;">
                Kuasai dasar pemrograman dengan cara yang seru dan interaktif.
                Kerjakan tantangan, kumpulkan XP, dan jadilah programmer handal!
            </p>

            {{-- CTAs --}}
            <div class="anim-fade-4" style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                        🎮 &nbsp;Lanjut Belajar
                    </a>
                    <a href="#materi" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: transparent; color: #cbd5e1; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: 1.5px solid rgba(99, 102, 241, 0.3); cursor: pointer; transition: color 0.2s, border-color 0.2s, background 0.2s; font-family: 'Plus Jakarta Sans', sans-serif;">
                        📚 &nbsp;Lihat Materi
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary" style="margin-left: 7em; display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                        🎮 &nbsp;Mulai Belajar
                    </a>
                @endauth
            </div>

            {{-- Stats --}}
            <div class="anim-fade-5" style="display: flex; gap: 36px; margin-top: 52px; padding-top: 28px; border-top: 1px solid rgba(99, 102, 241, 0.12);">
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <span style="font-family: 'Orbitron', sans-serif; font-size: 1.5rem; font-weight: 700; color: #6770f3; letter-spacing: -0.02em;">2.4K+</span>
                    <span style="font-size: 0.78rem; color: #475569; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em;">Siswa Aktif</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <span style="font-family: 'Orbitron', sans-serif; font-size: 1.5rem; font-weight: 700; color: #6770f3; letter-spacing: -0.02em;">48</span>
                    <span style="font-size: 0.78rem; color: #475569; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em;">Modul Materi</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <span style="font-family: 'Orbitron', sans-serif; font-size: 1.5rem; font-weight: 700; color: #6770f3; letter-spacing: -0.02em;">320+</span>
                    <span style="font-size: 0.78rem; color: #475569; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em;">Tantangan</span>
                </div>
            </div>

        </div>

        {{-- Floating decoration (right side) --}}
        <div class="hero-decoration anim-float" style="position: absolute; right: 8%; top: 50%; transform: translateY(-50%); z-index: 1; display: flex; flex-direction: column; gap: 14px; opacity: 0.9;">

            {{-- Code snippet card --}}
            <div style="background: rgba(15, 23, 42, 0.85); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 14px; padding: 18px 22px; backdrop-filter: blur(12px); min-width: 240px; font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; line-height: 1.7; box-shadow: 0 8px 32px rgba(0,0,0,0.4), 0 0 0 1px rgba(99,102,241,0.08);">
                <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 12px;">
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #f87171;"></div>
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #fbbf24;"></div>
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #34d399;"></div>
                </div>
                <div>
                    <span style="color: #a78bfa;">def</span>
                    <span style="color: #60a5fa;"> solve</span><span style="color: #64748b;">(n):</span>
                </div>
                <div><span style="color: #64748b;">&nbsp;&nbsp;result = </span><span style="color: #fb923c;">[]</span></div>
                <div><span style="color: #64748b;">&nbsp;&nbsp;</span><span style="color: #a78bfa;">for</span><span style="color: #64748b;"> i </span><span style="color: #a78bfa;">in</span><span style="color: #60a5fa;"> range</span><span style="color: #64748b;">(n):</span></div>
                <div><span style="color: #64748b;">&nbsp;&nbsp;&nbsp;&nbsp;result.</span><span style="color: #60a5fa;">append</span><span style="color: #64748b;">(i * </span><span style="color: #fb923c;">2</span><span style="color: #64748b;">)</span></div>
                <div><span style="color: #64748b;">&nbsp;&nbsp;</span><span style="color: #a78bfa;">return</span><span style="color: #64748b;"> result</span></div>
                <br>
                <div><span style="color: #64748b;"># Output: </span><span style="color: #34d399;">[0, 2, 4, 6, 8]</span></div>
            </div>

        </div>

    </first-section>

    <section class="features-section" id="fitur">

        <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(70, 58, 237, 0.18) 0%, transparent 70%); top: -100px; left: 50px; pointer-events: none; z-index: 0;"></div>

        <div class="section-label">Kenapa Nexlogic?</div>
        <h2 class="section-title">Belajar Yang Tidak<br>Membosankan</h2>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3 class="feature-heading">Belajar Berbasis Level</h3>
                <p class="feature-desc">Mulai dari dasar, perlahan tingkatkan skill-mu dengan sistem level yang terstruktur dan mudah dipahami.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3 class="feature-heading">Tantangan Real-time</h3>
                <p class="feature-desc">Kerjakan soal coding interaktif langsung di browser. Isi kode, pilih jawaban, dan lihat hasilnya seketika!</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🏆</div>
                <h3 class="feature-heading">Papan Skor & Kompetisi</h3>
                <p class="feature-desc">Bersaing dengan teman sekelas secara sehat. Kumpulkan XP dan panjat papan leaderboard!</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🎖️</div>
                <h3 class="feature-heading">Lencana & Pencapaian</h3>
                <p class="feature-desc">Dapatkan lencana unik di setiap pencapaian. Tampilkan koleksimu dan buktikan keahlianmu!</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3 class="feature-heading">Lacak Progres Belajar</h3>
                <p class="feature-desc">Dashboard lengkap membantu kamu dan gurumu memantau perkembangan belajar setiap hari.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💡</div>
                <h3 class="feature-heading">Hint & Penjelasan</h3>
                <p class="feature-desc">Terjebak di soal? Gunakan fitur hint untuk mendapat petunjuk tanpa langsung melihat jawaban.</p>
            </div>
        </div>
    </section>

    <section class="features-section" id="Promotion" style="text-align: center; margin-top: 4em">
        <h2 class="section-title">Siap Jadi Programmer?</h2>
        <p class="promotion-text">
            Bergabung dengan ribuan siswa SMA yang sudah memulai perjalanan coding mereka.</p>

        @auth
            <a href="{{ route('dashboard') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                🚀 &nbsp;Mulai Gratis Sekarang
            </a>
        @else
            <a href="{{ route('register') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                🚀 &nbsp;Mulai Gratis Sekarang
            </a>
        @endauth
    </section>
</x-app-layout>

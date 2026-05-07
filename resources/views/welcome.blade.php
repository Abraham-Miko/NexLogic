<x-app-layout>
    <style>
        /* 1. Wrapper Utama & Background Dot Grid Global */
        .homepage-wrapper {
            background-color: #080e1a; /* Warna dasar dipindah ke sini */
            position: relative;
            min-height: 100vh;
            /* overflow: hidden; -> Dihapus agar bisa di-scroll normal */
        }

        .homepage-wrapper::before {
            content: '';
            position: fixed; /* FIXED agar background diam saat halaman di-scroll */
            inset: 0;
            background-image: radial-gradient(circle, rgba(99, 102, 241, 0.22) 1px, transparent 1px); /* Opacity diturunkan sedikit agar tidak mengganggu bacaan di konten bawah */
            background-size: 28px 28px;
            /* Efek pudar disesuaikan agar full seukuran layar (viewport) */
            mask-image: radial-gradient(ellipse 100% 100% at 50% 50%, #000 50%, transparent 100%);
            -webkit-mask-image: radial-gradient(ellipse 100% 100% at 50% 50%, #000 50%, transparent 100%);
            pointer-events: none; /* Penting! Agar tombol tetap bisa di-klik */
            z-index: 0;
        }

        /* Pastikan konten di atas wrapper memiliki z-index */
        .homepage-content {
            position: relative;
            z-index: 1;
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

        .anim-fade-1 { animation: fadeSlideUp 0.6s ease both; }
        .anim-fade-2 { animation: fadeSlideUp 0.6s 0.1s ease both; }
        .anim-fade-3 { animation: fadeSlideUp 0.6s 0.2s ease both; }
        .anim-fade-4 { animation: fadeSlideUp 0.6s 0.3s ease both; }
        .anim-fade-5 { animation: fadeSlideUp 0.6s 0.45s ease both; }
        .anim-float { animation: float 4s ease-in-out infinite; }

        /* 4. Media Query Layar HP */
        @media (max-width: 900px) {
            .hero-decoration { display: none !important; }
            .hero-content { padding: 40px 24px !important; }
        }

        /* Section Container */
        .features-section {
            padding: 80px 5%;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* Header Section */
        .section-label {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #22d3ee;
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

        /* Card Umum */
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

        /* Materi / Course Card */
        .course-main-card {
            background: #0f172a;
            border: 1px solid rgba(99, 102, 241, 0.15);
            border-radius: 16px;
            padding: 32px 40px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 60px;
        }

        .course-main-card:hover {
            transform: translateY(-4px);
            border-color: rgba(34, 211, 238, 0.4);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(34, 211, 238, 0.1);
        }

        .course-badge {
            padding: 6px 16px;
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 9999px;
            font-size: 0.75rem;
            color: #8b9cfa;
            font-weight: 600;
            background: rgba(70, 58, 237, 0.05);
            transition: all 0.2s ease;
        }

        .course-badge:hover {
            border-color: rgba(34, 211, 238, 0.5);
            color: #22d3ee;
        }

        .grid-2-centered {
            grid-template-columns: repeat(2, 1fr);
            width: 66%;
            margin: 0 auto;
        }

        .footer-section {
            background-color: #030712; /* Warna solid gelap untuk menutupi dot-grid */
            position: relative;
            z-index: 20;
            padding: 80px 5% 40px;
            margin-top: 80px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-heading {
            font-size: 1.2rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 24px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .footer-link {
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s ease;
            display: inline-block;
            margin-bottom: 16px;
        }

        .footer-link:hover {
            color: #22d3ee;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding-top: 32px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (max-width: 900px) {
            .hero-decoration { display: none !important; }
            .hero-content { padding: 40px 24px !important; }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .grid-2-centered { width: 100%; }
        }

        @media (max-width: 600px) {
            .features-grid, .grid-2-centered { grid-template-columns: 1fr; }
            .features-section { padding: 60px 24px; }
            .course-main-card { padding: 24px; }
        }
    </style>

    {{-- WRAPPER UTAMA: Membungkus semua section agar background dot-grid berlaku global --}}
    <div class="homepage-wrapper">
        <div class="homepage-content">

            {{-- SECTION: HERO (Atas) --}}
            {{-- Perhatikan: style background-color: #080e1a; sudah dihilangkan dari sini karena sudah diambil alih oleh homepage-wrapper --}}
            <first-section class="hero-section" style="position: relative; min-height: calc(100vh - 60px); display: flex; align-items: center; margin-left: 48px; margin-right: 64px">

                {{-- Ambient glow blobs --}}
                <div style="position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(70, 58, 237, 0.18) 0%, transparent 70%); top: -100px; left: 50px; pointer-events: none; z-index: 0;"></div>
                <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(99, 109, 241, 0.12) 0%, transparent 70%); bottom: -20px; right: 100px; pointer-events: none; z-index: 0;"></div>

                <div class="hero-content" style="position: relative; z-index: 1; padding: 60px 60px 60px 72px; max-width: 760px;">

                    <div class="anim-fade-1" style="display: inline-flex; align-items: center; gap: 8px; padding: 7px 18px; border-radius: 100px; background: rgba(70, 58, 237, 0.12); border: 1px solid rgba(58, 70, 237, 0.35); color: #8b9cfa; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 28px; font-family: 'JetBrains Mono', monospace;">
                        🚀&nbsp; MODUL PEMBELAJARAN INFORMATIKA EKSKLUSIF
                    </div>

                    <h1 class="anim-fade-2" style="font-family: 'Orbitron', sans-serif; font-size: clamp(2.6rem, 5.5vw, 4rem); font-weight: 900; line-height: 1.1; color: #fff; margin: 0 0 20px; letter-spacing: -0.01em;">
                        Asah <span style="background: linear-gradient(135deg, #a09eec 0%, #5867ee 50%, #3d14f0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Logikanya,</span><br>
                        Kuasai Kodenya!
                    </h1>

                    <p class="anim-fade-3" style="font-size: 1rem; color: #64748b; line-height: 1.7; max-width: 480px; margin-bottom: 40px;">
                        Platform e-learning khusus untuk melatih nalar dan algoritma dasar pemrograman.
                        Pahami konsepnya dari nol, selesaikan tantangan logika, dan bersainglah di papan peringkat kelasmu!
                    </p>

                    <div class="anim-fade-4" style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                        @auth
                            @if(auth()->user()->role === 'siswa' && is_null(auth()->user()->sub_wilayah_id))
                                <form action="{{ route('siswa.join_kelas') }}" method="POST" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                    @csrf
                                    <input type="text" name="kode_sub_wilayah" placeholder="Masukkan Kode Kelas" required
                                        style="padding: 12px 16px; border-radius: 12px; border: 1px solid rgba(99, 102, 241, 0.4); background: rgba(15, 23, 42, 0.6); color: white; font-size: 0.95rem; font-family: 'Plus Jakarta Sans', sans-serif; outline: none; transition: border-color 0.2s;"
                                        onfocus="this.style.borderColor='#8b9cfa'" onblur="this.style.borderColor='rgba(99, 102, 241, 0.4)'"
                                    >
                                    <button type="submit" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 24px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                                        Gabung Kelas
                                    </button>
                                    @if(session('error'))
                                        <div style="color: #ef4444; font-size: 0.85rem; width: 100%;">{{ session('error') }}</div>
                                    @endif
                                </form>
                            @else
                                <a href="{{ route('dashboard') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                                    🎮 &nbsp;Lanjut Belajar
                                </a>
                                <a href="#materi" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: transparent; color: #cbd5e1; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: 1.5px solid rgba(99, 102, 241, 0.3); cursor: pointer; transition: color 0.2s, border-color 0.2s, background 0.2s; font-family: 'Plus Jakarta Sans', sans-serif;">
                                    📚 &nbsp;Lihat Materi
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-primary" style="margin-left: 7em; display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                                🎮 &nbsp;Mulai Belajar
                            </a>
                        @endauth
                    </div>

                    <div class="anim-fade-5" style="display: flex; gap: 36px; margin-top: 52px; padding-top: 28px; border-top: 1px solid rgba(99, 102, 241, 0.12);">
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <span style="font-family: 'Orbitron', sans-serif; font-size: 1.5rem; font-weight: 700; color: #6770f3; letter-spacing: -0.02em;">{{ $total_siswa ?? '0' }}</span>
                            <span style="font-size: 0.78rem; color: #475569; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em;">Siswa Terdaftar</span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <span style="font-family: 'Orbitron', sans-serif; font-size: 1.5rem; font-weight: 700; color: #6770f3; letter-spacing: -0.02em;">{{ $total_kelas ?? '0' }}</span>
                            <span style="font-size: 0.78rem; color: #475569; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em;">Kelas Terdaftar</span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <span style="font-family: 'Orbitron', sans-serif; font-size: 1.5rem; font-weight: 700; color: #6770f3; letter-spacing: -0.02em;">{{ $total_soal ?? '0' }}</span>
                            <span style="font-size: 0.78rem; color: #475569; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em;">Soal Latihan</span>
                        </div>
                    </div>

                </div>

                <div class="hero-decoration anim-float" style="position: absolute; right: 8%; top: 50%; transform: translateY(-50%); z-index: 1; display: flex; flex-direction: column; gap: 14px; opacity: 0.9;">
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

            {{-- SECTION: FITUR PENGEMBANGAN --}}
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

            {{-- SECTION: MATERI --}}
            <section class="features-section" id="materi" style="margin-top: 4em;">

                <h2 class="section-title" style="margin-bottom: 24px;">Bahasa yang Akan Dipelajari</h2>

                <div class="course-main-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; flex-wrap: wrap; gap: 16px;">
                        <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 2.2rem; color: #fff; font-weight: 700; margin: 0;">C++</h3>
                        <div style="display: flex; gap: 8px;">
                            <span class="course-badge">Beginner</span>
                            <span class="course-badge">Amateur</span>
                            <span class="course-badge">Pro</span>
                        </div>
                    </div>
                    <h4 style="color: #e2e8f0; font-size: 1.1rem; font-weight: 500; margin-bottom: 8px;">Apa itu C++?</h4>
                    <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; max-width: 900px;">
                        C++ adalah bahasa pemrograman tangguh yang sangat cocok untuk melatih nalar dan algoritma dasar komputer. Dengan mempelajari C++, kamu tidak hanya belajar menulis kode, tetapi memahami bagaimana komputer berpikir dari akarnya. Bahasa ini akan membangun fondasi logikamu menjadi sangat kuat, sehingga ke depannya kamu akan mudah menguasai bahasa pemrograman apa pun!
                    </p>
                </div>

                <h2 class="section-title" style="margin-bottom: 32px; margin-top: 6rem; font-size: 1.8rem;">Materi yang Dipelajari</h2>

                <div class="features-grid" style="margin-bottom: 20px;">
                    <div class="feature-card">
                        <h3 class="feature-heading">Variabel & Tipe Data</h3>
                        <p class="feature-desc">Pelajari cara program komputer "mengingat" sebuah informasi. Mulai dari menyimpan teks, angka bulat, hingga bilangan desimal ke dalam memori.</p>
                    </div>
                    <div class="feature-card">
                        <h3 class="feature-heading">Operator Matematika</h3>
                        <p class="feature-desc">Pahami bagaimana komputer melakukan perhitungan matematika dan perbandingan logika untuk mengolah data mentah menjadi informasi yang berguna.</p>
                    </div>
                    <div class="feature-card">
                        <h3 class="feature-heading">Input / Output</h3>
                        <p class="feature-desc">Buat programmu menjadi interaktif! Pelajari cara menampilkan teks ke layar terminal dan menerima ketikan langsung dari pengguna.</p>
                    </div>
                </div>

                <div class="features-grid grid-3-centered">
                    <div class="feature-card">
                        <h3 class="feature-heading">Percabangan If/Else</h3>
                        <p class="feature-desc">Latih program buatanmu agar bisa "berpikir" dan mengambil keputusan atau rute jalan sendiri berdasarkan kondisi yang kamu tentukan.</p>
                    </div>
                    <div class="feature-card">
                        <h3 class="feature-heading">Perulangan For & While</h3>
                        <p class="feature-desc">Buat komputer melakukan tugas yang melelahkan secara otomatis. Pelajari cara mengulang proses ratusan kali tanpa harus menulis kode berkali-kali.</p>
                    </div>
                    <div class="feature-card">
                        <h3 class="feature-heading">Fungsi & Parameter</h3>
                        <p class="feature-desc">Naik ke level pro! Bungkus rentetan kodinganmu menjadi sebuah "mesin mini" yang rapi, terstruktur, dan dapat digunakan ulang kapan saja.</p>
                    </div>
                </div>

            </section>

            {{-- SECTION: PROMOTION / CALL TO ACTION --}}
            <section class="features-section" id="Promotion" style="text-align: center; margin-top: 4em">
                <h2 class="section-title">Siap Jadi Programmer?</h2>
                <p class="promotion-text">
                    Bergabung dengan ribuan siswa yang sudah memulai perjalanan coding mereka.</p>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                        🚀 &nbsp;Mulai Sekarang
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 12px; background: linear-gradient(135deg, #553aed, #2834d9); color: #fff; font-size: 0.95rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 0 24px rgba(124, 58, 237, 0.45), 0 4px 16px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; font-family: 'Plus Jakarta Sans', sans-serif;">
                        🚀 &nbsp;Mulai Sekarang
                    </a>
                @endauth
            </section>

            <footer class="footer-section">
                <div class="footer-grid">
                    {{-- Kolom 1: Logo & Deskripsi --}}
                    <div>
                        <div style ="margin-bottom: 2rem; transform: scale(2); transform-origin: left center">
                            @include('components.application-logo')
                        </div>

                        <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; max-width: 320px;">
                            Platform belajar logika pemrograman #1 untuk siswa SMK
                        </p>
                    </div>

                    {{-- Kolom 2: Navigasi --}}
                    <div>
                        <h3 class="footer-heading">Navigasi</h3>
                        <div style="display: flex; flex-direction: column;">
                            <a href="#" class="footer-link">Home</a>
                            <a href="#materi" class="footer-link">Courses</a>
                            <a href="#" class="footer-link">Puzzle</a>
                            <a href="#" class="footer-link">Leaderboard</a>
                        </div>
                    </div>

                    {{-- Kolom 3: Community & Socials --}}
                    <div>
                        <h3 class="footer-heading">Community</h3>
                        <div style="display: flex; flex-direction: column; margin-bottom: 24px;">
                            <a href="#" class="footer-link">Discord</a>
                            <a href="#" class="footer-link">GitHub</a>
                        </div>

                        <div style="display: flex; gap: 20px;">
                            {{-- GitHub Icon --}}
                            <a href="#" style="color: #fff; transition: color 0.2s ease;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#fff'">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                            </a>
                            {{-- Discord Icon --}}
                            <a href="#" style="color: #fff; transition: color 0.2s ease;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#fff'">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.3698a19.7913 19.7913 0 00-4.8851-1.5152.0741.0741 0 00-.0785.0371c-.211.3753-.4447.8648-.6083 1.2495-1.8447-.2762-3.68-.2762-5.4868 0-.1636-.3933-.4058-.8742-.6177-1.2495a.077.077 0 00-.0785-.037 19.7363 19.7363 0 00-4.8852 1.515.0699.0699 0 00-.0321.0277C.5334 9.0458-.319 13.5799.0992 18.0578a.0824.0824 0 00.0312.0561c2.0528 1.5076 4.0413 2.4228 5.9929 3.0294a.0777.0777 0 00.0842-.0276c.4616-.6304.8731-1.2952 1.226-1.9942a.076.076 0 00-.0416-.1057c-.6528-.2476-1.2743-.5495-1.8722-.8923a.077.077 0 01-.0076-.1277c.1258-.0943.2517-.1923.3718-.2914a.0743.0743 0 01.0776-.0105c3.9278 1.7933 8.18 1.7933 12.0614 0a.0739.0739 0 01.0785.0095c.1202.099.246.1981.3728.2924a.077.077 0 01-.0066.1276 12.2986 12.2986 0 01-1.873.8914.0766.0766 0 00-.0407.1067c.3604.698.7719 1.3628 1.225 1.9932a.076.076 0 00.0842.0286c1.961-.6067 3.9495-1.5219 6.0023-3.0294a.077.077 0 00.0313-.0552c.5004-5.177-.8382-9.6739-3.5485-13.6604a.061.061 0 00-.0312-.0286zM8.02 15.3312c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9555-2.4189 2.157-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.9555 2.4189-2.1569 2.4189zm7.9748 0c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9554-2.4189 2.1569-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.4189-2.1568 2.4189z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Bottom Credit Bar --}}
                <div class="footer-bottom">
                    <p style="color: #64748b; font-size: 0.85rem; font-family: 'JetBrains Mono', monospace; margin: 0;">
                        &lt;/&gt; with ☕ & 💻 by Tim NexLogic
                    </p>
                    <p style="color: #64748b; font-size: 0.85rem; margin: 0;">
                        &copy; 2026 NexLogic. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </div>
</x-app-layout>

<x-guest-layout>
<style>
    :root {
        --clr-bg-card:  #0f172a;
        --clr-border:   rgba(99,102,241,0.18);
        --clr-purple:   #7c3aed;
        --clr-purple-l: #a78bfa;
        --clr-green:    #22c55e;
        --clr-yellow:   #eab308;
        --clr-red:      #ef4444;
        --clr-muted:    #64748b;
        --clr-dim:      #94a3b8;
    }

    /* ── Wrapper utama ── */
    .detail-wrap { padding: 28px 32px 60px; max-width: 960px; margin: 0 auto; }

    /* ── Breadcrumb ── */
    .breadcrumb { display:flex; align-items:center; gap:8px; font-size:0.82rem; color:var(--clr-muted); margin-bottom:20px; }
    .breadcrumb a { color:var(--clr-purple-l); text-decoration:none; }
    .breadcrumb a:hover { text-decoration:underline; }

    /* ── Header Materi ── */
    .materi-header {
        background:var(--clr-bg-card); border-radius:14px;
        border:1px solid var(--clr-border);
        padding:24px; margin-bottom:24px;
        display:flex; align-items:flex-start; gap:18px;
    }
    .materi-header-icon {
        width:56px; height:56px; border-radius:12px;
        display:flex; align-items:center; justify-content:center;
        font-size:1.8rem; flex-shrink:0;
        background:rgba(124,58,237,.12); color:var(--clr-purple-l);
    }
    .materi-header-info { flex:1; }
    .materi-header-title { font-family:'Orbitron',sans-serif; font-size:1.3rem; font-weight:700; color:#fff; margin:0 0 6px; }
    .materi-header-desc  { color:var(--clr-dim); font-size:0.88rem; margin:0 0 12px; }
    .materi-header-meta  { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }

    .level-badge {
        display:inline-block; padding:3px 12px; border-radius:20px;
        font-size:0.72rem; font-weight:700; letter-spacing:.04em; text-transform:uppercase;
    }
    .badge-beginner { background:rgba(34,197,94,.12);  color:#22c55e; border:1px solid rgba(34,197,94,.3); }
    .badge-amateur  { background:rgba(234,179,8,.12);  color:#eab308; border:1px solid rgba(234,179,8,.3); }
    .badge-pro      { background:rgba(239,68,68,.12);  color:#ef4444; border:1px solid rgba(239,68,68,.3); }

    .stars-row { display:flex; gap:4px; }
    .star      { font-size:1.1rem; color:#1e293b; }
    .star.lit  { color:#eab308; text-shadow:0 0 6px rgba(234,179,8,.6); }

    /* ── Lock Badge untuk Guru ── */
    .lock-badge-guru {
        margin-left:auto; display:flex; align-items:center; gap:8px;
    }

    /* ── Stepper / Tab Navigation ── */
    .stepper {
        display:flex; align-items:center; gap:0;
        background:var(--clr-bg-card); border:1px solid var(--clr-border);
        border-radius:12px; padding:6px; margin-bottom:20px; overflow:hidden;
    }
    .step-btn {
        flex:1; display:flex; align-items:center; gap:10px;
        padding:12px 16px; border-radius:8px; border:none;
        background:transparent; color:var(--clr-muted);
        font-size:0.85rem; font-weight:600; cursor:pointer;
        font-family:inherit; transition:all .2s; text-align:left;
        text-decoration:none; position:relative;
    }
    .step-btn:hover { color:#fff; background:rgba(255,255,255,.04); }
    .step-btn.active {
        background:rgba(124,58,237,.15); color:var(--clr-purple-l);
        box-shadow:inset 0 0 0 1px rgba(124,58,237,.3);
    }
    .step-num {
        width:28px; height:28px; border-radius:50%; flex-shrink:0;
        display:flex; align-items:center; justify-content:center;
        font-size:0.8rem; font-weight:700;
        background:rgba(255,255,255,.06); color:var(--clr-dim);
        border:1px solid rgba(255,255,255,.1);
    }
    .step-btn.active .step-num {
        background:var(--clr-purple); color:#fff; border-color:var(--clr-purple);
        box-shadow:0 0 8px rgba(124,58,237,.5);
    }
    .step-btn.done .step-num  { background:rgba(34,197,94,.15); color:#22c55e; border-color:rgba(34,197,94,.3); }
    .step-btn.done { color:#86efac; }
    .step-info { display:flex; flex-direction:column; gap:2px; }
    .step-label { font-size:0.82rem; }
    .step-sub   { font-size:0.72rem; color:var(--clr-muted); font-weight:400; }
    .step-divider { width:1px; height:32px; background:var(--clr-border); flex-shrink:0; margin:0 4px; }

    /* ── Tab Content Panel ── */
    .tab-panel { display:none; }
    .tab-panel.active { display:block; }

    /* ── Section Box (container tiap tab) ── */
    .section-box {
        background:var(--clr-bg-card); border-radius:14px;
        border:1px solid var(--clr-border); overflow:hidden;
    }
    .section-head {
        padding:18px 24px; border-bottom:1px solid var(--clr-border);
        display:flex; align-items:center; justify-content:space-between; gap:12px;
    }
    .section-head-title { font-family:'Orbitron',sans-serif; font-size:1rem; color:#fff; font-weight:700; }
    .section-head-sub   { font-size:0.8rem; color:var(--clr-muted); margin-top:2px; }
    .section-body { padding:24px; }

    /* ── Soal Card ── */
    .soal-card {
        background:rgba(255,255,255,.025); border:1px solid rgba(99,102,241,.1);
        border-radius:10px; padding:18px; margin-bottom:14px;
    }
    .soal-num  { font-size:0.72rem; color:var(--clr-muted); margin-bottom:6px; }
    .soal-text { color:#e2e8f0; font-size:0.92rem; line-height:1.6; margin-bottom:14px; }
    .soal-options { display:flex; flex-direction:column; gap:8px; }
    .option-item {
        display:flex; align-items:flex-start; gap:10px;
        padding:9px 14px; border-radius:8px;
        border:1px solid rgba(99,102,241,.12);
        background:rgba(255,255,255,.02); cursor:pointer;
        transition:all .15s;
    }
    .option-item:has(input:checked) {
        background:rgba(124,58,237,.12); border-color:rgba(124,58,237,.4);
    }
    .option-item input[type="radio"] { margin-top:2px; accent-color:var(--clr-purple); }
    .option-key  { font-weight:700; color:var(--clr-purple-l); font-size:0.85rem; flex-shrink:0; }
    .option-text { font-size:0.88rem; color:#cbd5e1; }

    /* Jawaban guru (readonly – tampilkan answer) */
    .correct-answer-badge {
        display:inline-flex; align-items:center; gap:5px;
        padding:3px 10px; border-radius:20px; font-size:0.75rem;
        background:rgba(34,197,94,.1); color:#86efac; border:1px solid rgba(34,197,94,.25);
        margin-top:8px;
    }

    /* ── Form Soal (Guru) ── */
    .form-soal { background:rgba(124,58,237,.06); border:1px dashed rgba(124,58,237,.3); border-radius:12px; padding:20px; margin-top:20px; }
    .form-soal-title { font-size:0.9rem; font-weight:700; color:var(--clr-purple-l); margin-bottom:16px; }
    .form-group { margin-bottom:12px; }
    .form-label { display:block; font-size:0.78rem; font-weight:600; color:var(--clr-dim); margin-bottom:5px; }
    .form-ctrl {
        width:100%; padding:8px 13px; background:rgba(255,255,255,.04);
        border:1px solid rgba(99,102,241,.2); border-radius:8px;
        color:#fff; font-size:0.87rem; outline:none; font-family:inherit;
        transition:border-color .2s; box-sizing:border-box;
    }
    .form-ctrl:focus { border-color:rgba(167,139,250,.5); }
    .form-ctrl option { background:#0f172a; }
    .options-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
    .btn-primary {
        padding:9px 22px; background:var(--clr-purple); border:none;
        border-radius:8px; color:#fff; font-size:0.87rem; font-weight:600;
        cursor:pointer; transition:background .2s; font-family:inherit;
    }
    .btn-primary:hover { background:#6d28d9; }
    .btn-danger {
        padding:5px 12px; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.25);
        border-radius:7px; color:#fca5a5; font-size:0.78rem; font-weight:600;
        cursor:pointer; transition:all .2s; font-family:inherit;
    }
    .btn-danger:hover { background:rgba(239,68,68,.25); }

    /* ── Konten Materi (Rich HTML) ── */
    .materi-content {
        color:#cbd5e1; line-height:1.8; font-size:0.92rem;
    }
    .materi-content h1,.materi-content h2,.materi-content h3 {
        font-family:'Orbitron',sans-serif; color:#fff; margin:1.5em 0 .5em;
    }
    .materi-content h2 { font-size:1.1rem; }
    .materi-content h3 { font-size:0.95rem; }
    .materi-content p  { margin:0 0 1em; }
    .materi-content code {
        background:rgba(124,58,237,.12); color:#a78bfa;
        padding:2px 8px; border-radius:5px;
        font-family:'JetBrains Mono', monospace; font-size:0.85em;
    }
    .materi-content pre {
        background:#080e1a; border:1px solid rgba(124,58,237,.2);
        border-radius:10px; padding:18px; overflow-x:auto; margin:1em 0;
    }
    .materi-content pre code { background:none; padding:0; color:#e2e8f0; }
    .materi-content ul, .materi-content ol { padding-left:1.5em; margin:0 0 1em; }
    .materi-content li { margin-bottom:.4em; }
    .materi-content blockquote {
        border-left:3px solid var(--clr-purple); padding:10px 16px;
        background:rgba(124,58,237,.07); border-radius:0 8px 8px 0; margin:1em 0;
        color:var(--clr-dim); font-style:italic;
    }
    .materi-content table { width:100%; border-collapse:collapse; margin:1em 0; }
    .materi-content th, .materi-content td {
        padding:10px 14px; text-align:left; border-bottom:1px solid var(--clr-border);
    }
    .materi-content th { color:#fff; background:rgba(124,58,237,.1); }

    /* Tombol Selesai Baca */
    .btn-selesai-baca {
        display:inline-flex; align-items:center; gap:8px;
        margin-top:24px; padding:12px 28px; border-radius:10px;
        background:linear-gradient(135deg,#a78bfa,#7c3aed);
        color:#fff; font-weight:700; font-size:0.9rem; border:none;
        cursor:pointer; font-family:inherit; transition:all .2s;
        box-shadow:0 0 16px rgba(124,58,237,.4);
    }
    .btn-selesai-baca:hover { box-shadow:0 0 24px rgba(124,58,237,.7); transform:translateY(-2px); }

    /* ── Submit Button ── */
    .btn-submit-test {
        display:inline-flex; align-items:center; gap:8px;
        margin-top:20px; padding:12px 28px; border-radius:10px;
        background:linear-gradient(135deg,#34d399,#059669);
        color:#fff; font-weight:700; font-size:0.9rem; border:none;
        cursor:pointer; font-family:inherit; transition:all .2s;
        box-shadow:0 0 16px rgba(5,150,105,.4);
    }
    .btn-submit-test:hover { box-shadow:0 0 24px rgba(5,150,105,.7); transform:translateY(-2px); }

    /* ── Result Box (setelah test selesai) ── */
    .result-box {
        border-radius:12px; padding:24px; text-align:center; margin-bottom:20px;
    }
    .result-box.success { background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.25); }
    .result-box.warning { background:rgba(234,179,8,.1);  border:1px solid rgba(234,179,8,.25); }
    .result-score { font-family:'Orbitron',sans-serif; font-size:2.5rem; font-weight:700; color:#fff; }
    .result-label { color:var(--clr-dim); font-size:0.85rem; margin-top:4px; }
    .result-stars { display:flex; justify-content:center; gap:6px; margin-top:12px; }
    .result-stars .star { font-size:1.8rem; }

    /* ── Alert ── */
    .alert {
        padding:12px 18px; border-radius:10px; font-size:0.87rem;
        font-weight:500; margin-bottom:16px;
    }
    .alert-success { background:rgba(34,197,94,.1); color:#86efac; border:1px solid rgba(34,197,94,.25); }
    .alert-error   { background:rgba(239,68,68,.1); color:#fca5a5; border:1px solid rgba(239,68,68,.25); }

    /* Info box */
    .info-box {
        padding:14px 18px; border-radius:10px; font-size:0.85rem;
        background:rgba(99,102,241,.08); border:1px solid rgba(99,102,241,.2);
        color:var(--clr-dim); display:flex; align-items:flex-start; gap:10px;
    }
    .info-box svg { flex-shrink:0; margin-top:1px; }

    /* Empty soal */
    .empty-soal {
        padding:40px; text-align:center; color:var(--clr-muted); font-size:0.88rem;
    }

    /* Toggle lock button (dalam header) */
    .btn-toggle-lock {
        padding:7px 18px; border-radius:8px; font-size:0.82rem; font-weight:600;
        border:none; cursor:pointer; font-family:inherit; transition:all .2s;
        display:inline-flex; align-items:center; gap:6px;
    }
    .btn-toggle-lock.locked   { background:rgba(34,197,94,.1); color:#86efac; border:1px solid rgba(34,197,94,.3); }
    .btn-toggle-lock.unlocked { background:rgba(234,179,8,.1); color:#fde047; border:1px solid rgba(234,179,8,.3); }
    .btn-toggle-lock:hover { filter:brightness(1.2); }
</style>

<div class="detail-wrap">

    {{-- ── Breadcrumb ── --}}
    <div class="breadcrumb">
        <a href="{{ route('materi.index') }}">← Kembali ke Materi</a>
        <span>/</span>
        <span>{{ $materi->title }}</span>
    </div>

    {{-- ── Flash Alert ── --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    {{-- ── Header Materi ── --}}
    <div class="materi-header">
        <div class="materi-header-icon">
            {{ $materi->icon ?: ($materi->level === 'beginner' ? '📦' : ($materi->level === 'amateur' ? '⚡' : '🔥')) }}
        </div>
        <div class="materi-header-info">
            <h1 class="materi-header-title">{{ $materi->title }}</h1>
            <p class="materi-header-desc">{{ $materi->description }}</p>
            <div class="materi-header-meta">
                <span class="level-badge badge-{{ $materi->level }}">{{ ucfirst($materi->level) }}</span>

                {{-- Bintang untuk Siswa --}}
                @if(Auth::user()->role === 'siswa' && $progress)
                    <div class="stars-row">
                        @for($i = 1; $i <= 3; $i++)
                            <span class="star {{ $i <= $progress->stars ? 'lit' : '' }}">★</span>
                        @endfor
                    </div>
                    <span style="font-size:.78rem; color:var(--clr-muted);">
                        {{ $progress->progress_percentage }}% Selesai
                    </span>
                @endif

                {{-- Toggle Lock untuk Guru --}}
                @if(Auth::user()->role === 'guru')
                    <div class="lock-badge-guru">
                        @if($isLockedByCurrentGuru)
                            <span style="font-size:.8rem; color:#fde047;">🔒 Materi Terkunci</span>
                        @else
                            <span style="font-size:.8rem; color:#86efac;">🔓 Materi Terbuka</span>
                        @endif
                        <form method="POST" action="{{ route('materi.toggle-lock', $materi) }}" style="margin:0">
                            @csrf
                            @if($isLockedByCurrentGuru)
                                <button type="submit" class="btn-toggle-lock locked">🔓 Buka untuk Siswa</button>
                            @else
                                <button type="submit" class="btn-toggle-lock unlocked">🔒 Kunci dari Siswa</button>
                            @endif
                        </form>
                    </div>
                @endif

                {{-- Edit/Delete untuk Super Admin --}}
                @if(Auth::user()->role === 'superadmin')
                    <a href="#" onclick="openEditModal(); return false;"
                       style="font-size:.8rem; color:var(--clr-purple-l); text-decoration:none; margin-left:8px;">✏️ Edit Materi</a>
                @endif
            </div>
        </div>
    </div>

    {{-- ── Stepper Navigation ── --}}
    @php
        $tab = request('tab', $activeTab);
        if (session('tab')) $tab = session('tab');

        // Tentukan status tiap step (done / active / locked)
        $preTestDone    = $progress && $progress->hasPreTest();
        $materiRead     = $progress && $progress->progress_percentage >= 66;
        $postTestDone   = $progress && $progress->hasPostTest();

        // Untuk Guru & Super Admin: semua step bisa diakses
        $isStaff = in_array(Auth::user()->role, ['guru', 'superadmin']);
    @endphp

    <div class="stepper">
        {{-- Step 1: Pre-Test --}}
        <a href="?tab=pre_test"
           class="step-btn {{ $tab === 'pre_test' ? 'active' : '' }} {{ $preTestDone && $tab !== 'pre_test' ? 'done' : '' }}">
            <div class="step-num">
                @if($preTestDone && $tab !== 'pre_test') ✓ @else 1 @endif
            </div>
            <div class="step-info">
                <span class="step-label">Pre-Test</span>
                <span class="step-sub">
                    @if($preTestDone) Skor: {{ $progress->pre_test_score }}/100
                    @elseif($isStaff) Kelola soal pre-test
                    @else Wajib dikerjakan dulu
                    @endif
                </span>
            </div>
        </a>

        <div class="step-divider"></div>

        {{-- Step 2: Materi --}}
        <a href="{{ ($isStaff || $preTestDone) ? '?tab=materi' : '#' }}"
           class="step-btn {{ $tab === 'materi' ? 'active' : '' }} {{ $materiRead && $tab !== 'materi' ? 'done' : '' }}"
           style="{{ (!$isStaff && !$preTestDone) ? 'opacity:.4; pointer-events:none; cursor:not-allowed;' : '' }}">
            <div class="step-num">
                @if($materiRead && $tab !== 'materi') ✓ @else 2 @endif
            </div>
            <div class="step-info">
                <span class="step-label">Materi</span>
                <span class="step-sub">
                    @if($materiRead) Sudah dibaca
                    @else Konten pembelajaran
                    @endif
                </span>
            </div>
        </a>

        <div class="step-divider"></div>

        {{-- Step 3: Post-Test --}}
        <a href="{{ ($isStaff || $materiRead) ? '?tab=post_test' : '#' }}"
           class="step-btn {{ $tab === 'post_test' ? 'active' : '' }} {{ $postTestDone && $tab !== 'post_test' ? 'done' : '' }}"
           style="{{ (!$isStaff && !$materiRead) ? 'opacity:.4; pointer-events:none; cursor:not-allowed;' : '' }}">
            <div class="step-num">
                @if($postTestDone && $tab !== 'post_test') ✓ @else 3 @endif
            </div>
            <div class="step-info">
                <span class="step-label">Post-Test</span>
                <span class="step-sub">
                    @if($postTestDone) Skor: {{ $progress->post_test_score }}/100
                    @elseif($isStaff) Kelola soal post-test
                    @else Selesaikan materi dulu
                    @endif
                </span>
            </div>
        </a>

        <div class="stepper">
            <!-- ... (Step 1, 2, 3 tetap ada) ... -->

            @if(Auth::user()->role === 'guru' || Auth::user()->role === 'superadmin')
                <div class="step-divider"></div>
                <a href="?tab=rekap_skor" class="step-btn {{ request('tab') === 'rekap_skor' ? 'active' : '' }}">
                    <div class="step-num">📊</div>
                    <div class="step-info">
                        <span class="step-label">Rekap Skor</span>
                        <span class="step-sub">Lihat hasil pengerjaan</span>
                    </div>
                </a>
            @endif
        </div>

        <!-- Di dalam TAB PANEL PRE-TEST & POST-TEST -->
        <div class="section-head">
            <div>
                <div class="section-head-title">📝 Soal Ujian</div>
            </div>

            <!-- FITUR: Kunci Jawaban Halaman Terpisah (Super Admin & Guru) -->
            @if(Auth::user()->role === 'superadmin' || Auth::user()->role === 'guru')
                <a href="{{ route('materi.kunci-jawaban', [$materi->id, 'type' => $tab]) }}"
                class="btn-sm btn-detail" style="text-decoration:none">
                🔑 Lihat Kunci Jawaban
                </a>
            @endif
        </div>

        <div class="section-body">
            <!-- Form Tambah Soal (Hanya Guru & Super Admin) -->
            @if(Auth::user()->role === 'guru' || Auth::user()->role === 'superadmin')
                <div class="form-soal">
                    <div class="form-soal-title">➕ Tambah Soal (Role: {{ ucfirst(Auth::user()->role) }})</div>
                    <!-- Form store soal tetap sama seperti kode sebelumnya -->
                </div>
            @endif

            <!-- Tampilan Skor untuk Siswa (Setelah mengerjakan) -->
            @if(Auth::user()->role === 'siswa' && $preTestDone)
                <div class="result-box success">
                    <div class="result-score">{{ $progress->pre_test_score }}</div>
                    <div class="result-label">Skor Kamu</div>
                </div>
            @endif
        </div>

        <!-- TAB PANEL BARU: Rekap Skor (Hanya Guru & Super Admin) -->
        @if(Auth::user()->role === 'guru' || Auth::user()->role === 'superadmin')
            <div class="tab-panel {{ request('tab') === 'rekap_skor' ? 'active' : '' }}">
                <div class="section-box">
                    <div class="section-head"><div class="section-head-title">📊 Daftar Nilai Pengguna</div></div>
                    <div class="section-body">
                        <table class="materi-content" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Pre-Test</th>
                                    <th>Post-Test</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allProgress as $p)
                                    @php
                                        $showRow = false;
                                        if(Auth::user()->role === 'superadmin') $showRow = true; // Super Admin lihat semua
                                        if(Auth::user()->role === 'guru' && in_array($p->user->role, ['siswa', 'guru'])) $showRow = true; // Guru lihat siswa & guru
                                    @endphp

                                    @if($showRow)
                                    <tr>
                                        <td>{{ $p->user->name }}</td>
                                        <td><span class="level-badge">{{ $p->user->role }}</span></td>
                                        <td>{{ $p->pre_test_score ?? '-' }}</td>
                                        <td>{{ $p->post_test_score ?? '-' }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- ════════════════════════════════════════════════════════════
         TAB 1: PRE-TEST
    ════════════════════════════════════════════════════════════ --}}
    <div class="tab-panel {{ $tab === 'pre_test' ? 'active' : '' }}">
        <div class="section-box">
            <div class="section-head">
                <div>
                    <div class="section-head-title">📝 Pre-Test</div>
                    <div class="section-head-sub">
                        {{ $preTests->count() }} soal ·
                        @if($isStaff) Kamu adalah {{ ucfirst(Auth::user()->role) }}
                        @else Jawab semua soal sebelum membaca materi
                        @endif
                    </div>
                </div>
            </div>
            <div class="section-body">

                {{-- ── Siswa: Sudah mengerjakan pre-test ── --}}
                @if(Auth::user()->role === 'siswa' && $preTestDone)
                    <div class="result-box success">
                        <div class="result-score">{{ $progress->pre_test_score }}<span style="font-size:1rem; color:var(--clr-dim)">/100</span></div>
                        <div class="result-label">Skor Pre-Test kamu</div>
                    </div>
                    <div class="info-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pre-test sudah selesai. Lanjut ke <a href="?tab=materi" style="color:var(--clr-purple-l)">baca materi →</a>
                    </div>

                {{-- ── Siswa: Belum mengerjakan pre-test (form jawab) ── --}}
                @elseif(Auth::user()->role === 'siswa' && !$preTestDone)
                    @if($preTests->isEmpty())
                        <div class="empty-soal">
                            <p>Belum ada soal pre-test. Hubungi gurumu.</p>
                        </div>
                    @else
                        <form method="POST" action="{{ route('tests.submit', $materi) }}">
                            @csrf
                            <input type="hidden" name="type" value="pre_test">
                            @foreach($preTests as $i => $test)
                                <div class="soal-card">
                                    <div class="soal-num">Soal {{ $i + 1 }} dari {{ $preTests->count() }}</div>
                                    <div class="soal-text">{{ $test->question }}</div>
                                    <div class="soal-options">
                                        @foreach(['A','B','C','D'] as $key)
                                            @if(isset($test->options[$key]))
                                                <label class="option-item">
                                                    <input type="radio" name="jawaban_{{ $test->id }}" value="{{ $key }}" required>
                                                    <span class="option-key">{{ $key }}</span>
                                                    <span class="option-text">{{ $test->options[$key] }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn-submit-test">
                                ✅ Kumpulkan Jawaban Pre-Test
                            </button>
                        </form>
                    @endif

                {{-- ── Guru / Super Admin: Tampil soal + form tambah soal ── --}}
                @else
                    @if($preTests->isEmpty())
                        <div class="empty-soal">Belum ada soal pre-test.</div>
                    @else
                        @foreach($preTests as $i => $test)
                            <div class="soal-card">
                                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:8px; margin-bottom:6px;">
                                    <div class="soal-num">Soal {{ $i + 1 }}</div>
                                    @if(Auth::user()->role === 'guru' && $test->guru_id === Auth::id())
                                        <div style="display:flex; gap:6px;">
                                            <button onclick="openEditSoal({{ $test->id }})" class="btn-sm" style="font-size:.72rem; padding:3px 10px; background:rgba(59,130,246,.1); color:#93c5fd; border:1px solid rgba(59,130,246,.25); border-radius:6px; cursor:pointer;">✏️</button>
                                            <form method="POST" action="{{ route('tests.destroy', $test) }}" style="margin:0"
                                                  onsubmit="return confirm('Hapus soal ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-danger" style="padding:3px 10px; font-size:.72rem;">🗑️</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <div class="soal-text">{{ $test->question }}</div>
                                <div class="soal-options" style="pointer-events:none;">
                                    @foreach(['A','B','C','D'] as $key)
                                        @if(isset($test->options[$key]))
                                            <div class="option-item" style="{{ $key === $test->correct_answer ? 'background:rgba(34,197,94,.08); border-color:rgba(34,197,94,.3)' : '' }}">
                                                <span class="option-key">{{ $key }}</span>
                                                <span class="option-text">{{ $test->options[$key] }}</span>
                                                @if($key === $test->correct_answer)
                                                    <span style="margin-left:auto; font-size:.7rem; color:#22c55e;">✓ Benar</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <span style="font-size:.72rem; color:var(--clr-muted); margin-top:8px; display:block;">
                                    Dibuat oleh: {{ $test->guru->name ?? 'Tidak diketahui' }}
                                </span>
                            </div>
                        @endforeach
                    @endif

                    {{-- Form Tambah Soal – hanya untuk Guru --}}
                    @if(Auth::user()->role === 'guru')
                        <div class="form-soal">
                            <div class="form-soal-title">➕ Tambah Soal Pre-Test</div>
                            <form method="POST" action="{{ route('tests.store', $materi) }}">
                                @csrf
                                <input type="hidden" name="type" value="pre_test">
                                <div class="form-group">
                                    <label class="form-label">Pertanyaan *</label>
                                    <textarea name="question" class="form-ctrl" rows="2" required
                                              placeholder="Tulis pertanyaanmu di sini..."></textarea>
                                </div>
                                <div class="options-grid">
                                    <div class="form-group">
                                        <label class="form-label">Pilihan A *</label>
                                        <input type="text" name="option_a" class="form-ctrl" required placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pilihan B *</label>
                                        <input type="text" name="option_b" class="form-ctrl" required placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pilihan C *</label>
                                        <input type="text" name="option_c" class="form-ctrl" required placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pilihan D *</label>
                                        <input type="text" name="option_d" class="form-ctrl" required placeholder="...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jawaban Benar *</label>
                                    <select name="correct_answer" class="form-ctrl" required style="width:auto">
                                        <option value="">-- Pilih --</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn-primary">💾 Simpan Soal</button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════════
         TAB 2: KONTEN MATERI
    ════════════════════════════════════════════════════════════ --}}
    <div class="tab-panel {{ $tab === 'materi' ? 'active' : '' }}">
        <div class="section-box">
            <div class="section-head">
                <div>
                    <div class="section-head-title">📖 {{ $materi->title }}</div>
                    <div class="section-head-sub">Baca dan pahami materi berikut dengan seksama</div>
                </div>
                @if(Auth::user()->role === 'siswa' && $preTestDone && $materiRead)
                    <span style="font-size:.78rem; color:#86efac; background:rgba(34,197,94,.1); padding:4px 12px; border-radius:20px; border:1px solid rgba(34,197,94,.25);">
                        ✓ Sudah Dibaca
                    </span>
                @endif
            </div>
            <div class="section-body">

                {{-- Siswa perlu selesaikan pre-test dulu --}}
                @if(Auth::user()->role === 'siswa' && !$preTestDone)
                    <div class="info-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Selesaikan <a href="?tab=pre_test" style="color:var(--clr-purple-l)">Pre-Test</a> terlebih dahulu untuk membaca materi ini.
                    </div>
                @else
                    {{-- Konten Materi (HTML dari database) --}}
                    <div class="materi-content">
                        {!! $materi->content !!}
                    </div>

                    {{-- Tombol Selesai Baca – siswa yang sudah pre-test tapi belum tandai baca --}}
                    @if(Auth::user()->role === 'siswa' && $preTestDone && !$materiRead)
                        <form method="POST" action="{{ route('materi.mark-read', $materi) }}" style="margin-top:20px">
                            @csrf
                            <button type="submit" class="btn-selesai-baca">
                                ✅ Saya Sudah Selesai Membaca – Lanjut Post-Test
                            </button>
                        </form>
                    @elseif(Auth::user()->role === 'siswa' && $materiRead && !$postTestDone)
                        <div style="margin-top:20px;">
                            <a href="?tab=post_test" class="btn-selesai-baca" style="text-decoration:none; display:inline-flex;">
                                ➡️ Lanjut ke Post-Test
                            </a>
                        </div>
                    @endif

                    {{-- Super Admin: Edit konten materi --}}
                    @if(Auth::user()->role === 'superadmin')
                        <div style="margin-top:20px; padding-top:20px; border-top:1px solid var(--clr-border);">
                            <p style="font-size:.8rem; color:var(--clr-muted);">🔧 Sebagai Super Admin, kamu bisa mengedit konten materi melalui tombol <strong>Edit Materi</strong> di header atas.</p>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════════
         TAB 3: POST-TEST
    ════════════════════════════════════════════════════════════ --}}
    <div class="tab-panel {{ $tab === 'post_test' ? 'active' : '' }}">
        <div class="section-box">
            <div class="section-head">
                <div>
                    <div class="section-head-title">🏁 Post-Test</div>
                    <div class="section-head-sub">
                        {{ $postTests->count() }} soal ·
                        @if($isStaff) Kelola soal post-test
                        @else Kerjakan setelah membaca materi
                        @endif
                    </div>
                </div>
            </div>
            <div class="section-body">

                {{-- ── Siswa: Sudah selesai post-test ── --}}
                @if(Auth::user()->role === 'siswa' && $postTestDone)
                    @php $isPass = $progress->post_test_score >= 60; @endphp
                    <div class="result-box {{ $isPass ? 'success' : 'warning' }}">
                        <div class="result-score">{{ $progress->post_test_score }}<span style="font-size:1rem; color:var(--clr-dim)">/100</span></div>
                        <div class="result-label">{{ $isPass ? '🎉 Selamat! Kamu lulus!' : '😅 Tetap semangat belajar!' }}</div>
                        <div class="result-stars">
                            @for($i = 1; $i <= 3; $i++)
                                <span class="star {{ $i <= $progress->stars ? 'lit' : '' }}">★</span>
                            @endfor
                        </div>
                        <p style="font-size:.8rem; color:var(--clr-muted); margin-top:8px;">
                            {{ $progress->stars }} dari 3 bintang · {{ $progress->stars >= 1 ? 'Kamu sudah lulus!' : 'Butuh skor ≥ 60 untuk lulus.' }}
                        </p>
                    </div>
                    <div class="info-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Materi ini sudah selesai. Kembali ke <a href="{{ route('materi.index') }}" style="color:var(--clr-purple-l)">daftar materi</a> untuk lanjut.
                    </div>

                {{-- ── Siswa: Belum baca materi ── --}}
                @elseif(Auth::user()->role === 'siswa' && !$materiRead)
                    <div class="info-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Baca <a href="?tab=materi" style="color:var(--clr-purple-l)">materi</a> terlebih dahulu sebelum mengerjakan post-test.
                    </div>

                {{-- ── Siswa: Sudah baca, belum post-test (form jawab) ── --}}
                @elseif(Auth::user()->role === 'siswa' && $materiRead && !$postTestDone)
                    @if($postTests->isEmpty())
                        <div class="empty-soal">Belum ada soal post-test.</div>
                    @else
                        <form method="POST" action="{{ route('tests.submit', $materi) }}">
                            @csrf
                            <input type="hidden" name="type" value="post_test">
                            @foreach($postTests as $i => $test)
                                <div class="soal-card">
                                    <div class="soal-num">Soal {{ $i + 1 }} dari {{ $postTests->count() }}</div>
                                    <div class="soal-text">{{ $test->question }}</div>
                                    <div class="soal-options">
                                        @foreach(['A','B','C','D'] as $key)
                                            @if(isset($test->options[$key]))
                                                <label class="option-item">
                                                    <input type="radio" name="jawaban_{{ $test->id }}" value="{{ $key }}" required>
                                                    <span class="option-key">{{ $key }}</span>
                                                    <span class="option-text">{{ $test->options[$key] }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn-submit-test">
                                🏁 Kumpulkan Jawaban Post-Test
                            </button>
                        </form>
                    @endif

                {{-- ── Guru / Super Admin: Tampil soal + form tambah ── --}}
                @else
                    @if($postTests->isEmpty())
                        <div class="empty-soal">Belum ada soal post-test.</div>
                    @else
                        @foreach($postTests as $i => $test)
                            <div class="soal-card">
                                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:8px; margin-bottom:6px;">
                                    <div class="soal-num">Soal {{ $i + 1 }}</div>
                                    @if(Auth::user()->role === 'guru' && $test->guru_id === Auth::id())
                                        <div style="display:flex; gap:6px;">
                                            <form method="POST" action="{{ route('tests.destroy', $test) }}" style="margin:0"
                                                  onsubmit="return confirm('Hapus soal ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-danger" style="padding:3px 10px; font-size:.72rem;">🗑️ Hapus</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <div class="soal-text">{{ $test->question }}</div>
                                <div class="soal-options" style="pointer-events:none;">
                                    @foreach(['A','B','C','D'] as $key)
                                        @if(isset($test->options[$key]))
                                            <div class="option-item" style="{{ $key === $test->correct_answer ? 'background:rgba(34,197,94,.08); border-color:rgba(34,197,94,.3)' : '' }}">
                                                <span class="option-key">{{ $key }}</span>
                                                <span class="option-text">{{ $test->options[$key] }}</span>
                                                @if($key === $test->correct_answer)
                                                    <span style="margin-left:auto; font-size:.7rem; color:#22c55e;">✓ Benar</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <span style="font-size:.72rem; color:var(--clr-muted); margin-top:8px; display:block;">
                                    Dibuat oleh: {{ $test->guru->name ?? 'Tidak diketahui' }}
                                </span>
                            </div>
                        @endforeach
                    @endif

                    {{-- Form Tambah Soal – hanya Guru --}}
                    @if(Auth::user()->role === 'guru')
                        <div class="form-soal">
                            <div class="form-soal-title">➕ Tambah Soal Post-Test</div>
                            <form method="POST" action="{{ route('tests.store', $materi) }}">
                                @csrf
                                <input type="hidden" name="type" value="post_test">
                                <div class="form-group">
                                    <label class="form-label">Pertanyaan *</label>
                                    <textarea name="question" class="form-ctrl" rows="2" required
                                              placeholder="Tulis pertanyaanmu di sini..."></textarea>
                                </div>
                                <div class="options-grid">
                                    <div class="form-group">
                                        <label class="form-label">Pilihan A *</label>
                                        <input type="text" name="option_a" class="form-ctrl" required placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pilihan B *</label>
                                        <input type="text" name="option_b" class="form-ctrl" required placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pilihan C *</label>
                                        <input type="text" name="option_c" class="form-ctrl" required placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pilihan D *</label>
                                        <input type="text" name="option_d" class="form-ctrl" required placeholder="...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jawaban Benar *</label>
                                    <select name="correct_answer" class="form-ctrl" required style="width:auto">
                                        <option value="">-- Pilih --</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn-primary">💾 Simpan Soal</button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

</div>

{{-- Sembunyikan "btn-sm" jika belum didefinisi di halaman ini --}}
<style>
    .btn-sm {
        padding:5px 14px; border-radius:7px; font-size:0.78rem; font-weight:600;
        text-decoration:none; display:inline-flex; align-items:center; gap:5px;
        transition:all .2s; cursor:pointer; border:none; font-family:inherit;
    }
</style>

</x-app-layout>

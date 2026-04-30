<x-guest-layout>
<style>
    /* ── Variables & Base ── */
    :root {
        --clr-bg-card:    #0f172a;
        --clr-bg-card2:   #111827;
        --clr-border:     rgba(99,102,241,0.18);
        --clr-purple:     #7c3aed;
        --clr-purple-l:   #a78bfa;
        --clr-green:      #22c55e;
        --clr-yellow:     #eab308;
        --clr-red:        #ef4444;
        --clr-muted:      #64748b;
        --clr-dim:        #94a3b8;
    }

    /* ── Page Header ── */
    .page-header { padding: 32px 32px 0; }
    .page-title  { font-family:'Orbitron',sans-serif; font-size:1.6rem; font-weight:700; color:#fff; margin:0 0 6px; }
    .page-sub    { color:var(--clr-dim); font-size:0.9rem; margin:0; }

    /* ── Filter Bar ── */
    .filter-bar {
        display:flex; align-items:center; justify-content:space-between;
        padding:20px 32px; gap:16px; flex-wrap:wrap;
    }
    .filter-tabs { display:flex; gap:8px; flex-wrap:wrap; }
    .filter-tab {
        padding:7px 20px; border-radius:20px; font-size:0.82rem; font-weight:600;
        border:1px solid var(--clr-border); background:transparent;
        color:var(--clr-dim); cursor:pointer; text-decoration:none;
        transition:all .2s ease;
    }
    .filter-tab:hover   { color:#fff; border-color:rgba(167,139,250,.4); background:rgba(124,58,237,.08); }
    .filter-tab.active  { background:var(--clr-purple); color:#fff; border-color:var(--clr-purple); box-shadow:0 0 12px rgba(124,58,237,.4); }
    .filter-tab.beginner.active { background:#16a34a; border-color:#16a34a; box-shadow:0 0 12px rgba(34,197,94,.4); }
    .filter-tab.amateur.active  { background:#b45309; border-color:#b45309; box-shadow:0 0 12px rgba(234,179,8,.4); }
    .filter-tab.pro.active      { background:#dc2626; border-color:#dc2626; box-shadow:0 0 12px rgba(239,68,68,.4); }

    /* Search */
    .search-wrap { display:flex; align-items:center; gap:0; }
    .search-input {
        height:38px; padding:0 16px; background:rgba(255,255,255,.04);
        border:1px solid var(--clr-border); border-right:none;
        border-radius:8px 0 0 8px; color:#fff; font-size:0.85rem;
        outline:none; width:220px; transition:border-color .2s;
    }
    .search-input:focus { border-color:rgba(167,139,250,.5); }
    .search-input::placeholder { color:var(--clr-muted); }
    .search-btn {
        height:38px; padding:0 14px; background:var(--clr-purple);
        border:1px solid var(--clr-purple); border-radius:0 8px 8px 0;
        color:#fff; cursor:pointer; display:flex; align-items:center;
        transition:background .2s;
    }
    .search-btn:hover { background:#6d28d9; }

    /* ── Grid Materi ── */
    .materi-grid {
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap:20px;
        padding:4px 32px 40px;
    }

    /* ── Card ── */
    .materi-card {
        position:relative; border-radius:14px; overflow:hidden;
        background:var(--clr-bg-card);
        border:1px solid var(--clr-border);
        transition:transform .25s ease, box-shadow .25s ease;
        display:flex; flex-direction:column;
    }
    .materi-card:hover { transform:translateY(-4px); }
    .materi-card.level-beginner { border-color:rgba(34,197,94,.35); }
    .materi-card.level-beginner:hover { box-shadow:0 8px 32px rgba(34,197,94,.2); }
    .materi-card.level-amateur  { border-color:rgba(234,179,8,.35); }
    .materi-card.level-amateur:hover  { box-shadow:0 8px 32px rgba(234,179,8,.2); }
    .materi-card.level-pro      { border-color:rgba(239,68,68,.35); }
    .materi-card.level-pro:hover      { box-shadow:0 8px 32px rgba(239,68,68,.2); }

    /* Level glow bar di atas card */
    .card-glow-bar { height:3px; width:100%; }
    .level-beginner .card-glow-bar { background:linear-gradient(90deg,transparent,#22c55e,transparent); }
    .level-amateur  .card-glow-bar { background:linear-gradient(90deg,transparent,#eab308,transparent); }
    .level-pro      .card-glow-bar { background:linear-gradient(90deg,transparent,#ef4444,transparent); }

    .card-body { padding:20px; flex:1; display:flex; flex-direction:column; gap:12px; }

    /* Icon materi */
    .card-icon {
        width:44px; height:44px; border-radius:10px;
        display:flex; align-items:center; justify-content:center;
        font-size:1.4rem; flex-shrink:0;
    }
    .level-beginner .card-icon { background:rgba(34,197,94,.12); color:#22c55e; }
    .level-amateur  .card-icon { background:rgba(234,179,8,.12);  color:#eab308; }
    .level-pro      .card-icon { background:rgba(239,68,68,.12);  color:#ef4444; }

    .card-title { font-size:1rem; font-weight:700; color:#fff; margin:0; line-height:1.3; }
    .card-desc  { font-size:0.8rem; color:var(--clr-dim); margin:0; line-height:1.5; flex:1; }

    /* Badge level */
    .level-badge {
        display:inline-block; padding:3px 10px; border-radius:20px;
        font-size:0.7rem; font-weight:700; letter-spacing:.04em; text-transform:uppercase;
    }
    .badge-beginner { background:rgba(34,197,94,.12);  color:#22c55e; border:1px solid rgba(34,197,94,.3); }
    .badge-amateur  { background:rgba(234,179,8,.12);  color:#eab308; border:1px solid rgba(234,179,8,.3); }
    .badge-pro      { background:rgba(239,68,68,.12);  color:#ef4444; border:1px solid rgba(239,68,68,.3); }

    /* Bintang */
    .stars { display:flex; gap:4px; }
    .star  { font-size:1rem; color:#1e293b; }
    .star.lit { color:#eab308; text-shadow:0 0 6px rgba(234,179,8,.6); }

    /* Progress bar */
    .progress-wrap { width:100%; }
    .progress-label { display:flex; justify-content:space-between; margin-bottom:5px; }
    .progress-label span { font-size:0.72rem; color:var(--clr-muted); }
    .progress-label strong { font-size:0.72rem; color:var(--clr-dim); }
    .progress-track { height:5px; background:rgba(255,255,255,.06); border-radius:99px; overflow:hidden; }
    .progress-fill  { height:100%; border-radius:99px; transition:width .6s ease; }
    .level-beginner .progress-fill { background:linear-gradient(90deg,#16a34a,#22c55e); }
    .level-amateur  .progress-fill { background:linear-gradient(90deg,#b45309,#eab308); }
    .level-pro      .progress-fill { background:linear-gradient(90deg,#dc2626,#ef4444); }

    /* Card footer (aksi) */
    .card-footer {
        padding:0 20px 16px; display:flex; gap:8px; flex-wrap:wrap;
    }
    .btn-sm {
        padding:5px 14px; border-radius:7px; font-size:0.78rem; font-weight:600;
        text-decoration:none; display:inline-flex; align-items:center; gap:5px;
        transition:all .2s; cursor:pointer; border:none; font-family:inherit;
    }
    .btn-detail  { background:rgba(124,58,237,.15); color:var(--clr-purple-l); border:1px solid rgba(124,58,237,.3); }
    .btn-detail:hover  { background:rgba(124,58,237,.3); color:#fff; }
    .btn-edit    { background:rgba(59,130,246,.1);  color:#93c5fd; border:1px solid rgba(59,130,246,.25); }
    .btn-edit:hover    { background:rgba(59,130,246,.25); }
    .btn-delete  { background:rgba(239,68,68,.1);   color:#fca5a5; border:1px solid rgba(239,68,68,.25); }
    .btn-delete:hover  { background:rgba(239,68,68,.25); }
    .btn-lock    { background:rgba(234,179,8,.1);   color:#fde047; border:1px solid rgba(234,179,8,.25); }
    .btn-lock:hover    { background:rgba(234,179,8,.25); }
    .btn-unlock  { background:rgba(34,197,94,.1);   color:#86efac; border:1px solid rgba(34,197,94,.25); }
    .btn-unlock:hover  { background:rgba(34,197,94,.25); }

    /* ── LOCK OVERLAY (Siswa, materi terkunci) ── */
    .lock-overlay {
        position:absolute; inset:0; z-index:10;
        background:rgba(8,14,26,.72);
        backdrop-filter:blur(3px);
        display:flex; flex-direction:column;
        align-items:center; justify-content:center; gap:8px;
        border-radius:14px;
    }
    .lock-overlay svg { width:48px; height:48px; color:rgba(148,163,184,.5); }
    .lock-overlay span { font-size:0.8rem; color:var(--clr-muted); }

    /* ── Alert ── */
    .alert {
        margin:0 32px 16px; padding:12px 18px; border-radius:10px;
        font-size:0.87rem; font-weight:500;
    }
    .alert-success { background:rgba(34,197,94,.1); color:#86efac; border:1px solid rgba(34,197,94,.25); }
    .alert-error   { background:rgba(239,68,68,.1); color:#fca5a5; border:1px solid rgba(239,68,68,.25); }

    /* ── FAB Tambah (Super Admin) ── */
    .fab-add {
        position:fixed; bottom:32px; right:32px; z-index:100;
        width:52px; height:52px; border-radius:50%;
        background:linear-gradient(135deg,#a78bfa,#7c3aed);
        box-shadow:0 0 20px rgba(124,58,237,.6);
        color:#fff; display:flex; align-items:center; justify-content:center;
        text-decoration:none; transition:transform .2s, box-shadow .2s;
    }
    .fab-add:hover { transform:scale(1.08); box-shadow:0 0 30px rgba(124,58,237,.8); }

    /* ── Empty State ── */
    .empty-state { padding:60px 32px; text-align:center; color:var(--clr-muted); }
    .empty-state svg { width:64px; height:64px; opacity:.3; margin-bottom:16px; }
    .empty-state h3  { color:var(--clr-dim); font-size:1.1rem; margin:0 0 6px; }

    /* Modal Tambah/Edit Materi (Super Admin) */
    .modal-overlay {
        position:fixed; inset:0; background:rgba(0,0,0,.7);
        backdrop-filter:blur(4px); z-index:200;
        display:flex; align-items:center; justify-content:center; padding:16px;
    }
    .modal-box {
        background:#0f172a; border:1px solid rgba(124,58,237,.35);
        border-radius:16px; padding:28px; width:100%; max-width:560px;
        box-shadow:0 0 40px rgba(124,58,237,.2);
    }
    .modal-title { font-family:'Orbitron',sans-serif; font-size:1.1rem; color:#fff; margin:0 0 20px; }
    .form-group  { margin-bottom:14px; }
    .form-label  { display:block; font-size:0.8rem; font-weight:600; color:var(--clr-dim); margin-bottom:6px; }
    .form-ctrl {
        width:100%; padding:9px 14px; background:rgba(255,255,255,.04);
        border:1px solid rgba(99,102,241,.2); border-radius:8px;
        color:#fff; font-size:0.88rem; outline:none; font-family:inherit;
        transition:border-color .2s; box-sizing:border-box;
    }
    .form-ctrl:focus  { border-color:rgba(167,139,250,.5); }
    .form-ctrl option { background:#0f172a; }
    .btn-primary {
        padding:9px 22px; background:var(--clr-purple);
        border:none; border-radius:8px; color:#fff;
        font-size:0.88rem; font-weight:600; cursor:pointer;
        transition:background .2s; font-family:inherit;
    }
    .btn-primary:hover { background:#6d28d9; }
    .btn-ghost {
        padding:9px 22px; background:transparent;
        border:1px solid var(--clr-border); border-radius:8px;
        color:var(--clr-dim); font-size:0.88rem; cursor:pointer;
        transition:all .2s; font-family:inherit;
    }
    .btn-ghost:hover { color:#fff; border-color:rgba(167,139,250,.4); }
</style>

{{-- ── Page Header ── --}}
<div class="page-header">
    <h1 class="page-title">Pilih Materi dan Selesaikan Puzzle-nya</h1>
    <p class="page-sub">Pilih topik yang ingin kamu pelajari. Selesaikan level sebelumnya untuk membuka level berikutnya.</p>
</div>

{{-- ── Alert Flash ── --}}
@if(session('success'))
    <div class="alert alert-success" style="margin-top:16px">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-error" style="margin-top:16px">{{ session('error') }}</div>
@endif

{{-- ── Filter Bar ── --}}
<div class="filter-bar">
    <div class="filter-tabs">
        <a href="{{ route('materi.index') }}"
           class="filter-tab {{ !request('level') ? 'active' : '' }}">Semua</a>
        <a href="{{ route('materi.index', ['level' => 'beginner'] + request()->except('level')) }}"
           class="filter-tab beginner {{ request('level') === 'beginner' ? 'active' : '' }}">Beginner</a>
        <a href="{{ route('materi.index', ['level' => 'amateur'] + request()->except('level')) }}"
           class="filter-tab amateur {{ request('level') === 'amateur' ? 'active' : '' }}">Amateur</a>
        <a href="{{ route('materi.index', ['level' => 'pro'] + request()->except('level')) }}"
           class="filter-tab pro {{ request('level') === 'pro' ? 'active' : '' }}">Pro</a>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('materi.index') }}" style="display:flex">
        @if(request('level'))
            <input type="hidden" name="level" value="{{ request('level') }}">
        @endif
        <div class="search-wrap">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari Materi..." class="search-input">
            <button type="submit" class="search-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>
    </form>
</div>

{{-- ── Grid Materi ── --}}
@if($materis->isEmpty())
    <div class="empty-state">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <h3>Belum ada materi</h3>
        <p>{{ request('search') ? 'Tidak ada materi yang cocok dengan pencarianmu.' : 'Materi akan muncul di sini setelah ditambahkan.' }}</p>
    </div>
@else
<div class="materi-grid">
    @foreach($materis as $materi)
        @php
            // Apakah materi ini terkunci untuk user yang sedang login?
            $isLocked = false;
            $progress = null;
            $stars     = 0;
            $pct       = 0;

            if (Auth::user()->role === 'siswa') {
                // Terkunci jika TIDAK ada record terbuka di visibilityMap
                $isLocked = ! $visibilityMap->contains($materi->id);
                $progress  = $progressMap->get($materi->id);
                $stars     = $progress ? $progress->stars : 0;
                $pct       = $progress ? $progress->progress_percentage : 0;
            }

            // Icon default berdasarkan level jika tidak diset
            $iconMap = [
                'beginner' => '📦',
                'amateur'  => '⚡',
                'pro'      => '🔥',
            ];
            $icon = $materi->icon ?: ($iconMap[$materi->level] ?? '📘');
        @endphp

        <div class="materi-card level-{{ $materi->level }}">
            <div class="card-glow-bar"></div>

            {{-- LOCK OVERLAY – hanya tampil untuk siswa jika terkunci --}}
            @if(Auth::user()->role === 'siswa' && $isLocked)
                <div class="lock-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Materi Terkunci</span>
                </div>
            @endif

            <div class="card-body">
                <div style="display:flex; align-items:flex-start; gap:12px;">
                    <div class="card-icon">{{ $icon }}</div>
                    <div style="flex:1; min-width:0;">
                        <span class="level-badge badge-{{ $materi->level }}">{{ ucfirst($materi->level) }}</span>
                        <h3 class="card-title" style="margin-top:6px">{{ $materi->title }}</h3>
                    </div>
                </div>

                <p class="card-desc">{{ Str::limit($materi->description, 90) }}</p>

                {{-- Bintang – hanya tampil untuk siswa --}}
                @if(Auth::user()->role === 'siswa')
                    <div class="stars">
                        @for($i = 1; $i <= 3; $i++)
                            <span class="star {{ $i <= $stars ? 'lit' : '' }}">★</span>
                        @endfor
                    </div>
                @endif

                {{-- Progress Bar – siswa --}}
                @if(Auth::user()->role === 'siswa')
                    <div class="progress-wrap">
                        <div class="progress-label">
                            <span>Progress</span>
                            <strong>{{ $pct }}% Selesai</strong>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width:{{ $pct }}%"></div>
                        </div>
                    </div>
                @endif

                {{-- Status Lock Badge – guru --}}
                @if(Auth::user()->role === 'guru')
                    @php $guruLocked = $guruVisibilityMap->get($materi->id, true); @endphp
                    <div>
                        @if($guruLocked)
                            <span style="font-size:.75rem; color:#fde047; background:rgba(234,179,8,.1); padding:3px 10px; border-radius:20px; border:1px solid rgba(234,179,8,.25);">
                                🔒 Terkunci untuk Siswa
                            </span>
                        @else
                            <span style="font-size:.75rem; color:#86efac; background:rgba(34,197,94,.1); padding:3px 10px; border-radius:20px; border:1px solid rgba(34,197,94,.25);">
                                🔓 Terbuka untuk Siswa
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            {{-- ── Card Footer: Aksi berdasarkan role ── --}}
            <div class="card-footer">

                {{-- SISWA: tombol detail (hanya jika tidak terkunci) --}}
                @if(Auth::user()->role === 'siswa')
                    @if(! $isLocked)
                        <a href="{{ route('materi.show', $materi) }}" class="btn-sm btn-detail">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                            Belajar
                        </a>
                    @endif

                {{-- GURU: kelola soal + toggle lock --}}
                @elseif(Auth::user()->role === 'guru')
                    <a href="{{ route('materi.show', $materi) }}" class="btn-sm btn-detail">
                        Kelola Soal
                    </a>
                    <form method="POST" action="{{ route('materi.toggle-lock', $materi) }}" style="margin:0">
                        @csrf
                        @php $guruLocked = $guruVisibilityMap->get($materi->id, true); @endphp
                        @if($guruLocked)
                            <button type="submit" class="btn-sm btn-unlock">🔓 Buka</button>
                        @else
                            <button type="submit" class="btn-sm btn-lock">🔒 Kunci</button>
                        @endif
                    </form>

                {{-- SUPER ADMIN: detail + edit + delete --}}
                @elseif(Auth::user()->role === 'superadmin')
                    <a href="{{ route('materi.show', $materi) }}" class="btn-sm btn-detail">Detail</a>
                    <button onclick="openEditModal({{ $materi->id }}, '{{ addslashes($materi->title) }}', '{{ addslashes($materi->description) }}', '{{ $materi->level }}', {{ $materi->order_number }}, '{{ addslashes($materi->icon ?? '') }}')"
                            class="btn-sm btn-edit">✏️ Edit</button>
                    <form method="POST" action="{{ route('materi.destroy', $materi) }}" style="margin:0"
                          onsubmit="return confirm('Hapus materi {{ addslashes($materi->title) }}? Data progres siswa juga akan terhapus.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-sm btn-delete">🗑️ Hapus</button>
                    </form>
                @endif

            </div>

            <div class="card-footer">

                <!-- SISWA: Hanya bisa Belajar jika tidak terkunci -->
                @if(Auth::user()->role === 'siswa')
                    @if(! $isLocked)
                        <a href="{{ route('materi.show', $materi) }}" class="btn-sm btn-detail">🚀 Belajar</a>
                    @endif

                <!-- GURU: Kelola Soal, Toggle Lock, & Set Difficulty -->
                @elseif(Auth::user()->role === 'guru')
                    <a href="{{ route('materi.show', $materi) }}" class="btn-sm btn-detail">📝 Kelola Soal & Skor</a>

                    <!-- Toggle Lock -->
                    <form method="POST" action="{{ route('materi.toggle-lock', $materi) }}" style="margin:0">
                        @csrf
                        <button type="submit" class="btn-sm {{ $guruLocked ? 'btn-unlock' : 'btn-lock' }}">
                            {{ $guruLocked ? '🔓 Buka' : '🔒 Kunci' }}
                        </button>
                    </form>

                    <!-- Form Singkat Set Difficulty (Guru) -->
                    <form method="POST" action="{{ route('materi.update-level', $materi) }}" style="margin:0">
                        @csrf @method('PATCH')
                        <select name="level" onchange="this.form.submit()" class="btn-sm" style="background:#1e293b; color:#fff; border:1px solid var(--clr-border)">
                            <option value="beginner" {{ $materi->level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="amateur" {{ $materi->level == 'amateur' ? 'selected' : '' }}>Amateur</option>
                            <option value="pro" {{ $materi->level == 'pro' ? 'selected' : '' }}>Pro</option>
                        </select>
                    </form>

                <!-- SUPER ADMIN: Full Access (CRUD + Tests) -->
                @elseif(Auth::user()->role === 'superadmin')
                    <a href="{{ route('materi.show', $materi) }}" class="btn-sm btn-detail">👁️ Lihat & Soal</a>
                    <button onclick="openEditModal({{ $materi->id }}, '{{ addslashes($materi->title) }}', '{{ addslashes($materi->description) }}', '{{ $materi->level }}', {{ $materi->order_number }}, '{{ addslashes($materi->icon ?? '') }}')"
                            class="btn-sm btn-edit">✏️ Edit</button>
                    <form method="POST" action="{{ route('materi.destroy', $materi) }}" style="margin:0" onsubmit="return confirm('Hapus materi ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-delete">🗑️ Hapus</button>
                    </form>

                    <!-- Super Admin juga bisa Lock/Unlock -->
                    <form method="POST" action="{{ route('materi.toggle-lock', $materi) }}" style="margin:0">
                        @csrf
                        <button type="submit" class="btn-sm {{ $guruLocked ? 'btn-unlock' : 'btn-lock' }}">
                            {{ $guruLocked ? '🔓' : '🔒' }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endif

{{-- ── FAB: Tambah Materi (Super Admin only) ── --}}
@if(Auth::user()->role === 'superadmin')
    <a href="#" onclick="openAddModal(); return false;" class="fab-add" title="Tambah Materi">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
    </a>

    {{-- ── Modal Tambah Materi ── --}}
    <div id="modal-add" class="modal-overlay" style="display:none">
        <div class="modal-box">
            <h2 class="modal-title">➕ Tambah Materi Baru</h2>
            <form method="POST" action="{{ route('materi.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Judul Materi *</label>
                    <input type="text" name="title" class="form-ctrl" required placeholder="Contoh: Variabel & Tipe Data">
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Singkat *</label>
                    <input type="text" name="description" class="form-ctrl" required placeholder="Deskripsi singkat materi...">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px">
                    <div class="form-group">
                        <label class="form-label">Level *</label>
                        <select name="level" class="form-ctrl" required>
                            <option value="beginner">Beginner</option>
                            <option value="amateur">Amateur</option>
                            <option value="pro">Pro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan Tampil *</label>
                        <input type="number" name="order_number" class="form-ctrl" required value="0" min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (emoji atau path)</label>
                    <input type="text" name="icon" class="form-ctrl" placeholder="Contoh: 📦 atau variables">
                </div>
                <div class="form-group">
                    <label class="form-label">Konten Materi (HTML) *</label>
                    <textarea name="content" class="form-ctrl" rows="5" required
                              placeholder="<h2>Apa itu Variabel?</h2><p>...</p>"></textarea>
                </div>
                <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:6px">
                    <button type="button" onclick="closeAddModal()" class="btn-ghost">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Materi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── Modal Edit Materi ── --}}
    <div id="modal-edit" class="modal-overlay" style="display:none">
        <div class="modal-box">
            <h2 class="modal-title">✏️ Edit Materi</h2>
            <form method="POST" id="form-edit">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Judul Materi *</label>
                    <input type="text" name="title" id="edit-title" class="form-ctrl" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Singkat *</label>
                    <input type="text" name="description" id="edit-desc" class="form-ctrl" required>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px">
                    <div class="form-group">
                        <label class="form-label">Level *</label>
                        <select name="level" id="edit-level" class="form-ctrl" required>
                            <option value="beginner">Beginner</option>
                            <option value="amateur">Amateur</option>
                            <option value="pro">Pro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan Tampil *</label>
                        <input type="number" name="order_number" id="edit-order" class="form-ctrl" required min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Icon</label>
                    <input type="text" name="icon" id="edit-icon" class="form-ctrl">
                </div>
                <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:6px">
                    <button type="button" onclick="closeEditModal()" class="btn-ghost">Batal</button>
                    <button type="submit" class="btn-primary">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal()  { document.getElementById('modal-add').style.display='flex'; }
        function closeAddModal() { document.getElementById('modal-add').style.display='none'; }
        function closeEditModal(){ document.getElementById('modal-edit').style.display='none'; }

        function openEditModal(id, title, desc, level, order, icon) {
            document.getElementById('form-edit').action = '/materi/' + id;
            document.getElementById('edit-title').value  = title;
            document.getElementById('edit-desc').value   = desc;
            document.getElementById('edit-level').value  = level;
            document.getElementById('edit-order').value  = order;
            document.getElementById('edit-icon').value   = icon;
            document.getElementById('modal-edit').style.display = 'flex';
        }

        // Tutup modal saat klik luar
        document.querySelectorAll('.modal-overlay').forEach(el => {
            el.addEventListener('click', function(e) {
                if (e.target === this) this.style.display = 'none';
            });
        });
    </script>
@endif

</x-app-layout>

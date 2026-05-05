<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=JetBrains+Mono:wght@400;500;700&display=swap');

        .font-orbitron { font-family: 'Orbitron', sans-serif; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }

        .puzzle-bg {
            background-color: #080e1a;
            background-image:
                radial-gradient(ellipse at 20% 20%, rgba(59,130,246,0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(168,85,247,0.05) 0%, transparent 50%),
                linear-gradient(rgba(59,130,246,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.03) 1px, transparent 1px);
            background-size: auto, auto, 40px 40px, 40px 40px;
            min-height: 100vh;
        }

        /* Timer */
        .timer-display {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: #f8fafc;
            text-shadow: 0 0 20px rgba(248,250,252,0.5);
        }
        .timer-display.warning {
            color: #f97316;
            text-shadow: 0 0 20px rgba(249,115,22,0.7);
            animation: flash 0.5s infinite;
        }
        @keyframes flash { 50% { opacity: 0.5; } }

        /* Code Editor Block */
        .code-editor {
            background: #020817;
            border: 1px solid #1e293b;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }
        .code-editor::before {
            content: '●  ●  ●';
            display: block;
            padding: 8px 14px;
            font-size: 10px;
            letter-spacing: 6px;
            color: #334155;
            background: #0b1120;
            border-bottom: 1px solid #1e293b;
        }

        /* Answer Options */
        .answer-btn {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 10px;
            padding: 14px 18px;
            color: #94a3b8;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.25s ease;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
        }
        .answer-btn:hover:not(:disabled) {
            background: rgba(99,102,241,0.1);
            border-color: rgba(99,102,241,0.4);
            color: #e2e8f0;
            box-shadow: 0 0 20px rgba(99,102,241,0.15);
            transform: translateX(3px);
        }
        .answer-btn.selected {
            background: rgba(99,102,241,0.12);
            border-color: rgba(99,102,241,0.5);
            color: #a5b4fc;
        }
        .answer-btn.correct {
            background: rgba(16,185,129,0.12) !important;
            border-color: rgba(16,185,129,0.5) !important;
            color: #6ee7b7 !important;
            box-shadow: 0 0 20px rgba(16,185,129,0.2) !important;
        }
        .answer-btn.wrong {
            background: rgba(239,68,68,0.1) !important;
            border-color: rgba(239,68,68,0.4) !important;
            color: #fca5a5 !important;
        }
        .answer-btn:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .answer-label {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            flex-shrink: 0;
            background: #1e293b;
            color: #94a3b8;
            transition: all 0.25s ease;
        }
        .answer-btn:hover:not(:disabled) .answer-label,
        .answer-btn.selected .answer-label {
            background: rgba(99,102,241,0.25);
            color: #a5b4fc;
        }
        .answer-btn.correct .answer-label {
            background: rgba(16,185,129,0.3);
            color: #6ee7b7;
        }
        .answer-btn.wrong .answer-label {
            background: rgba(239,68,68,0.25);
            color: #fca5a5;
        }

        /* Hint button */
        .hint-btn {
            background: transparent;
            border: 1px solid rgba(234,179,8,0.3);
            color: #ca8a04;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .hint-btn:hover {
            background: rgba(234,179,8,0.08);
            border-color: rgba(234,179,8,0.5);
            color: #eab308;
            box-shadow: 0 0 15px rgba(234,179,8,0.15);
        }

        /* Puzzle list sidebar */
        .puzzle-sidebar {
            background: #0b1120;
            border: 1px solid #1e293b;
            border-radius: 12px;
            overflow: hidden;
        }
        .sidebar-header {
            background: #0f172a;
            border-bottom: 1px solid #1e293b;
            padding: 10px 14px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .sidebar-header:hover { background: #1e293b; }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #475569;
            transition: all 0.2s;
        }
        .sidebar-item.active-puzzle {
            color: #a5b4fc;
            background: rgba(99,102,241,0.08);
        }
        .sidebar-item.done {
            color: #34d399;
        }

        /* EXP badge */
        .exp-badge {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border: 1px solid rgba(234,179,8,0.35);
            box-shadow: 0 0 12px rgba(234,179,8,0.1);
            padding: 4px 12px;
            border-radius: 999px;
        }

        /* Result overlay */
        .result-overlay {
            position: fixed;
            inset: 0;
            z-index: 60;
            background: rgba(8,14,26,0.85);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .result-card {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 36px;
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .result-card.correct-card { border-color: rgba(16,185,129,0.4); box-shadow: 0 0 40px rgba(16,185,129,0.2); }
        .result-card.wrong-card   { border-color: rgba(239,68,68,0.35); box-shadow: 0 0 40px rgba(239,68,68,0.15); }

        /* Nav button */
        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.25s ease;
            border: 1px solid transparent;
        }
        .nav-btn-prev {
            background: #0f172a;
            border-color: #1e293b;
            color: #64748b;
        }
        .nav-btn-prev:hover {
            background: #1e293b;
            color: #94a3b8;
        }
        .nav-btn-next {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-color: rgba(96,165,250,0.4);
            color: white;
        }
        .nav-btn-next:hover {
            box-shadow: 0 0 20px rgba(59,130,246,0.4);
            transform: translateX(2px);
        }
    </style>

    {{-- Alpine.js data scope --}}
    <div class="puzzle-bg"
         x-data="{
             selectedAnswer: null,
             submitted: false,
             isCorrect: false,
             correctAnswer: '',
             resultMsg: '',
             pointsEarned: 0,
             showResult: false,
             showHint: false,
             showSidebar: true,
             totalExp: {{ $totalExp }},
             timeLeft: 120,
             timerInterval: null,
             timerWarning: false,

             startTimer() {
                 this.timerInterval = setInterval(() => {
                     if (this.timeLeft > 0 && !this.submitted) {
                         this.timeLeft--;
                         this.timerWarning = this.timeLeft <= 30;
                     } else if (this.timeLeft === 0 && !this.submitted) {
                         clearInterval(this.timerInterval);
                     }
                 }, 1000);
             },
             get timerDisplay() {
                 const m = String(Math.floor(this.timeLeft / 60)).padStart(2, '0');
                 const s = String(this.timeLeft % 60).padStart(2, '0');
                 return m + ':' + s;
             },
             async submitAnswer(huruf) {
                 if (this.submitted) return;
                 this.selectedAnswer = huruf;
                 this.submitted = true;
                 clearInterval(this.timerInterval);

                 const res = await fetch('{{ route('puzzles.jawab', $puzzle) }}', {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                         'Accept': 'application/json',
                     },
                     body: JSON.stringify({ jawaban: huruf })
                 });
                 const data = await res.json();

                 this.isCorrect     = data.benar;
                 this.correctAnswer = data.jawaban_benar;
                 this.pointsEarned  = data.points_ditambahkan;
                 this.resultMsg     = data.pesan;
                 this.totalExp      = data.total_exp;
                 this.showResult    = true;
             }
         }"
         x-init="startTimer()">

        {{-- HINT MODAL --}}
        <div x-show="showHint"
             class="fixed inset-0 z-50 flex items-center justify-center"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showHint = false"></div>

            {{-- Modal Card --}}
            <div class="relative bg-[#0f172a] border border-yellow-500/30 rounded-2xl p-8 max-w-md w-[90%] shadow-2xl"
                 style="box-shadow: 0 0 50px rgba(234,179,8,0.15);"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100">

                {{-- Close button --}}
                <button @click="showHint = false"
                        class="absolute top-4 right-4 text-slate-500 hover:text-white transition-colors w-7 h-7 flex items-center justify-center rounded-full hover:bg-slate-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-full bg-yellow-500/15 border border-yellow-500/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="font-orbitron text-yellow-400 font-bold text-base tracking-wide">
                        PETUNJUK SOAL {{ $puzzle->level }}
                    </h3>
                </div>

                <div class="bg-yellow-500/5 border border-yellow-500/20 rounded-xl p-4">
                    <p class="text-slate-300 font-mono-code text-sm leading-relaxed">
                        {{ $puzzle->petunjuk }}
                    </p>
                </div>

                @if($puzzle->kode_snippet)
                <div class="code-editor mt-4">
                    <pre class="p-4 text-green-400 font-mono-code text-xs overflow-x-auto leading-relaxed">{{ $puzzle->kode_snippet }}</pre>
                </div>
                @endif

            </div>
        </div>

        {{-- RESULT OVERLAY --}}
        <div x-show="showResult" class="result-overlay" x-cloak>
            <div class="result-card"
                 :class="{ 'correct-card': isCorrect, 'wrong-card': !isCorrect }"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-75"
                 x-transition:enter-end="opacity-100 scale-100">

                {{-- Icon --}}
                <div class="mb-4" x-show="isCorrect">
                    <div class="w-16 h-16 rounded-full bg-green-500/15 border-2 border-green-400/50 flex items-center justify-center mx-auto"
                         style="box-shadow: 0 0 30px rgba(16,185,129,0.3);">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
                <div class="mb-4" x-show="!isCorrect">
                    <div class="w-16 h-16 rounded-full bg-red-500/10 border-2 border-red-400/40 flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>

                <h3 class="font-orbitron font-bold text-lg mb-1"
                    :class="isCorrect ? 'text-green-400' : 'text-red-400'" x-text="isCorrect ? 'Jawaban Benar!' : 'Jawaban Salah!'"></h3>
                <p class="font-mono-code text-slate-400 text-xs mb-4" x-text="resultMsg"></p>

                <div x-show="isCorrect && pointsEarned > 0"
                     class="bg-green-500/10 border border-green-500/20 rounded-lg p-3 mb-5 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="font-orbitron text-yellow-400 text-sm font-bold">+<span x-text="pointsEarned"></span> EXP</span>
                </div>

                <div x-show="!isCorrect" class="bg-slate-800/60 rounded-lg p-3 mb-5">
                    <p class="font-mono-code text-slate-400 text-xs">Jawaban benar: <span class="text-green-400 font-bold" x-text="correctAnswer"></span></p>
                </div>

                <div class="flex gap-3 justify-center">
                    <button @click="showResult = false; submitted = false; selectedAnswer = null; startTimer();"
                            x-show="!isCorrect"
                            class="font-mono-code text-sm bg-slate-800 hover:bg-slate-700 text-slate-300 px-5 py-2.5 rounded-lg transition-colors border border-slate-700">
                        Coba Lagi
                    </button>

                    @if($nextPuzzle)
                    <a href="{{ route('puzzles.show', $nextPuzzle) }}" x-show="isCorrect"
                       class="font-mono-code text-sm bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-lg transition-all"
                       style="box-shadow: 0 0 15px rgba(59,130,246,0.3);">
                        Puzzle Berikutnya →
                    </a>
                    @else
                    <a href="{{ route('puzzles.index') }}" x-show="isCorrect"
                       class="font-mono-code text-sm bg-green-600 hover:bg-green-500 text-white px-5 py-2.5 rounded-lg transition-all">
                        🏆 Selesai!
                    </a>
                    @endif

                    <button @click="showResult = false"
                            class="font-mono-code text-sm bg-slate-800 hover:bg-slate-700 text-slate-300 px-5 py-2.5 rounded-lg transition-colors border border-slate-700">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        {{-- ============ HEADER ============ --}}
        <header class="sticky top-0 z-30 border-b border-slate-800/80 backdrop-blur-md bg-[#080e1a]/90">
            <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-4">

                {{-- Keluar --}}
                <a href="{{ route('puzzles.index') }}"
                   class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors font-mono-code text-sm group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Keluar
                </a>

                {{-- Timer --}}
                <div class="timer-display text-xl tracking-widest"
                     :class="{ 'warning': timerWarning }"
                     x-text="timerDisplay">02:00</div>

                {{-- EXP Badge --}}
                <div class="exp-badge flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="font-orbitron text-yellow-400 text-xs font-bold" x-text="totalExp + ' EXP'">{{ $totalExp }} EXP</span>
                </div>

            </div>
        </header>

        {{-- ============ MAIN CONTENT ============ --}}
        <div class="max-w-6xl mx-auto px-4 py-6 flex gap-6">

            {{-- ===== KOLOM KIRI: SOAL ===== --}}
            <div class="flex-1 min-w-0">

                {{-- Judul / Nama Puzzle --}}
                <h1 class="font-orbitron text-xl font-bold text-white mb-6">
                    Lorem ipsum {{-- Bisa diganti dengan nama materi --}}
                </h1>

                {{-- Card Soal --}}
                <div class="bg-[#0b1120] border border-slate-800 rounded-2xl p-6 mb-4">

                    {{-- Nomor Soal --}}
                    <div class="flex items-center gap-2 mb-4">
                        <span class="bg-indigo-500/15 border border-indigo-500/30 text-indigo-400 font-mono-code text-xs px-3 py-1 rounded-full">
                            Soal {{ $puzzle->level }}
                        </span>
                        @if($sudahSelesai)
                        <span class="bg-green-500/10 border border-green-500/30 text-green-400 font-mono-code text-xs px-3 py-1 rounded-full">
                            ✓ Sudah Diselesaikan
                        </span>
                        @endif
                    </div>

                    {{-- Pertanyaan --}}
                    <p class="text-slate-200 font-mono-code text-sm leading-relaxed mb-5">
                        {{ $puzzle->pertanyaan }}
                    </p>

                    {{-- Code Snippet --}}
                    @if($puzzle->kode_snippet)
                    <div class="code-editor mb-5">
                        <pre class="p-4 text-green-400 font-mono-code text-sm overflow-x-auto leading-relaxed">{{ $puzzle->kode_snippet }}</pre>
                    </div>
                    @endif

                    {{-- Sub-teks tambahan jika ada --}}
                    <p class="text-slate-500 font-mono-code text-xs mb-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>

                    {{-- Opsi Jawaban — Grid 2 Kolom --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach(['A' => $puzzle->opsi_a, 'B' => $puzzle->opsi_b, 'C' => $puzzle->opsi_c, 'D' => $puzzle->opsi_d] as $huruf => $opsi)
                        <button class="answer-btn"
                                :class="{
                                    'selected': selectedAnswer === '{{ $huruf }}' && !submitted,
                                    'correct': submitted && '{{ $huruf }}' === correctAnswer,
                                    'wrong': submitted && selectedAnswer === '{{ $huruf }}' && '{{ $huruf }}' !== correctAnswer
                                }"
                                :disabled="submitted"
                                @click="submitAnswer('{{ $huruf }}')">
                            <span class="answer-label">{{ $huruf }}</span>
                            <span>{{ $opsi }}</span>
                        </button>
                        @endforeach
                    </div>

                </div>

                {{-- Footer Soal: Petunjuk + Navigasi --}}
                <div class="flex items-center justify-between flex-wrap gap-3">

                    {{-- Previous --}}
                    @if($prevPuzzle)
                    <a href="{{ route('puzzles.show', $prevPuzzle) }}" class="nav-btn nav-btn-prev">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Previous
                    </a>
                    @else
                    <div></div>
                    @endif

                    {{-- Gunakan Petunjuk --}}
                    <button class="hint-btn" @click="showHint = true">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        Gunakan Petunjuk
                    </button>

                    {{-- Next --}}
                    @if($nextPuzzle)
                    <a href="{{ route('puzzles.show', $nextPuzzle) }}" class="nav-btn nav-btn-next">
                        Next
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @else
                    <a href="{{ route('puzzles.index') }}" class="nav-btn nav-btn-next">
                        Selesai
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </a>
                    @endif

                </div>
            </div>

            {{-- ===== KOLOM KANAN: SIDEBAR DAFTAR PUZZLE ===== --}}
            <div class="hidden lg:block w-64 flex-shrink-0">
                <div class="puzzle-sidebar sticky top-20">

                    {{-- Toggle Header --}}
                    <div class="sidebar-header flex items-center justify-between"
                         @click="showSidebar = !showSidebar">
                        <span class="font-orbitron text-xs text-slate-400 tracking-wider">Daftar Puzzle</span>
                        <svg class="w-4 h-4 text-slate-500 transition-transform" :class="{ 'rotate-180': !showSidebar }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    {{-- Puzzle List --}}
                    <div x-show="showSidebar" class="py-2 max-h-[70vh] overflow-y-auto">

                        {{-- Ambil semua puzzle dari controller --}}
                        @php
                            $allPuzzles = \App\Models\Puzzle::ordered()->get();
                        @endphp

                        @foreach($allPuzzles->groupBy(fn($p) => ceil($p->level / 6)) as $group => $groupPuzzles)
                            {{-- Group header (kategori materi) --}}
                            <div class="px-3 pt-3 pb-1">
                                <button class="sidebar-header w-full text-left flex items-center justify-between rounded-lg"
                                        style="border-radius:8px; padding: 6px 10px;">
                                    <span class="font-mono-code text-xs text-slate-500">▾ Variabel & Tipe Data</span>
                                    <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10"/>
                                    </svg>
                                </button>
                            </div>

                            @foreach($groupPuzzles as $p)
                            <div class="sidebar-item
                                        @if($p->id === $puzzle->id) active-puzzle
                                        @elseif(in_array($p->level, $completedLevels ?? [])) done
                                        @endif">
                                <span class="w-4 h-4 flex-shrink-0">
                                    @if(in_array($p->level, $completedLevels ?? []))
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @else
                                        <span class="w-3 h-3 rounded-full border border-slate-700 inline-block"></span>
                                    @endif
                                </span>
                                <span class="truncate">Lorem ipsum {{ $loop->iteration }}</span>
                            </div>
                            @endforeach
                        @endforeach

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-guest-layout>

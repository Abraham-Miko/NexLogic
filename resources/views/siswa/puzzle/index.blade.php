<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=JetBrains+Mono:wght@400;500;700&display=swap');

        .font-orbitron { font-family: 'Orbitron', sans-serif; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }

        /* Animated grid background */
        .puzzle-bg {
            background-color: #080e1a;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
            min-height: 100vh;
        }

        /* Node connection lines */
        .node-connector {
            position: relative;
        }
        .node-connector::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            width: 32px;
            height: 2px;
            background: linear-gradient(90deg, #334155, #1e3a5f);
            transform: translateY(-50%);
            z-index: 0;
        }
        .node-connector.completed::after {
            background: linear-gradient(90deg, #10b981, #059669);
            box-shadow: 0 0 8px rgba(16,185,129,0.5);
        }
        .node-connector.last-in-row::after {
            display: none;
        }

        /* Row connector going down */
        .row-connector-down {
            height: 40px;
            width: 2px;
            background: linear-gradient(180deg, #334155, #1e3a5f);
            margin: 0 auto;
        }
        .row-connector-down.completed {
            background: linear-gradient(180deg, #10b981, #059669);
            box-shadow: 0 0 8px rgba(16,185,129,0.5);
        }

        /* Node styles */
        .puzzle-node {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        /* Completed node */
        .node-completed {
            background: linear-gradient(135deg, #059669, #10b981);
            border: 2px solid #34d399;
            box-shadow: 0 0 20px rgba(16,185,129,0.5), 0 0 40px rgba(16,185,129,0.2);
        }

        /* Current/Active node */
        .node-current {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border: 2px solid #60a5fa;
            box-shadow: 0 0 20px rgba(59,130,246,0.6), 0 0 40px rgba(59,130,246,0.3);
            animation: pulse-blue 2s infinite;
        }

        /* Locked node */
        .node-locked {
            background: #0f172a;
            border: 2px solid #1e293b;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Hover effect for clickable nodes */
        .node-completed:hover, .node-current:hover {
            transform: scale(1.15);
        }

        @keyframes pulse-blue {
            0%, 100% { box-shadow: 0 0 20px rgba(59,130,246,0.6), 0 0 40px rgba(59,130,246,0.3); }
            50% { box-shadow: 0 0 30px rgba(59,130,246,0.9), 0 0 60px rgba(59,130,246,0.5); }
        }

        /* EXP Badge */
        .exp-badge {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border: 1px solid rgba(234,179,8,0.4);
            box-shadow: 0 0 15px rgba(234,179,8,0.15);
        }

        /* Glow text */
        .text-glow-blue {
            text-shadow: 0 0 20px rgba(59,130,246,0.8);
        }
        .text-glow-gold {
            text-shadow: 0 0 15px rgba(234,179,8,0.8);
        }
    </style>

    <div class="puzzle-bg" x-data="{ showToast: false, toastMsg: '' }">

        {{-- Toast Notifikasi --}}
        @if(session('error'))
        <div class="fixed top-4 right-4 z-50 bg-red-900/80 border border-red-500/50 text-red-200 px-6 py-3 rounded-lg backdrop-blur-sm font-mono-code text-sm"
             x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
             x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            ⚠️ {{ session('error') }}
        </div>
        @endif

        {{-- Header --}}
        <header class="sticky top-0 z-40 border-b border-slate-800/80 backdrop-blur-md bg-[#080e1a]/90">
            <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">

                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-sm font-mono-code group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                    <span class="text-slate-700">|</span>
                    <nav class="text-slate-500 text-xs font-mono-code">
                        <span>Home</span>
                        <span class="mx-2">›</span>
                        <span class="text-blue-400">Puzzles</span>
                    </nav>
                </div>

                {{-- EXP Badge --}}
                <div class="exp-badge flex items-center gap-2 px-4 py-2 rounded-full">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="font-orbitron text-yellow-400 text-sm font-bold text-glow-gold">{{ $totalExp }} EXP</span>
                </div>

            </div>
        </header>

        {{-- Konten Utama --}}
        <main class="max-w-5xl mx-auto px-4 py-10">

            {{-- Judul Halaman --}}
            <div class="text-center mb-12">
                <h1 class="font-orbitron text-3xl md:text-4xl font-black text-white mb-3 text-glow-blue">
                    Siap Memecahkan Puzzle?
                </h1>
                <p class="text-slate-400 font-mono-code text-sm max-w-lg mx-auto">
                    Jadilah juara dengan menyelesaikan setiap nomor puzzle secara berurutan
                    untuk menaklukkan materi ini dan kumpulkan EXP-mu.
                </p>

                {{-- Indikator posisi siswa --}}
                <div class="mt-4 flex items-center justify-center gap-2 text-xs font-mono-code text-slate-500">
                    <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span> Selesai
                    <span class="w-2 h-2 rounded-full bg-blue-500 inline-block ml-3 animate-pulse"></span> Saat ini
                    <span class="w-2 h-2 rounded-full bg-slate-700 inline-block ml-3"></span> Terkunci
                </div>
            </div>

            {{-- Peta Node Puzzle --}}
            @php
                $chunks = $puzzles->chunk(6); // 6 node per baris
                $chunkArr = $chunks->values();
                $totalChunks = count($chunkArr);
                $globalIndex = 0;
            @endphp

            <div class="relative">
                @foreach($chunkArr as $rowIndex => $row)
                    @php
                        $rowArr = $row->values();
                        $isReversed = $rowIndex % 2 === 1; // Baris ganjil: kanan ke kiri (zig-zag)
                        if ($isReversed) { $rowArr = $rowArr->reverse()->values(); }
                    @endphp

                    {{-- Baris Node --}}
                    <div class="flex items-center justify-center gap-4 md:gap-8">
                        @foreach($rowArr as $colIndex => $puzzle)
                            @php
                                $isCompleted  = in_array($puzzle->level, $completedLevels);
                                $isCurrent    = $puzzle->level === $nextLevel;
                                $isLocked     = $puzzle->level > $nextLevel;
                                $isLastInRow  = $colIndex === count($rowArr) - 1;
                            @endphp

                            <div class="flex flex-col items-center gap-1 relative
                                        @if(!$isLastInRow) node-connector @endif
                                        @if($isCompleted) completed @endif">

                                {{-- "You" indicator --}}
                                @if($isCurrent)
                                <div class="text-blue-400 font-mono-code text-xs animate-bounce mb-1">You</div>
                                <div class="text-blue-400 text-sm leading-none">↓</div>
                                @else
                                <div class="h-8"></div>
                                @endif

                                {{-- Node --}}
                                @if($isLocked)
                                    <div class="puzzle-node node-locked group">
                                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                @elseif($isCompleted)
                                    <a href="{{ route('puzzles.show', $puzzle) }}" class="puzzle-node node-completed group">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </a>
                                @else
                                    {{-- Current level --}}
                                    <a href="{{ route('puzzles.show', $puzzle) }}" class="puzzle-node node-current group">
                                        <span class="font-orbitron font-bold text-white text-sm">{{ $puzzle->level }}</span>
                                    </a>
                                @endif

                                {{-- Level number (di bawah node) --}}
                                <span class="font-mono-code text-xs mt-1
                                    @if($isCompleted) text-green-400
                                    @elseif($isCurrent) text-blue-400
                                    @else text-slate-600
                                    @endif">
                                    @if($isLocked)
                                        <svg class="w-3 h-3 inline" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"/>
                                        </svg>
                                    @else
                                        {{ $puzzle->level }}
                                    @endif
                                </span>

                            </div>
                        @endforeach
                    </div>

                    {{-- Konektor vertikal antar baris (zig-zag) --}}
                    @if(!$loop->last)
                    <div class="flex justify-end pr-4 md:pr-10 my-2">
                        <div class="row-connector-down @if(max($completedLevels ?? [0]) >= ($rowArr->last()->level ?? 0)) completed @endif"></div>
                    </div>
                    @endif

                @endforeach
            </div>

            {{-- Empty state --}}
            @if($puzzles->isEmpty())
            <div class="text-center py-20">
                <div class="text-slate-700 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                    </svg>
                </div>
                <p class="font-orbitron text-slate-600 text-lg">Belum ada puzzle tersedia.</p>
                <p class="font-mono-code text-slate-700 text-sm mt-2">Guru belum menambahkan puzzle untuk kelas ini.</p>
            </div>
            @endif

        </main>

    </div>
</x-guest-layout>

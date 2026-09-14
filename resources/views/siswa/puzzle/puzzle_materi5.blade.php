<x-app-layout>
    <!-- Tambahkan Polyfill agar Drag & Drop berfungsi di HP/Layar Sentuh jika ada -->
    <script src="https://unpkg.com/drag-drop-touch"></script>

    <!-- Engine Game: Materi Bab 5 (Perulangan) -->
    <div class="relative min-h-full overflow-hidden p-6 lg:p-10" x-data="gameEngine({{ $materi_id ?? 5 }}, {{ $total_skor ?? 0 }})">
        
        <!-- Background Grid -->
        <div class="absolute inset-0 pointer-events-none z-0 opacity-30" style="background-image: radial-gradient(#475569 1.5px, transparent 1.5px); background-size: 36px 36px;"></div>

        <div class="relative z-10 max-w-4xl mx-auto flex flex-col justify-center min-h-[80vh]">
            
            <div class="bg-[#1f2937] border-2 rounded-3xl w-full p-8 relative overflow-hidden transition-colors duration-300 shadow-2xl"
                 :class="{
                    'border-slate-700': status === 'playing',
                    'border-green-500 shadow-[0_0_30px_rgba(34,197,94,0.3)] bg-green-900/20': status === 'won_level',
                    'border-red-500 shadow-[0_0_30px_rgba(239,68,68,0.3)] animate-pulse bg-red-900/20': status === 'wrong_answer' || status === 'time_up',
                    'border-yellow-400 shadow-[0_0_40px_rgba(250,204,21,0.4)] bg-yellow-900/20': status === 'completed_all'
                 }">
                 
                <!-- TAMPILAN BERMAIN -->
                <div x-show="status === 'playing' || status === 'wrong_answer' || status === 'won_level'">
                    <div class="flex justify-between items-center mb-6 border-b border-slate-700 pb-4">
                        <h2 class="text-xl font-bold text-white flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#4c489d]/20 rounded-xl flex items-center justify-center text-[#4c489d] border border-[#4c489d]/30">
                                <!-- Ikon Refresh/Looping -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </div>
                            <span x-text="currentPuzzle.title"></span>
                        </h2>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-700">
                                <svg class="w-4 h-4" :class="timeLeft <= 10 ? 'text-red-400 animate-pulse' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-mono text-sm font-bold" :class="timeLeft <= 10 ? 'text-red-400' : 'text-slate-300'" x-text="formatTime(timeLeft)"></span>
                            </div>
                            <div class="text-sm font-bold text-yellow-400 bg-yellow-500/10 px-3 py-1.5 rounded-lg border border-yellow-500/20">EXP: <span x-text="totalScore"></span></div>
                            <div class="text-sm font-mono bg-slate-800 px-3 py-1.5 rounded-lg text-indigo-300 border border-slate-700">Lvl <span x-text="currentIndex + 21"></span>/25</div>
                        </div>
                    </div>

                    <div class="text-gray-400 text-sm mb-6 text-center" x-html="currentPuzzle.instruction"></div>

                    <!-- MODE KEYBOARD (COMPUTE.IT) -->
                    <template x-if="currentPuzzle.type === 'keyboard'">
                        <div class="flex flex-col items-center">
                            <div class="bg-[#111827] rounded-xl p-8 font-mono text-lg border border-slate-700 w-full mb-8 shadow-inner" x-html="currentPuzzle.code"></div>
                            
                            <!-- Indikator Progress -->
                            <div class="flex justify-center gap-3 mb-8">
                                <template x-for="(step, index) in currentPuzzle.sequence" :key="index">
                                    <div class="w-5 h-5 rounded-full border-2 transition-all duration-300 shadow-md" 
                                         :class="{'bg-[#4c489d] border-[#4c489d]': index < currentStep, 'border-slate-600 bg-slate-800': index >= currentStep && status !== 'wrong_answer', 'border-red-500 bg-red-500': index === currentStep && status === 'wrong_answer'}"></div>
                                </template>
                            </div>

                            <!-- Tombol Virtual Interaktif -->
                            <div class="flex gap-4">
                                <button @click="checkKeyboardInput('ArrowLeft')" class="w-12 h-12 bg-slate-700 hover:bg-[#4c489d] active:bg-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg transition-all active:scale-90 border border-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg></button>
                                <button @click="checkKeyboardInput('ArrowUp')" class="w-12 h-12 bg-slate-700 hover:bg-[#4c489d] active:bg-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg transition-all active:scale-90 border border-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg></button>
                                <button @click="checkKeyboardInput('ArrowDown')" class="w-12 h-12 bg-slate-700 hover:bg-[#4c489d] active:bg-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg transition-all active:scale-90 border border-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg></button>
                                <button @click="checkKeyboardInput('ArrowRight')" class="w-12 h-12 bg-slate-700 hover:bg-[#4c489d] active:bg-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg transition-all active:scale-90 border border-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></button>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- OVERLAY: MENANG 1 LEVEL -->
                <div x-show="status === 'won_level'" x-transition class="absolute inset-0 bg-green-900/95 flex flex-col items-center justify-center z-20 backdrop-blur-sm">
                    <svg class="w-20 h-20 text-green-400 mb-4 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="animation-duration: 3s;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    <h2 class="text-3xl font-bold text-white mb-2 tracking-wider">LOOP SELESAI!</h2>
                    <p class="text-green-300 mb-8 font-mono text-lg">+<span x-text="lastScore"></span> EXP (Sisa Waktu: <span x-text="timeLeft"></span>s)</p>
                    <button @click="nextLevel()" class="bg-green-500 hover:bg-green-400 text-green-900 font-bold py-3 px-10 rounded-xl shadow-lg transition-transform hover:scale-105">
                        <span x-show="currentIndex < puzzles.length - 1">Lanjut Puzzle <span x-text="currentIndex + 22"></span></span>
                        <span x-show="currentIndex === puzzles.length - 1">Lihat Hasil Akhir</span>
                    </button>
                </div>

                <!-- OVERLAY: WAKTU HABIS -->
                <div x-show="status === 'time_up'" x-cloak x-transition class="absolute inset-0 bg-red-900/95 flex flex-col items-center justify-center z-20 backdrop-blur-sm">
                    <svg class="w-20 h-20 text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h2 class="text-3xl font-bold text-white mb-2">WAKTU HABIS!</h2>
                    <p class="text-red-300 mb-6 font-mono text-lg">Skor Puzzle Ini: 0 EXP</p>
                    <button @click="nextLevel()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-transform hover:scale-105">
                        <span x-show="currentIndex < puzzles.length - 1">Lanjut Puzzle Berikutnya</span>
                        <span x-show="currentIndex === puzzles.length - 1">Lihat Hasil Akhir</span>
                    </button>
                </div>

                <!-- OVERLAY: TAMAT (SEMUA PUZZLE SELESAI) -->
                <div x-show="status === 'completed_all'" x-cloak x-transition class="flex flex-col items-center justify-center z-30 py-8">
                    <div class="w-28 h-28 bg-gradient-to-tr from-yellow-600 to-yellow-300 rounded-full flex items-center justify-center mb-6 shadow-[0_0_40px_rgba(250,204,21,0.6)] animate-bounce border-4 border-yellow-500/50">
                        <svg class="w-14 h-14 text-yellow-900" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-600 mb-2">Looping Master!</h2>
                    <p class="text-gray-400 mb-8 text-lg">Anda berhasil keluar dari putaran kode tiada henti.</p>
                    
                    <div class="bg-slate-800/80 border border-yellow-500/30 backdrop-blur-sm rounded-3xl p-6 min-w-[250px] mb-10 flex flex-col items-center shadow-[0_0_30px_rgba(250,204,21,0.1)]">
                        <p class="text-xs text-yellow-500/80 uppercase tracking-widest font-bold mb-2">Total EXP Terkumpul</p>
                        <div class="text-6xl font-black text-yellow-400 tracking-wider drop-shadow-[0_0_15px_rgba(250,204,21,0.5)] flex items-end gap-2">
                            <span x-text="totalScore"></span> <span class="text-2xl text-yellow-600 font-bold mb-2">/ 500</span>
                        </div>
                    </div>

                    <form action="{{ route('puzzle.materi.submit', ['id' => 5]) }}" method="POST" class="flex flex-col items-center">
                        @csrf 
                        <input type="hidden" name="skor_total" :value="totalScore">
                        
                        <button type="submit" class="bg-gradient-to-r from-[#4c489d] to-indigo-600 hover:from-indigo-500 hover:to-blue-500 text-white font-bold py-4 px-10 rounded-full shadow-[0_0_20px_rgba(76,72,157,0.5)] transition-all hover:scale-105 hover:shadow-[0_0_30px_rgba(76,72,157,0.7)] flex items-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Klaim Skor & Kembali ke Map
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('gameEngine', (materiId, initialScore) => ({
                currentIndex: 0,
                currentStep: 0,
                status: 'playing', 
                totalScore: 0,
                lastScore: 0,
                
                timeLeft: 60,
                timerInterval: null,
                kesalahan: 0,

                get currentPuzzle() {
                    return this.puzzles[this.currentIndex];
                },

                // DATABASE PUZZLE (BAB 5: PERULANGAN)
                puzzles: [
                    {
                        type: 'keyboard',
                        title: 'Puzzle 21: For Loop Dasar',
                        instruction: 'Berapa kali program ini akan mencetak arah? Tekan panah yang sesuai secara berurutan!',
                        sequence: ['ArrowRight', 'ArrowRight', 'ArrowRight'],
                        code: `
                            <span class="text-pink-500">for</span> (<span class="text-pink-500">let</span> i = <span class="text-orange-400">0</span>; i < <span class="text-orange-400">3</span>; i++) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KANAN"</span>);<br>
                            }
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 22: While Loop (Mundur)',
                        instruction: 'Perhatikan kondisi <code class="bg-slate-700 px-1 rounded text-orange-400">x > 0</code> dan <code class="bg-slate-700 px-1 rounded text-orange-400">x--</code> (dikurangi 1). Lacak sampai loop berhenti!',
                        sequence: ['ArrowDown', 'ArrowDown', 'ArrowDown'],
                        code: `
                            <span class="text-pink-500">let</span> x = <span class="text-orange-400">3</span>;<br><br>
                            <span class="text-pink-500">while</span> (x > <span class="text-orange-400">0</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"BAWAH"</span>);<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;x--; <span class="text-gray-500">// Nilai x berkurang 1 setiap putaran</span><br>
                            }
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 23: Loop + If Else',
                        instruction: 'Gabungan! Cek apakah <code class="bg-slate-700 px-1 rounded">i</code> itu ganjil atau genap menggunakan modulo (<code class="bg-slate-700 px-1 rounded">% 2</code>). Ikuti alurnya dari i=1 sampai i=3!',
                        sequence: ['ArrowLeft', 'ArrowRight', 'ArrowLeft'],
                        code: `
                            <span class="text-pink-500">for</span> (<span class="text-pink-500">let</span> i = <span class="text-orange-400">1</span>; i <= <span class="text-orange-400">3</span>; i++) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-pink-500">if</span> (i % <span class="text-orange-400">2</span> == <span class="text-orange-400">0</span>) { <span class="text-gray-500">// Jika Genap</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KANAN"</span>);<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;} <span class="text-pink-500">else</span> { <span class="text-gray-500">// Jika Ganjil</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KIRI"</span>);<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            }
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 24: Rem Darurat (Break)',
                        instruction: 'Perintah <code class="bg-slate-700 px-1 rounded text-red-400">break</code> akan langsung MENGHANCURKAN perulangan tanpa sisa. Lacak sampai loop ini pecah!',
                        sequence: ['ArrowUp', 'ArrowUp'],
                        code: `
                            <span class="text-pink-500">for</span> (<span class="text-pink-500">let</span> i = <span class="text-orange-400">1</span>; i <= <span class="text-orange-400">5</span>; i++) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-pink-500">if</span> (i == <span class="text-orange-400">3</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-pink-500">break</span>; <span class="text-gray-500">// HENTIKAN LOOP SEKARANG!</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"ATAS"</span>);<br>
                            }
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 25: BOSS - Nested Loop',
                        instruction: 'Ada Loop di dalam Loop! Untuk setiap 1 putaran <code class="bg-slate-700 px-1 rounded">i</code>, putaran <code class="bg-slate-700 px-1 rounded">j</code> akan diselesaikan secara penuh.',
                        sequence: ['ArrowRight', 'ArrowRight', 'ArrowRight', 'ArrowRight'],
                        code: `
                            <span class="text-pink-500">for</span> (<span class="text-pink-500">let</span> i = <span class="text-orange-400">0</span>; i < <span class="text-orange-400">2</span>; i++) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-pink-500">for</span> (<span class="text-pink-500">let</span> j = <span class="text-orange-400">0</span>; j < <span class="text-orange-400">2</span>; j++) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KANAN"</span>);<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            }
                        `
                    }
                ],

                init() {
                    this.startTimer();
                    window.addEventListener('keydown', (e) => {
                        if (this.status !== 'playing' || this.currentPuzzle.type !== 'keyboard') return;
                        const validKeys = ['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'];
                        if(validKeys.includes(e.key)) { 
                            e.preventDefault(); 
                            this.checkKeyboardInput(e.key); 
                        }
                    });
                },

                formatTime(seconds) {
                    const m = Math.floor(seconds / 60).toString().padStart(2, '0');
                    const s = (seconds % 60).toString().padStart(2, '0');
                    return `${m}:${s}`;
                },

                startTimer() {
                    this.timeLeft = 60;
                    this.kesalahan = 0;
                    clearInterval(this.timerInterval);
                    
                    this.timerInterval = setInterval(() => {
                        if(this.status === 'playing' || this.status === 'wrong_answer') {
                            if(this.timeLeft > 0) {
                                this.timeLeft--;
                            } else {
                                this.status = 'time_up';
                                clearInterval(this.timerInterval);
                            }
                        }
                    }, 1000);
                },

                checkKeyboardInput(inputKey) {
                    const seq = this.currentPuzzle.sequence;
                    if(inputKey === seq[this.currentStep]) {
                        this.currentStep++;
                        if(this.currentStep === seq.length) {
                            this.triggerWin();
                        }
                    } else { 
                        this.triggerFail(1); 
                    }
                },

                triggerWin() {
                    clearInterval(this.timerInterval);
                    
                    let calcScore = Math.floor(100 * (this.timeLeft / 60)) - (this.kesalahan * 10);
                    if (calcScore < 0) calcScore = 0;
                    if (calcScore > 100) calcScore = 100;
                    if (calcScore < 15) calcScore = 15;

                    this.lastScore = calcScore;
                    this.totalScore += calcScore;
                    this.status = 'won_level';
                },

                triggerFail(jumlahSalah) {
                    this.kesalahan += jumlahSalah;
                    this.timeLeft = Math.max(1, this.timeLeft - (jumlahSalah * 5));
                    
                    this.status = 'wrong_answer';
                    setTimeout(() => { 
                        if(this.status === 'wrong_answer') {
                            this.status = 'playing'; 
                            this.currentStep = 0; 
                        }
                    }, 800);
                },

                nextLevel() {
                    if (this.currentIndex < this.puzzles.length - 1) { 
                        this.currentIndex++; 
                        this.currentStep = 0; 
                        this.status = 'playing'; 
                        this.startTimer();
                    } else { 
                        this.status = 'completed_all'; 
                    }
                }
            }));
        });
    </script>
</x-app-layout>
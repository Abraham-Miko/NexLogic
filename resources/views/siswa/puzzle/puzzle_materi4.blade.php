<x-app-layout>
    <!-- Tambahkan Polyfill agar Drag & Drop berfungsi di HP/Layar Sentuh jika ada -->
    <script src="https://unpkg.com/drag-drop-touch"></script>

    <!-- Engine Game: Materi Bab 4 -->
    <div class="relative min-h-full overflow-hidden p-6 lg:p-10" x-data="gameEngine({{ $materi_id ?? 4 }}, {{ $total_skor ?? 0 }})">
        
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
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                            </div>
                            <span x-text="currentPuzzle.title"></span>
                        </h2>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-700">
                                <svg class="w-4 h-4" :class="timeLeft <= 10 ? 'text-red-400 animate-pulse' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-mono text-sm font-bold" :class="timeLeft <= 10 ? 'text-red-400' : 'text-slate-300'" x-text="formatTime(timeLeft)"></span>
                            </div>
                            <div class="text-sm font-bold text-yellow-400 bg-yellow-500/10 px-3 py-1.5 rounded-lg border border-yellow-500/20">EXP: <span x-text="totalScore"></span></div>
                            <div class="text-sm font-mono bg-slate-800 px-3 py-1.5 rounded-lg text-indigo-300 border border-slate-700">Lvl <span x-text="currentIndex + 16"></span>/20</div>
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
                    <svg class="w-20 h-20 text-green-400 mb-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h2 class="text-3xl font-bold text-white mb-2 tracking-wider">COMPUTED!</h2>
                    <p class="text-green-300 mb-8 font-mono text-lg">+<span x-text="lastScore"></span> EXP (Sisa Waktu: <span x-text="timeLeft"></span>s)</p>
                    <button @click="nextLevel()" class="bg-green-500 hover:bg-green-400 text-green-900 font-bold py-3 px-10 rounded-xl shadow-lg transition-transform hover:scale-105">
                        <span x-show="currentIndex < puzzles.length - 1">Lanjut Puzzle <span x-text="currentIndex + 17"></span></span>
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
                    <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-600 mb-2">Logika Bercabang Selesai!</h2>
                    <p class="text-gray-400 mb-8 text-lg">Anda telah menaklukkan materi If-Else.</p>
                    
                    <div class="bg-slate-800/80 border border-yellow-500/30 backdrop-blur-sm rounded-3xl p-6 min-w-[250px] mb-10 flex flex-col items-center shadow-[0_0_30px_rgba(250,204,21,0.1)]">
                        <p class="text-xs text-yellow-500/80 uppercase tracking-widest font-bold mb-2">Total EXP Terkumpul</p>
                        <div class="text-6xl font-black text-yellow-400 tracking-wider drop-shadow-[0_0_15px_rgba(250,204,21,0.5)] flex items-end gap-2">
                            <span x-text="totalScore"></span> <span class="text-2xl text-yellow-600 font-bold mb-2">/ 500</span>
                        </div>
                    </div>

                    <form action="{{ route('puzzle.materi.submit', ['id' => 4]) }}" method="POST" class="flex flex-col items-center">
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

                // DATABASE PUZZLE (BAB 4: PERCABANGAN IF-ELSE)
                puzzles: [
                    {
                        type: 'keyboard',
                        title: 'Puzzle 16: If-Else Dasar',
                        instruction: 'Baca nilai KKM-nya. Apakah siswa ini Lulus atau Remedial?<br><br><span class="text-red-400 font-bold">Kiri = REMEDIAL</span> &nbsp;|&nbsp; <span class="text-blue-400 font-bold">Kanan = LULUS</span>',
                        sequence: ['ArrowRight'],
                        code: `
                            <span class="text-pink-500">let</span> nilai = <span class="text-orange-400">80</span>;<br><br>
                            <span class="text-pink-500">if</span> (nilai >= <span class="text-orange-400">75</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KANAN"</span>);<br>
                            } <span class="text-pink-500">else</span> {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KIRI"</span>);<br>
                            }
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 17: Dua If Berurutan',
                        instruction: 'Hati-hati! Ini bukan If-Else, melainkan dua kondisi <code class="bg-slate-700 px-1 rounded">if</code> yang berdiri sendiri. Ikuti alurnya eksekusinya berurutan!',
                        sequence: ['ArrowUp', 'ArrowRight'],
                        code: `
                            <span class="text-pink-500">let</span> x = <span class="text-orange-400">5</span>;<br><br>
                            <span class="text-pink-500">if</span> (x > <span class="text-orange-400">0</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"ATAS"</span>);<br>
                            }<br><br>
                            <span class="text-pink-500">if</span> (x == <span class="text-orange-400">5</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KANAN"</span>);<br>
                            }
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 18: If-Else-If (Lampu Lalu Lintas)',
                        instruction: 'Sistem mengecek dari atas ke bawah. Blok mana yang akan dieksekusi?<br><br><span class="text-white font-bold">Atas = BERHENTI &nbsp;|&nbsp; Bawah = HATI-HATI &nbsp;|&nbsp; Kanan = JALAN</span>',
                        sequence: ['ArrowDown'],
                        code: `
                            <span class="text-pink-500">let</span> lampu = <span class="text-green-400">"Kuning"</span>;<br><br>
                            <span class="text-pink-500">if</span> (lampu == <span class="text-green-400">"Merah"</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"ATAS"</span>);<br>
                            } <span class="text-pink-500">else if</span> (lampu == <span class="text-green-400">"Kuning"</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"BAWAH"</span>);<br>
                            } <span class="text-pink-500">else</span> {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KANAN"</span>);<br>
                            }
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 19: Nested If (If Bersarang)',
                        instruction: 'Ada kondisi <code class="bg-slate-700 px-1 rounded">if</code> di dalam <code class="bg-slate-700 px-1 rounded">if</code>! Lacak masuk ke pintu mana saja program ini berjalan.',
                        sequence: ['ArrowRight'],
                        code: `
                            <span class="text-pink-500">let</span> member = <span class="text-orange-400">true</span>;<br>
                            <span class="text-pink-500">let</span> voucher = <span class="text-orange-400">false</span>;<br><br>
                            <span class="text-pink-500">if</span> (member) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-pink-500">if</span> (voucher) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KIRI"</span>);<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;} <span class="text-pink-500">else</span> {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KANAN"</span>);<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            } <span class="text-pink-500">else</span> {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"BAWAH"</span>);<br>
                            }
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 20: BOSS - Logika && (AND)',
                        instruction: 'Hanya jika KEDUA syarat terpenuhi, aksi akan dijalankan. Apakah orang ini bisa membuat SIM?<br><br><span class="text-red-400 font-bold">Kiri = GAGAL</span> &nbsp;|&nbsp; <span class="text-blue-400 font-bold">Kanan = BISA</span>',
                        sequence: ['ArrowLeft'],
                        code: `
                            <span class="text-pink-500">let</span> umur = <span class="text-orange-400">17</span>;<br>
                            <span class="text-pink-500">let</span> lulusUjian = <span class="text-orange-400">false</span>;<br><br>
                            <span class="text-gray-500">// && artinya AND (Keduanya harus true)</span><br>
                            <span class="text-pink-500">if</span> (umur >= <span class="text-orange-400">17</span> && lulusUjian == <span class="text-orange-400">true</span>) {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KANAN"</span>);<br>
                            } <span class="text-pink-500">else</span> {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">cetak</span>(<span class="text-green-400">"KIRI"</span>);<br>
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
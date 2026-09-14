<x-app-layout>
    <script src="https://unpkg.com/drag-drop-touch"></script>

    <div class="relative min-h-full overflow-hidden p-6 lg:p-10" x-data="gameEngine({{ $materi_id ?? 3 }}, {{ $total_skor ?? 0 }})">
        
        <!-- Background Grid Titik-titik -->
        <div class="absolute inset-0 pointer-events-none z-0 opacity-30" 
             style="background-image: radial-gradient(#475569 1.5px, transparent 1.5px); background-size: 36px 36px;"></div>

        <div class="relative z-10 max-w-4xl mx-auto flex flex-col justify-center min-h-[80vh]">
            
            <div class="bg-[#1f2937] border-2 rounded-3xl w-full p-8 relative overflow-hidden transition-colors duration-300 shadow-2xl"
                 :class="{
                    'border-slate-700': status === 'playing',
                    'border-green-500 shadow-[0_0_30px_rgba(34,197,94,0.3)] bg-green-900/20': status === 'won_level',
                    'border-red-500 shadow-[0_0_30px_rgba(239,68,68,0.3)] animate-pulse bg-red-900/20': status === 'wrong_answer' || status === 'time_up',
                    'border-yellow-400 shadow-[0_0_40px_rgba(250,204,21,0.4)] bg-yellow-900/20': status === 'completed_all'
                 }">
                 
                <!-- TAMPILAN SAAT SEDANG BERMAIN -->
                <div x-show="status === 'playing' || status === 'wrong_answer' || status === 'won_level'">
                    
                    <div class="flex justify-between items-center mb-6 border-b border-slate-700 pb-4">
                        <h2 class="text-xl font-bold text-white flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#4c489d]/20 rounded-xl flex items-center justify-center text-[#4c489d] border border-[#4c489d]/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span x-text="currentPuzzle.title"></span>
                        </h2>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-700">
                                <svg class="w-4 h-4" :class="timeLeft <= 10 ? 'text-red-400 animate-pulse' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-mono text-sm font-bold" :class="timeLeft <= 10 ? 'text-red-400' : 'text-slate-300'" x-text="formatTime(timeLeft)"></span>
                            </div>
                            <div class="text-sm font-bold text-yellow-400 bg-yellow-500/10 px-3 py-1.5 rounded-lg border border-yellow-500/20">
                                EXP: <span x-text="totalScore"></span>
                            </div>
                            <div class="text-sm font-mono bg-slate-800 px-3 py-1.5 rounded-lg text-indigo-300 border border-slate-700">
                                Lvl <span x-text="currentIndex + 11"></span>/15
                            </div>
                        </div>
                    </div>

                    <div class="text-gray-400 text-sm mb-6 text-center" x-html="currentPuzzle.instruction"></div>

                    <!-- MODE 1: KEYBOARD -->
                    <template x-if="currentPuzzle.type === 'keyboard'">
                        <div class="flex flex-col items-center">
                            <div class="bg-[#111827] rounded-xl p-8 font-mono text-lg border border-slate-700 w-full mb-8 shadow-inner"
                                 x-html="currentPuzzle.code">
                            </div>

                            <div class="flex justify-center gap-3 mb-8">
                                <template x-for="(step, index) in currentPuzzle.sequence" :key="index">
                                    <div class="w-5 h-5 rounded-full border-2 transition-all duration-300 shadow-md"
                                         :class="{
                                            'bg-[#4c489d] border-[#4c489d]': index < currentStep,
                                            'border-slate-600 bg-slate-800': index >= currentStep && status !== 'wrong_answer',
                                            'border-red-500 bg-red-500': index === currentStep && status === 'wrong_answer'
                                         }">
                                    </div>
                                </template>
                            </div>

                            <div class="flex gap-4">
                                <button @click="checkKeyboardInput('ArrowLeft')" class="w-12 h-12 bg-slate-700 hover:bg-[#4c489d] active:bg-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg transition-all active:scale-90 border border-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg></button>
                                <button @click="checkKeyboardInput('ArrowUp')" class="w-12 h-12 bg-slate-700 hover:bg-[#4c489d] active:bg-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg transition-all active:scale-90 border border-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg></button>
                                <button @click="checkKeyboardInput('ArrowDown')" class="w-12 h-12 bg-slate-700 hover:bg-[#4c489d] active:bg-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg transition-all active:scale-90 border border-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg></button>
                                <button @click="checkKeyboardInput('ArrowRight')" class="w-12 h-12 bg-slate-700 hover:bg-[#4c489d] active:bg-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg transition-all active:scale-90 border border-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg></button>
                            </div>
                        </div>
                    </template>

                    <!-- MODE 2: DRAG AND DROP -->
                    <template x-if="currentPuzzle.type === 'dragdrop'">
                        <div class="flex flex-col items-center">
                            
                            <div class="flex flex-col gap-4 w-full max-w-lg mb-8">
                                <template x-for="(q, index) in currentPuzzle.questions" :key="index">
                                    <div class="flex items-center justify-between text-2xl font-mono text-white bg-slate-800/50 p-4 rounded-xl border border-slate-700">
                                        <div class="flex-1 text-right text-pink-400" x-text="q.left"></div>
                                        
                                        <div class="w-20 h-14 mx-4 border-2 border-dashed rounded-lg flex items-center justify-center transition-colors shadow-inner bg-[#111827]"
                                             :class="q.current ? 'border-yellow-400 text-yellow-400' : 'border-gray-500 text-gray-500 hover:border-indigo-400'"
                                             @dragover.prevent=""
                                             @drop="q.current = draggedValue; draggedValue = null"
                                             @click="q.current = null" title="Klik untuk menghapus">
                                            <span x-show="q.current" x-text="q.current" class="font-bold text-sm drop-shadow-[0_0_8px_rgba(250,204,21,0.5)]"></span>
                                        </div>
                                        
                                        <div class="flex-1 text-left text-blue-400" x-text="q.right"></div>
                                    </div>
                                </template>
                            </div>

                            <div class="bg-[#111827] p-5 rounded-2xl border border-slate-700 w-full mb-6">
                                <p class="text-xs text-gray-500 uppercase font-bold mb-3 text-center tracking-widest">Toolbox Perintah & Variabel</p>
                                <div class="flex justify-center gap-3 flex-wrap">
                                    <template x-for="tool in currentPuzzle.toolbox" :key="tool">
                                        <div class="px-4 h-14 bg-indigo-600 hover:bg-indigo-500 text-white font-mono font-bold text-xl rounded-xl flex items-center justify-center cursor-grab active:cursor-grabbing shadow-[0_5px_0_#3730a3] active:shadow-[0_0px_0_#3730a3] active:translate-y-[5px] transition-all"
                                             draggable="true"
                                             @dragstart="onDragStart($event, tool)">
                                            <span x-text="tool"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <button @click="checkDndAnswer()" class="bg-[#4c489d] hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold shadow-lg transition-transform hover:scale-105 w-full max-w-sm">
                                Validasi Jawaban
                            </button>
                        </div>
                    </template>
                </div>

                <!-- OVERLAY: MENANG 1 LEVEL -->
                <div x-show="status === 'won_level'" x-transition class="absolute inset-0 bg-green-900/95 flex flex-col items-center justify-center z-20 backdrop-blur-sm">
                    <svg class="w-20 h-20 text-green-400 mb-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h2 class="text-3xl font-bold text-white mb-2 tracking-wider">COMPUTED!</h2>
                    <p class="text-green-300 mb-8 font-mono text-lg">+<span x-text="lastScore"></span> EXP (Sisa Waktu: <span x-text="timeLeft"></span>s)</p>
                    <button @click="nextLevel()" class="bg-green-500 hover:bg-green-400 text-green-900 font-bold py-3 px-10 rounded-xl shadow-lg transition-transform hover:scale-105">
                        <span x-show="currentIndex < puzzles.length - 1">Lanjut Puzzle <span x-text="currentIndex + 12"></span></span>
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
                    <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-600 mb-2">I/O Master!</h2>
                    <p class="text-gray-400 mb-8 text-lg">Anda telah menguasai aliran data Input & Output.</p>
                    
                    <div class="bg-slate-800/80 border border-yellow-500/30 backdrop-blur-sm rounded-3xl p-6 min-w-[250px] mb-10 flex flex-col items-center shadow-[0_0_30px_rgba(250,204,21,0.1)]">
                        <p class="text-xs text-yellow-500/80 uppercase tracking-widest font-bold mb-2">Total EXP Terkumpul</p>
                        <div class="text-6xl font-black text-yellow-400 tracking-wider drop-shadow-[0_0_15px_rgba(250,204,21,0.5)] flex items-end gap-2">
                            <span x-text="totalScore"></span> <span class="text-2xl text-yellow-600 font-bold mb-2">/ 500</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('puzzle.materi.submit', ['id' => 3]) }}" method="POST" class="flex flex-col items-center">
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

    <!-- SCRIPT HYBRID ENGINE -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('gameEngine', (materiId, initialScore) => ({
                currentIndex: 0,
                currentStep: 0,
                status: 'playing', // playing, wrong_answer, won_level, time_up, completed_all
                totalScore: 0,
                lastScore: 0,
                
                timeLeft: 60,
                timerInterval: null,
                kesalahan: 0,

                draggedValue: null,

                get currentPuzzle() {
                    return this.puzzles[this.currentIndex];
                },

                // DATABASE PUZZLE I/O
                puzzles: [
                    {
                        type: 'keyboard',
                        title: 'Puzzle 11: Radar Perintah',
                        instruction: 'Pilah fungsi di bawah ini:<br><span class="text-red-400 font-bold">Kiri = Baca Data (Input)</span> &nbsp;|&nbsp; <span class="text-blue-400 font-bold">Kanan = Cetak Teks (Output)</span>',
                        sequence: ['ArrowRight', 'ArrowLeft', 'ArrowRight'],
                        code: `
                            <div class="flex flex-col gap-5 items-center text-xl font-bold">
                                <div><span class="text-pink-500">1. </span> console.log(<span class="text-green-400">"Halo"</span>);</div>
                                <div><span class="text-pink-500">2. </span> input(<span class="text-green-400">"Umur?"</span>);</div>
                                <div><span class="text-pink-500">3. </span> print(<span class="text-green-400">"Selesai"</span>);</div>
                            </div>
                        `
                    },
                    {
                        type: 'dragdrop',
                        title: 'Puzzle 12: Melengkapi Mesin',
                        instruction: 'Tarik perintah yang tepat agar program ini bisa menanyakan nama lalu menyapanya!',
                        toolbox: ['cetak', 'input'],
                        questions: [
                            { left: 'let nama = ', right: '("Siapa namamu?");', answer: 'input', current: null },
                            { left: '', right: '("Halo, " + nama);', answer: 'cetak', current: null }
                        ]
                    },
                    {
                        type: 'dragdrop',
                        title: 'Puzzle 13: Perakit Output',
                        instruction: 'Susun variabel ke dalam kalimat (Konkatenasi).<br><span class="text-sm text-yellow-500">Target Layar: "Siswa Fuad berumur 20"</span>',
                        toolbox: ['nama', 'umur'],
                        questions: [
                            { left: 'cetak("Siswa " + ', right: ' + ', answer: 'nama', current: null },
                            { left: '" berumur " + ', right: ');', answer: 'umur', current: null }
                        ]
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 14: Tracing I/O Flow',
                        instruction: 'Lacak urutan Input & Output pada kode ini!<br><span class="text-red-400 font-bold">Kiri = Meminta Ketikan User</span> &nbsp;|&nbsp; <span class="text-blue-400 font-bold">Kanan = Muncul di Layar</span>',
                        sequence: ['ArrowRight', 'ArrowLeft', 'ArrowRight'],
                        code: `
                            <div class="text-left inline-block">
                                <span class="text-blue-400">cetak</span>(<span class="text-green-400">"Mulai Program"</span>);<br><br>
                                <span class="text-pink-500">let</span> data = <span class="text-orange-400">input</span>();<br><br>
                                <span class="text-blue-400">cetak</span>(<span class="text-green-400">"Data diterima"</span>);
                            </div>
                        `
                    },
                    {
                        type: 'keyboard',
                        title: 'Puzzle 15: BOSS - Jebakan Input',
                        instruction: 'User mengetik angka 5 di keyboard. Apa output akhirnya?<br><br><span class="text-red-400 font-bold">Kiri = Error</span> &nbsp;|&nbsp; <span class="text-white font-bold">Atas = 7</span> &nbsp;|&nbsp; <span class="text-white font-bold">Bawah = "52"</span>',
                        sequence: ['ArrowDown'],
                        code: `
                            <div class="text-left inline-block">
                                <span class="text-gray-500">// Ingat! Input dari keyboard otomatis menjadi Teks (String)!</span><br>
                                <span class="text-pink-500">let</span> a = <span class="text-orange-400">input</span>(<span class="text-green-400">"Ketik Angka: "</span>); <span class="text-gray-500">// User ketik 5</span><br>
                                <span class="text-pink-500">let</span> b = <span class="text-purple-400">2</span>;<br><br>
                                <span class="text-blue-400">cetak</span>(a + b);
                            </div>
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

                onDragStart(event, value) {
                    this.draggedValue = value;
                    event.dataTransfer.effectAllowed = 'copy';
                },

                checkDndAnswer() {
                    const qs = this.currentPuzzle.questions;
                    
                    const isEmpty = qs.some(q => q.current === null);
                    if (isEmpty) {
                        alert("Harap isi semua kotak kosong terlebih dahulu!");
                        return;
                    }

                    const jumlahSalah = qs.filter(q => q.current !== q.answer).length;
                    
                    if (jumlahSalah === 0) {
                        this.triggerWin();
                    } else {
                        this.triggerFail(jumlahSalah);
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
                            if(this.currentPuzzle.questions) {
                                this.currentPuzzle.questions.forEach(q => q.current = null);
                            }
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
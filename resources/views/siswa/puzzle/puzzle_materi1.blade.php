<x-app-layout>
    <div class="p-6 lg:p-10 flex justify-center items-center min-h-[85vh] bg-[#0b1120]" 
         x-data="dragDropGame()">
        
        <!-- Kontainer Game -->
        <div class="bg-[#1f2937] border-2 rounded-2xl w-full max-w-3xl p-8 relative overflow-hidden transition-colors duration-300 shadow-2xl"
             :class="{
                'border-slate-700': status === 'playing',
                'border-green-500 shadow-[0_0_30px_rgba(34,197,94,0.3)] bg-green-900/20': status === 'won_level',
                'border-red-500 shadow-[0_0_30px_rgba(239,68,68,0.3)] animate-pulse bg-red-900/20': status === 'failed',
                'border-yellow-400 shadow-[0_0_40px_rgba(250,204,21,0.4)] bg-yellow-900/20': status === 'completed_all'
             }">
             
            <!-- TAMPILAN SAAT SEDANG BERMAIN -->
            <div x-show="status === 'playing' || status === 'failed' || status === 'won_level'">
                <!-- Header Status -->
                <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#4c489d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path></svg>
                        <span x-text="puzzles[currentIndex].title"></span>
                    </h2>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-700">
                            <svg class="w-4 h-4" :class="timeLeft <= 10 ? 'text-red-400 animate-pulse' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-mono text-sm font-bold" :class="timeLeft <= 10 ? 'text-red-400' : 'text-slate-300'" x-text="formatTime(timeLeft)"></span>
                        </div>
                        <div class="text-sm font-bold text-yellow-400">Skor: <span x-text="totalScore"></span></div>
                        <div class="text-sm font-mono bg-slate-800 px-3 py-1.5 rounded-lg text-indigo-300 border border-slate-700">
                            Level <span x-text="currentIndex + 1"></span>/5
                        </div>
                    </div>
                </div>

                <p class="text-gray-400 mb-8 text-sm" x-text="puzzles[currentIndex].description"></p>

                <!-- ZONA DROP (KERANJANG TIPE DATA) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    <template x-for="zona in puzzles[currentIndex].targetZones" :key="zona.id">
                        
                        <!-- Kotak Keranjang -->
                        <div class="border-2 border-dashed rounded-xl p-4 min-h-[140px] flex flex-col items-center transition-colors bg-slate-800/50"
                             :class="dragOverZone === zona.id ? 'border-[#4c489d] bg-[#4c489d]/10' : 'border-slate-600'"
                             @dragover.prevent="dragOverZone = zona.id"
                             @dragleave.prevent="dragOverZone = null"
                             @drop="onDrop($event, zona.id)">
                            
                            <!-- Judul Keranjang -->
                            <h3 class="font-bold text-gray-300 mb-4 tracking-wider" x-text="zona.nama"></h3>
                            
                            <!-- Tempat item yang sudah didrop -->
                            <div class="w-full flex flex-col gap-2">
                                <template x-for="item in getItemsInZone(zona.id)" :key="item.id">
                                    <div class="bg-indigo-900/50 border border-indigo-500 text-indigo-200 py-2 px-4 rounded-lg text-center font-mono text-sm cursor-grab active:cursor-grabbing"
                                         draggable="true"
                                         @dragstart="onDragStart($event, item.id)">
                                        <span x-text="item.text"></span>
                                    </div>
                                </template>
                            </div>
                            
                        </div>
                    </template>
                </div>

                <!-- ZONA ITEM (GUDANG NILAI YANG BELUM DISORTIR) -->
                <div class="bg-[#111827] rounded-xl p-6 border border-slate-700 shadow-inner min-h-[100px] relative">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-xs text-gray-500 uppercase tracking-widest font-bold">Nilai yang tersedia:</h4>
                        <button @click="cekJawaban()" :disabled="status !== 'playing'" class="bg-[#4c489d] hover:bg-indigo-500 text-white px-5 py-2 rounded-lg font-bold transition disabled:opacity-50 disabled:cursor-not-allowed text-sm shadow-lg">
                            Cek Jawaban
                        </button>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 min-h-[50px]"
                         @dragover.prevent="dragOverZone = 'gudang'"
                         @dragleave.prevent="dragOverZone = null"
                         @drop="onDrop($event, 'gudang')">
                         
                        <!-- Render item yang masih di gudang -->
                        <template x-for="item in getItemsInZone('gudang')" :key="item.id">
                            <div class="bg-slate-700 border border-slate-600 hover:border-slate-400 text-white py-2 px-5 rounded-lg text-center font-mono text-sm cursor-grab active:cursor-grabbing shadow-lg transition-transform hover:-translate-y-1"
                                 draggable="true"
                                 @dragstart="onDragStart($event, item.id)">
                                <span x-text="item.text"></span>
                            </div>
                        </template>

                        <div x-show="getItemsInZone('gudang').length === 0" class="text-sm text-gray-500 italic w-full text-center py-2">
                            Semua nilai sudah dimasukkan ke keranjang.
                        </div>
                    </div>
                </div>
            </div>

            <!-- OVERLAY: MENANG 1 LEVEL -->
            <div x-show="status === 'won_level'" x-transition class="absolute inset-0 bg-green-900/95 flex flex-col items-center justify-center z-10 backdrop-blur-sm">
                <svg class="w-20 h-20 text-green-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h2 class="text-3xl font-bold text-white mb-2">SORTING BERHASIL!</h2>
                <p class="text-green-300 mb-6 font-mono">+<span x-text="lastScore"></span> Skor (Sisa Waktu: <span x-text="timeLeft"></span>s)</p>
                <button @click="nextLevel()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-transform hover:scale-105">
                    <span x-show="currentIndex < puzzles.length - 1">Lanjut Puzzle <span x-text="currentIndex + 2"></span></span>
                    <span x-show="currentIndex === puzzles.length - 1">Lihat Hasil Akhir</span>
                </button>
            </div>

            <!-- OVERLAY: GAGAL (WAKTU HABIS) -->
            <div x-show="status === 'failed'" x-cloak x-transition class="absolute inset-0 bg-red-900/95 flex flex-col items-center justify-center z-10 backdrop-blur-sm">
                <svg class="w-20 h-20 text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h2 class="text-3xl font-bold text-white mb-2">WAKTU HABIS!</h2>
                <p class="text-red-300 mb-6 font-mono">Skor Puzzle Ini: 0</p>
                <button @click="nextLevel()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-transform hover:scale-105">
                    <span x-show="currentIndex < puzzles.length - 1">Lanjut Puzzle Berikutnya</span>
                    <span x-show="currentIndex === puzzles.length - 1">Lihat Hasil Akhir</span>
                </button>
            </div>

            <!-- OVERLAY: TAMAT (SEMUA PUZZLE SELESAI) -->
            <div x-show="status === 'completed_all'" x-cloak x-transition class="flex flex-col items-center justify-center z-20 py-8">
                <div class="w-28 h-28 bg-gradient-to-tr from-yellow-600 to-yellow-300 rounded-full flex items-center justify-center mb-6 shadow-[0_0_40px_rgba(250,204,21,0.6)] animate-bounce">
                    <svg class="w-14 h-14 text-yellow-900" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-600 mb-2">LUAR BIASA!</h2>
                <p class="text-gray-400 mb-8 text-lg">Materi "Variabel & Tipe Data" berhasil ditaklukkan!</p>
                
                <div class="bg-slate-800/80 border border-yellow-500/30 backdrop-blur-sm rounded-3xl p-6 min-w-[250px] mb-10 flex flex-col items-center shadow-[0_0_30px_rgba(250,204,21,0.1)]">
                    <p class="text-xs text-yellow-500/80 uppercase tracking-widest font-bold mb-2">Total EXP Terkumpul</p>
                    <div class="text-6xl font-black text-yellow-400 tracking-wider drop-shadow-[0_0_15px_rgba(250,204,21,0.5)] flex items-end gap-2">
                        <span x-text="totalScore"></span> <span class="text-2xl text-yellow-600 font-bold mb-2">/ 500</span>
                    </div>
                </div>
                
                <form action="{{ route('puzzle.materi.submit', ['id' => 1]) }}" method="POST" class="flex flex-col items-center">
                    @csrf 
                    <input type="hidden" name="skor_total" :value="totalScore">
                    
                    <button type="submit" class="bg-gradient-to-r from-[#4c489d] to-indigo-600 hover:from-indigo-500 hover:to-blue-500 text-white font-bold py-4 px-10 rounded-full shadow-[0_0_20px_rgba(76,72,157,0.5)] transition-all hover:scale-105 hover:shadow-[0_0_30px_rgba(76,72,157,0.7)]">
                        Klaim Skor & Kembali ke Map
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- SCRIPT LOGIKA DRAG & DROP & TIMER -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dragDropGame', () => ({
                status: 'playing', // playing, won_level, failed, completed_all
                draggedItemId: null,
                dragOverZone: null,
                
                currentIndex: 0,
                totalScore: 0,
                lastScore: 0,
                kesalahan: 0,
                
                timeLeft: 60,
                timerInterval: null,

                puzzles: [
                    {
                        title: 'Puzzle 1: Tipe Data Dasar',
                        description: 'Tarik nilai (value) ke dalam keranjang Tipe Data yang tepat!',
                        targetZones: [
                            { id: 'string', nama: 'String' },
                            { id: 'integer', nama: 'Integer' },
                            { id: 'boolean', nama: 'Boolean' }
                        ],
                        items: [
                            { id: '1_1', text: '"NexLogic"', correctZone: 'string', currentZone: 'gudang' },
                            { id: '1_2', text: '2026', correctZone: 'integer', currentZone: 'gudang' },
                            { id: '1_3', text: 'true', correctZone: 'boolean', currentZone: 'gudang' },
                            { id: '1_4', text: '"Narji"', correctZone: 'string', currentZone: 'gudang' },
                            { id: '1_5', text: 'false', correctZone: 'boolean', currentZone: 'gudang' },
                            { id: '1_6', text: '99', correctZone: 'integer', currentZone: 'gudang' },
                        ]
                    },
                    {
                        title: 'Puzzle 2: Penamaan Variabel',
                        description: 'Pisahkan nama variabel yang valid dan invalid menurut aturan penamaan!',
                        targetZones: [
                            { id: 'valid', nama: 'Valid' },
                            { id: 'invalid', nama: 'Invalid' }
                        ],
                        items: [
                            { id: '2_1', text: 'nama_siswa', correctZone: 'valid', currentZone: 'gudang' },
                            { id: '2_2', text: '1angka', correctZone: 'invalid', currentZone: 'gudang' },
                            { id: '2_3', text: 'jenis kelamin', correctZone: 'invalid', currentZone: 'gudang' },
                            { id: '2_4', text: 'totalHarga', correctZone: 'valid', currentZone: 'gudang' },
                            { id: '2_5', text: 'const', correctZone: 'invalid', currentZone: 'gudang' },
                            { id: '2_6', text: '_nilai', correctZone: 'valid', currentZone: 'gudang' },
                        ]
                    },
                    {
                        title: 'Puzzle 3: Konstanta vs Variabel',
                        description: 'Mana yang nilainya bisa diubah (Variabel) dan mana yang tetap (Konstan)?',
                        targetZones: [
                            { id: 'konstan', nama: 'Konstan (const)' },
                            { id: 'variabel', nama: 'Variabel (let/var)' }
                        ],
                        items: [
                            { id: '3_1', text: 'const PI = 3.14', correctZone: 'konstan', currentZone: 'gudang' },
                            { id: '3_2', text: 'let umur = 20', correctZone: 'variabel', currentZone: 'gudang' },
                            { id: '3_3', text: 'const MINGGU = 7', correctZone: 'konstan', currentZone: 'gudang' },
                            { id: '3_4', text: 'let nama = "Budi"', correctZone: 'variabel', currentZone: 'gudang' },
                        ]
                    },
                    {
                        title: 'Puzzle 4: Casting Tipe Data',
                        description: 'Kelompokkan fungsi konversi tipe data yang menghasilkan Angka atau String!',
                        targetZones: [
                            { id: 'ke_angka', nama: 'Menjadi Angka' },
                            { id: 'ke_string', nama: 'Menjadi String' }
                        ],
                        items: [
                            { id: '4_1', text: 'parseInt("123")', correctZone: 'ke_angka', currentZone: 'gudang' },
                            { id: '4_2', text: 'String(45)', correctZone: 'ke_string', currentZone: 'gudang' },
                            { id: '4_3', text: 'Number("10")', correctZone: 'ke_angka', currentZone: 'gudang' },
                            { id: '4_4', text: '(100).toString()', correctZone: 'ke_string', currentZone: 'gudang' },
                        ]
                    },
                    {
                        title: 'Puzzle 5: Penggabungan vs Penjumlahan',
                        description: 'Tentukan apakah operasi berikut menghasilkan penggabungan teks atau penjumlahan matematika!',
                        targetZones: [
                            { id: 'penggabungan', nama: 'Hasil String (Penggabungan)' },
                            { id: 'penjumlahan', nama: 'Hasil Angka (Penjumlahan)' }
                        ],
                        items: [
                            { id: '5_1', text: '"5" + "5"', correctZone: 'penggabungan', currentZone: 'gudang' },
                            { id: '5_2', text: '5 + 5', correctZone: 'penjumlahan', currentZone: 'gudang' },
                            { id: '5_3', text: '"Halo " + "Dunia"', correctZone: 'penggabungan', currentZone: 'gudang' },
                            { id: '5_4', text: '10 + 20', correctZone: 'penjumlahan', currentZone: 'gudang' },
                        ]
                    }
                ],

                init() {
                    this.startTimer();
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
                        if(this.status === 'playing') {
                            if(this.timeLeft > 0) {
                                this.timeLeft--;
                            } else {
                                this.status = 'failed';
                                clearInterval(this.timerInterval);
                            }
                        }
                    }, 1000);
                },

                // --- FUNGSI DRAG & DROP HTML5 ---
                
                onDragStart(event, itemId) {
                    this.draggedItemId = itemId;
                    event.dataTransfer.effectAllowed = 'move';
                    event.dataTransfer.setData('text/plain', itemId);
                },

                onDrop(event, zoneId) {
                    this.dragOverZone = null;
                    if (!this.draggedItemId) return;

                    const currentItems = this.puzzles[this.currentIndex].items;
                    const itemIndex = currentItems.findIndex(i => i.id === this.draggedItemId);
                    if (itemIndex > -1) {
                        currentItems[itemIndex].currentZone = zoneId;
                    }
                    this.draggedItemId = null;
                },

                getItemsInZone(zoneId) {
                    return this.puzzles[this.currentIndex].items.filter(item => item.currentZone === zoneId);
                },

                // --- FUNGSI VALIDASI ---
                
                cekJawaban() {
                    if(this.getItemsInZone('gudang').length > 0) {
                        alert("Masukkan semua nilai ke dalam keranjang terlebih dahulu!");
                        return;
                    }

                    let salah = 0;
                    this.puzzles[this.currentIndex].items.forEach(item => {
                        if (item.currentZone !== item.correctZone) {
                            salah++;
                        }
                    });

                    if (salah === 0) {
                        clearInterval(this.timerInterval);
                        
                        // Kalkulasi Skor Maksimal 100 tiap level
                        // Proporsi sisa waktu ditambah penalti salah (10 poin tiap 1 kesalahan)
                        let calcScore = Math.floor(100 * (this.timeLeft / 60)) - (this.kesalahan * 10);
                        if (calcScore < 0) calcScore = 0;
                        if (calcScore > 100) calcScore = 100;
                        
                        // Jika berhasil meski lambat/salah, beri minimal skor 15 agar tetap ada poin
                        if (calcScore < 15) calcScore = 15;

                        this.lastScore = calcScore;
                        this.totalScore += calcScore;
                        this.status = 'won_level';
                    } else {
                        this.kesalahan += salah;
                        // Kurangi sisa waktu sebagai penalti (misal 5 detik tiap 1 jawaban salah)
                        this.timeLeft = Math.max(1, this.timeLeft - (salah * 5));
                        alert(`Oops! Ada ${salah} jawaban yang posisinya kurang tepat. Coba periksa lagi! (Sisa Waktu Dikurangi)`);
                    }
                },

                nextLevel() {
                    if (this.currentIndex < this.puzzles.length - 1) {
                        this.currentIndex++;
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
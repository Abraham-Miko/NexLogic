<x-app-layout>

    <!-- CONTAINER KONTEN -->
    <!-- Menggunakan min-h-full agar mengikuti tinggi .page-slot -->
    <div class="relative min-h-full overflow-hidden p-6 lg:p-10">
        
        <!-- Background Grid Titik-titik (Sengaja tetap dipertahankan untuk estetika game) -->
        <div class="absolute inset-0 pointer-events-none z-0 opacity-30" 
             style="background-image: radial-gradient(#475569 1.5px, transparent 1.5px); background-size: 36px 36px;">
        </div>

        <div class="relative z-10 max-w-5xl mx-auto">
            <!-- Breadcrumb -->
            <div class="flex justify-between items-center mb-8">
                <div class="text-gray-400 text-sm">
                    <span class="hover:text-white cursor-pointer transition-colors">Home</span> > 
                    <span class="hover:text-white cursor-pointer transition-colors">Materi</span> > 
                    <span class="text-white font-medium">Puzzles</span>
                </div>
            </div>

            <!-- Judul Halaman -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-16">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-3">Siap Memecahkan Puzzle?</h2>
                    <p class="text-gray-400 max-w-2xl">
                        Jadilah juara dengan menyelesaikan setiap nomor puzzle secara berurutan untuk menaklukkan materi ini dan kumpulkan poin-mu.
                    </p>
                </div>

                <!-- KARTU SKOR (Poin) -->
                <div class="bg-[#1f2937]/80 backdrop-blur-sm border border-yellow-500/30 p-4 rounded-2xl shadow-[0_0_30px_rgba(250,204,21,0.15)] flex items-center gap-4 min-w-[200px] transform hover:scale-105 transition-transform">
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-full flex items-center justify-center animate-pulse">
                        <svg class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-0.5">Total Poin</p>
                        <!-- Variabel $total_skor akan diambil dari Controller -->
                        <p class="text-3xl font-black text-yellow-400 leading-none drop-shadow-[0_0_10px_rgba(250,204,21,0.4)]">
                            {{ $total_skor ?? 0 }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- ALPINE JS: PUZZLE MAP RENDERER -->
            <div x-data="puzzleMap({{ json_encode($completed_materi ?? []) }}, {{ json_encode($unlocked_materi ?? []) }})" class="w-full max-w-4xl mx-auto pb-20">
                <template x-for="(row, rowIndex) in levels" :key="rowIndex">
                    <div class="relative flex justify-between items-center w-full mb-16">
                        
                        <!-- Garis Horizontal (Background) -->
                        <div class="absolute left-7 right-7 top-1/2 h-0.5 bg-gray-600 -z-10"></div>

                        <template x-for="(node, nodeIndex) in row" :key="node.id">
                            <div class="relative z-10">
                                
                                <!-- Garis Vertikal ke bawah -->
                                <template x-if="node.dropDown && rowIndex < levels.length - 1">
                                    <div class="absolute top-1/2 left-1/2 w-0.5 h-[120px] bg-gray-600 -translate-x-1/2 -z-10"></div>
                                </template>

                                <!-- Lingkaran Level -->
                                <a :href="getNodeStatus(node.id) !== 'locked' ? '/puzzle/materi/' + Math.ceil(node.id / 5) : '#'" 
                                   class="w-14 h-14 rounded-full flex items-center justify-center font-bold text-xl border-2 transition-transform shadow-xl"
                                     :class="{
                                        'border-green-500 bg-green-500 text-white shadow-[0_0_20px_rgba(34,197,94,0.6)] hover:scale-110 cursor-pointer': getNodeStatus(node.id) === 'completed',
                                        'border-[#06b6d4] bg-[#083344] text-[#22d3ee] shadow-[0_0_20px_rgba(6,182,212,0.4)] hover:scale-110 cursor-pointer': getNodeStatus(node.id) === 'current',
                                        'border-[#8b5cf6] bg-[#2e1065] text-[#c4b5fd] hover:scale-110 cursor-pointer': getNodeStatus(node.id) === 'unlocked',
                                        'border-gray-600 bg-[#18181b] text-gray-500 cursor-not-allowed': getNodeStatus(node.id) === 'locked'
                                     }">
                                     
                                     <!-- Tanda "You" & Panah -->
                                     <template x-if="getNodeStatus(node.id) === 'current'">
                                         <div class="absolute -top-12 left-1/2 -translate-x-1/2 flex flex-col items-center animate-bounce">
                                             <span class="text-xs font-bold text-white mb-1">You</span>
                                             <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                         </div>
                                     </template>

                                     <!-- Ikon Centang Hijau untuk Completed -->
                                     <template x-if="getNodeStatus(node.id) === 'completed'">
                                         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                     </template>

                                     <!-- Angka Node -->
                                     <template x-if="getNodeStatus(node.id) !== 'locked' && getNodeStatus(node.id) !== 'completed'">
                                         <span x-text="node.id"></span>
                                     </template>

                                     <!-- Ikon Gembok -->
                                     <template x-if="getNodeStatus(node.id) === 'locked'">
                                         <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                     </template>
                                </a>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

        </div>
    </div>

    <!-- SCRIPT ALPINE -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('puzzleMap', (completedMateri = [], unlockedMateri = []) => ({
                completedMateri: completedMateri.map(Number), // pastikan bentuk angka
                unlockedMateri: unlockedMateri.map(Number),
                
                getNodeStatus(nodeId) {
                    const materiKe = Math.ceil(nodeId / 5);
                    
                    if (this.completedMateri.includes(materiKe)) {
                        return 'completed';
                    }
                    
                    if (this.unlockedMateri.includes(materiKe)) {
                        const incompleteUnlocked = this.unlockedMateri.filter(m => !this.completedMateri.includes(m));
                        const lowestUnlockedIncomplete = incompleteUnlocked.length > 0 ? Math.min(...incompleteUnlocked) : -1;
                        
                        if (materiKe === lowestUnlockedIncomplete && nodeId === (materiKe - 1) * 5 + 1) {
                            return 'current';
                        } else {
                            return 'unlocked';
                        }
                    }
                    
                    return 'locked';
                },

                levels: [
                    // Baris 1: Maju (1-6)
                    [
                        { id: 1 },
                        { id: 2 },
                        { id: 3 },
                        { id: 4 },
                        { id: 5 , dropDown: true}
                    ],
                    // Baris 2: UI Mundur (12-7) agar zig-zag
                    [
                        { id: 10, dropDown: true },
                        { id: 9 },
                        { id: 8 },
                        { id: 7 },
                        { id: 6 } 
                    ],
                    // Baris 3: Maju (13-18)
                    [
                        
                        { id: 11 }, 
                        { id: 12 },
                        { id: 13 },
                        { id: 14 },
                        { id: 15, dropDown: true },
                    ],
                    [
                        
                        { id: 20, dropDown: true }, 
                        { id: 19 },
                        { id: 18 },
                        { id: 17 },
                        { id: 16 },
                    ],
                    [
                        
                        { id: 21 }, 
                        { id: 22 },
                        { id: 23 },
                        { id: 24 },
                        { id: 25, dropDown: true },
                    ],
                    [
                        
                        { id: 30, dropDown: true }, 
                        { id: 29 },
                        { id: 28 },
                        { id: 27 },
                        { id: 26 },
                    ]
                ]
            }));
        });
    </script>

</x-app-layout>
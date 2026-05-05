@extends('layouts.guru')

@section('content')
<div class="p-6 text-white min-h-screen" x-data="contentManager()">
    
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">Content Manager</h1>
            <p class="text-gray-400 text-sm md:text-base">Kelola materi pembelajaran, pre-test, dan post-test untuk setiap kelas (Sub Wilayah).</p>
        </div>
    </div>

    <!-- Filter Wilayah -->
    <div class="bg-gray-600 p-5 rounded-xl mb-8 border border-gray-700/50 shadow-lg">
        <label for="sub-wilayah" class="block text-sm font-medium text-gray-300 mb-2">Pilih Kelas / Sub Wilayah</label>
        <div class="relative">
            <select id="sub-wilayah" x-model="selectedKelasId" @change="fetchMateri()" class="w-full md:w-1/3 bg-[#1f2937] border border-slate-700 text-gray-300 text-sm rounded-lg focus:ring-[#4c489d] focus:border-[#4c489d] block p-2.5 outline-none transition-all cursor-pointer">
                <option value="" class="bg-[#1f2937] text-gray-300">-- Pilih Kelas untuk dikelola --</option>
                @foreach($daftarKelas as $kelas)
                    <option value="{{ $kelas->id }}" class="bg-[#1f2937] text-gray-300">{{ $kelas->wilayah->nama_wilayah }} - {{ $kelas->nama_sub_wilayah }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 left-[calc(33.333%-2.5rem)] flex items-center px-2 text-gray-400 hidden md:flex">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <div x-show="!selectedKelasId" class="text-center py-20">
        <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-700">
            <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-300">Pilih Kelas</h3>
        <p class="text-gray-500 mt-2">Pilih kelas di atas untuk mulai mengelola materi dan soal.</p>
    </div>

    <!-- Loading State -->
    <div x-show="isLoading" class="text-center py-20" style="display: none;">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-[#4c489d]"></div>
        <p class="text-gray-400 mt-4">Memuat data...</p>
    </div>

    <!-- Daftar Materi (Grid) -->
    <div x-show="selectedKelasId && !isLoading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" style="display: none;">
        
        <template x-for="item in materiList" :key="item.materi_ke">
            <div class="bg-[#111827] rounded-xl border border-slate-700 shadow-lg overflow-hidden flex flex-col transition-all duration-300 hover:border-slate-500 group relative">
                <div class="p-6 flex-grow relative z-10">
                    
                    <div class="flex justify-between items-start mb-4">
                        <span x-show="item.is_aktif" class="bg-green-500/10 text-green-400 text-xs font-bold px-3 py-1 rounded-full border border-green-500/20 shadow-[0_0_10px_rgba(16,185,129,0.1)]">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-green-500 mr-1 align-middle"></span> Aktif
                        </span>
                        <span x-show="!item.is_aktif" class="bg-gray-700/50 text-gray-300 text-xs font-bold px-3 py-1 rounded-full border border-gray-600">
                            Draft
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-white mb-2 leading-tight" x-text="item.judul"></h3>
                    <p class="text-sm text-gray-400 mb-6">Materi Pembelajaran ke-<span x-text="item.materi_ke"></span></p>
                    
                    <!-- Pre-Test & Post-Test Area -->
                    <div class="space-y-3 mb-2">
                        <!-- Pre-Test -->
                        <button @click="openModal(item, 'pre_test')" class="w-full flex items-center justify-between p-3.5 rounded-lg bg-[#1f2937] border border-slate-700 hover:bg-[#2d2a54] hover:border-[#4c489d]/50 transition-all group/btn">
                            <div class="flex items-center gap-3">
                                <template x-if="item.pre_test_count > 0">
                                    <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-green-400 shadow-[0_0_8px_rgba(16,185,129,0.2)]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </template>
                                <template x-if="item.pre_test_count == 0">
                                    <div class="w-8 h-8 rounded-full bg-yellow-500/10 flex items-center justify-center text-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.15)]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </div>
                                </template>
                                <span class="text-sm font-medium text-gray-300 group-hover/btn:text-white transition-colors">Kelola Pre-Test</span>
                            </div>
                            <span x-show="item.pre_test_count > 0" class="text-xs font-medium text-gray-500 bg-slate-800 px-2 py-1 rounded"><span x-text="item.pre_test_count"></span> Soal</span>
                            <span x-show="item.pre_test_count == 0" class="text-xs text-yellow-500/80 italic">Belum ada</span>
                        </button>
                        
                        <!-- Post-Test -->
                        <button @click="openModal(item, 'post_test')" class="w-full flex items-center justify-between p-3.5 rounded-lg bg-[#1f2937] border border-slate-700 hover:bg-[#2d2a54] hover:border-[#4c489d]/50 transition-all group/btn">
                            <div class="flex items-center gap-3">
                                <template x-if="item.post_test_count > 0">
                                    <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-green-400 shadow-[0_0_8px_rgba(16,185,129,0.2)]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </template>
                                <template x-if="item.post_test_count == 0">
                                    <div class="w-8 h-8 rounded-full bg-yellow-500/10 flex items-center justify-center text-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.15)]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </div>
                                </template>
                                <span class="text-sm font-medium text-gray-300 group-hover/btn:text-white transition-colors">Kelola Post-Test</span>
                            </div>
                            <span x-show="item.post_test_count > 0" class="text-xs font-medium text-gray-500 bg-slate-800 px-2 py-1 rounded"><span x-text="item.post_test_count"></span> Soal</span>
                            <span x-show="item.post_test_count == 0" class="text-xs text-yellow-500/80 italic">Belum ada</span>
                        </button>
                    </div>
                </div>
                
                <!-- Footer / Action Area -->
                <div class="px-6 py-4 border-t border-gray-700 bg-slate-800/30 flex flex-col justify-center relative z-10">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2" :class="item.can_activate ? 'text-gray-300' : 'text-gray-500'">
                            <span class="text-sm font-medium">Akses Siswa</span>
                            <svg x-show="!item.can_activate" class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        
                        <!-- Toggle Switch -->
                        <div class="relative inline-block w-12 mr-1 align-middle select-none transition duration-200 ease-in" :class="!item.can_activate ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'">
                            <input type="checkbox" :id="'toggle' + item.materi_ke" class="absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none z-10 transition-all right-0" 
                                   :class="item.is_aktif ? 'border-green-500 right-0' : 'border-gray-400 left-0'"
                                   :disabled="!item.can_activate" 
                                   :checked="item.is_aktif"
                                   @change="toggleAktifasi(item)"
                                   style="top: 0; outline: none; box-shadow: none;"/>
                            <label :for="'toggle' + item.materi_ke" class="block overflow-hidden h-6 rounded-full transition-colors"
                                   :class="item.is_aktif ? 'bg-green-500' : 'bg-gray-700'"
                                   :style="item.can_activate ? 'cursor: pointer;' : 'cursor: not-allowed;'"></label>
                        </div>
                    </div>
                    
                    <div x-show="!item.can_activate" class="flex items-start gap-1.5 mt-1">
                        <svg class="w-3 h-3 text-yellow-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <p class="text-[11px] text-yellow-500/90 leading-tight">
                            Lengkapi Pre-test dan Post-test untuk mengaktifkan materi.
                        </p>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- MODAL "Kelola Soal" -->
    <div x-show="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 sm:px-0" style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>
        
        <!-- Modal Container -->
        <div class="bg-[#111827] rounded-xl border border-slate-700 shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col relative z-50">
            
            <!-- Modal Header -->
            <div class="px-6 py-5 border-b border-slate-700 flex justify-between items-center bg-[#1f2937] rounded-t-xl">
                <div class="flex gap-4 items-center">
                    <div class="w-10 h-10 rounded-lg bg-[#2d2a54] flex items-center justify-center shadow-inner border border-[#4c489d]/30 text-[#4c489d]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white leading-none mb-1.5">
                            Kelola Soal <span class="text-[#4c489d]" x-text="activeTestType == 'pre_test' ? 'Pre-Test' : 'Post-Test'"></span>
                        </h2>
                        <p class="text-xs text-gray-400">Materi: <span class="font-medium text-gray-300" x-text="activeMateri.judul"></span></p>
                    </div>
                </div>
                <button @click="closeModal()" class="text-gray-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Modal Body (Scrollable) -->
            <div class="p-6 overflow-y-auto flex-grow bg-[#111827] flex flex-col md:flex-row gap-6">
                
                <!-- Kiri: Form Tambah Soal -->
                <div class="flex-1">
                    <div class="bg-[#1f2937] border border-slate-700 rounded-xl p-5 shadow-sm mb-6">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#4c489d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 
                                Tambah Soal Baru
                            </h3>
                            
                            <!-- Tombol Copy Soal -->
                            <button @click="openCopyModal()" class="text-xs bg-[#111827] hover:bg-gray-800 text-gray-300 px-3 py-1.5 rounded border border-slate-700 transition flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                Copy Soal dari Kelas Lain
                            </button>
                        </div>
                        
                        <form @submit.prevent="saveSoal">
                            <!-- Pertanyaan -->
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-gray-300 mb-2">Pertanyaan</label>
                                <textarea x-model="formSoal.soal" required rows="3" class="w-full bg-[#111827] border border-slate-700 text-white text-sm rounded-lg focus:outline-none focus:border-[#4c489d] focus:ring-1 focus:ring-[#4c489d] transition-all block p-3.5 placeholder-gray-500" placeholder="Ketik pertanyaan di sini..."></textarea>
                            </div>

                            <!-- Pilihan Ganda -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-300 mb-3 flex justify-between items-center">
                                    <span>Pilihan Jawaban</span>
                                    <span class="text-[11px] text-gray-500 font-normal bg-slate-800 px-2 py-1 rounded">Tandai untuk jawaban benar</span>
                                </label>
                                <div class="space-y-3">
                                    <template x-for="opt in ['A', 'B', 'C', 'D']">
                                        <div class="flex items-center gap-3 bg-[#111827] p-2 rounded-lg border border-slate-700 focus-within:border-[#4c489d] transition-all group" :class="formSoal.jawaban_benar == opt ? 'border-[#4c489d] bg-[#4c489d]/10' : ''">
                                            <div class="flex items-center justify-center w-8 h-8 shrink-0">
                                                <input type="radio" name="correct_answer" :value="opt" x-model="formSoal.jawaban_benar" required class="w-4 h-4 text-[#4c489d] bg-[#1f2937] border-slate-600 focus:ring-[#4c489d] cursor-pointer">
                                            </div>
                                            <span class="font-bold w-6 transition-colors" :class="formSoal.jawaban_benar == opt ? 'text-[#4c489d]' : 'text-gray-500'" x-text="opt + '.'"></span>
                                            <input type="text" :placeholder="'Masukkan opsi ' + opt + '...'" 
                                                   x-model="formSoal['opsi_' + opt.toLowerCase()]" required
                                                   class="w-full bg-transparent border-none text-white text-sm focus:ring-0 p-1.5 placeholder-gray-500 outline-none">
                                        </div>
                                    </template>
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="bg-[#4c489d] hover:bg-[#3a3780] text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-all shadow-[0_0_15px_rgba(76,72,157,0.3)] flex items-center gap-2" :disabled="isSaving">
                                    <svg x-show="!isSaving" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                    <svg x-show="isSaving" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    <span x-text="isSaving ? 'Menyimpan...' : 'Simpan Soal'"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Kanan: Daftar Soal -->
                <div class="flex-1 flex flex-col">
                    <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        Daftar Soal 
                        <span class="bg-[#2d2a54] text-[#4c489d] text-xs px-2 py-0.5 rounded-full ml-1 border border-[#4c489d]/20" x-text="daftarSoal.length"></span>
                    </h3>
                    
                    <div x-show="isLoadingSoal" class="text-center py-10">
                        <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-[#4c489d]"></div>
                    </div>

                    <div x-show="!isLoadingSoal && daftarSoal.length == 0" class="text-center py-10 bg-[#1f2937] border border-slate-700 border-dashed rounded-xl">
                        <p class="text-sm text-gray-500">Belum ada soal untuk tes ini.</p>
                    </div>

                    <div x-show="!isLoadingSoal && daftarSoal.length > 0" class="space-y-4 overflow-y-auto pr-2 custom-scrollbar" style="max-height: 500px;">
                        <template x-for="(soal, index) in daftarSoal" :key="soal.id">
                            <div class="bg-[#1f2937] border border-slate-700 p-5 rounded-xl relative group hover:border-slate-500 transition-colors shadow-sm">
                                <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button @click="deleteSoal(soal.id)" class="w-8 h-8 rounded-lg bg-red-500/10 text-red-400 hover:text-red-300 hover:bg-red-500/20 flex items-center justify-center transition-colors" title="Hapus Soal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                                <p class="text-sm text-gray-200 mb-4 pr-10 font-medium leading-relaxed">
                                    <span x-text="(index + 1) + '. '"></span><span x-text="soal.soal"></span>
                                </p>
                                <div class="grid grid-cols-1 gap-2 text-sm text-gray-400">
                                    <template x-for="opt in ['A', 'B', 'C', 'D']">
                                        <div class="flex gap-2 items-start p-2 rounded-lg border" :class="soal.jawaban_benar == opt ? 'bg-green-500/10 border-green-500/20 text-green-400' : 'bg-[#111827] border-transparent'">
                                            <span class="font-bold" :class="soal.jawaban_benar == opt ? 'text-green-500' : 'text-gray-500'" x-text="opt + '.'"></span>
                                            <span x-text="soal['opsi_' + opt.toLowerCase()]"></span>
                                            <svg x-show="soal.jawaban_benar == opt" class="w-4 h-4 mt-0.5 ml-auto text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
            
            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-slate-700 bg-[#1f2937] rounded-b-xl flex justify-end">
                <button @click="closeModal()" class="px-6 py-2.5 text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-700 rounded-lg transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL COPY SOAL -->
    <div x-show="isCopyModalOpen" class="fixed inset-0 z-[60] flex items-center justify-center px-4 py-6 sm:px-0" style="display: none;">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="isCopyModalOpen = false"></div>
        <div class="bg-[#111827] rounded-xl border border-slate-700 shadow-2xl w-full max-w-lg flex flex-col relative z-50">
            <div class="px-6 py-4 border-b border-slate-700 bg-[#1f2937] rounded-t-xl">
                <h3 class="text-lg font-bold text-white">Salin Soal dari Kelas Lain</h3>
                <p class="text-xs text-gray-400 mt-1">Pilih kelas yang sudah memiliki soal <span x-text="activeTestType"></span> untuk materi ini.</p>
            </div>
            <div class="p-6">
                <div x-show="isLoadingCopyOptions" class="text-center py-4">
                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-[#4c489d]"></div>
                </div>
                
                <div x-show="!isLoadingCopyOptions && copyOptions.length == 0" class="text-center py-4">
                    <p class="text-sm text-yellow-500">Tidak ada kelas lain yang memiliki soal untuk materi ini.</p>
                </div>

                <div x-show="!isLoadingCopyOptions && copyOptions.length > 0">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Pilih Kelas Sumber</label>
                    <select x-model="selectedCopySource" class="w-full bg-[#1f2937] border border-slate-700 text-gray-300 text-sm rounded-lg focus:outline-none focus:border-[#4c489d] focus:ring-1 focus:ring-[#4c489d] transition-all block p-2.5 mb-4 outline-none">
                        <option value="" class="bg-[#1f2937] text-gray-300">-- Pilih Kelas --</option>
                        <template x-for="opt in copyOptions" :key="opt.id">
                            <option :value="opt.id" class="bg-[#1f2937] text-gray-300" x-text="opt.wilayah.nama_wilayah + ' - ' + opt.nama_sub_wilayah" x-show="opt.id != selectedKelasId"></option>
                        </template>
                    </select>

                    <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-3 mt-4">
                        <p class="text-xs text-blue-400"><strong>Catatan:</strong> Menyalin soal akan menambahkan soal-soal tersebut ke dalam daftar soal di kelas ini tanpa menghapus soal yang sudah ada.</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-slate-700 bg-[#1f2937] rounded-b-xl flex justify-end gap-3">
                <button @click="isCopyModalOpen = false" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-700 rounded-lg transition-colors">Batal</button>
                <button @click="executeCopy()" :disabled="!selectedCopySource || isExecutingCopy" class="bg-[#4c489d] hover:bg-[#3a3780] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors disabled:opacity-50 flex items-center gap-2">
                    <span x-show="!isExecutingCopy">Salin Soal</span>
                    <span x-show="isExecutingCopy">Menyalin...</span>
                </button>
            </div>
        </div>
    </div>
<div class="h-24 w-full"></div>
</div>

<!-- Script Inline untuk Alpine.js yang sudah terhubung dengan resources/js/app.js -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('contentManager', () => ({
            selectedKelasId: '',
            isLoading: false,
            materiList: [],
            
            // Modal state
            isModalOpen: false,
            activeMateri: {},
            activeTestType: '', // pre_test or post_test
            
            // Form state
            formSoal: {
                soal: '',
                opsi_a: '',
                opsi_b: '',
                opsi_c: '',
                opsi_d: '',
                jawaban_benar: 'A'
            },
            isSaving: false,
            
            // Daftar soal state
            daftarSoal: [],
            isLoadingSoal: false,

            // Copy state
            isCopyModalOpen: false,
            copyOptions: [],
            isLoadingCopyOptions: false,
            selectedCopySource: '',
            isExecutingCopy: false,

            fetchMateri() {
                if (!this.selectedKelasId) {
                    this.materiList = [];
                    return;
                }
                
                this.isLoading = true;
                fetch(`/guru/content/kelas/${this.selectedKelasId}`)
                    .then(res => res.json())
                    .then(data => {
                        this.materiList = data.materi;
                        this.isLoading = false;
                    })
                    .catch(err => {
                        console.error(err);
                        this.isLoading = false;
                        Swal.fire('Error', 'Gagal memuat data kelas', 'error');
                    });
            },

            openModal(materi, type) {
                this.activeMateri = materi;
                this.activeTestType = type;
                this.isModalOpen = true;
                this.resetForm();
                this.fetchSoal();
            },

            closeModal() {
                this.isModalOpen = false;
                this.fetchMateri(); // Refresh list to update counts
            },

            resetForm() {
                this.formSoal = {
                    soal: '',
                    opsi_a: '',
                    opsi_b: '',
                    opsi_c: '',
                    opsi_d: '',
                    jawaban_benar: 'A'
                };
            },

            fetchSoal() {
                this.isLoadingSoal = true;
                fetch(`/guru/content/soal/${this.selectedKelasId}/${this.activeMateri.materi_ke}/${this.activeTestType}`)
                    .then(res => res.json())
                    .then(data => {
                        this.daftarSoal = data.data;
                        this.isLoadingSoal = false;
                    })
                    .catch(err => {
                        console.error(err);
                        this.isLoadingSoal = false;
                    });
            },

            saveSoal() {
                this.isSaving = true;
                const payload = {
                    _token: '{{ csrf_token() }}',
                    sub_wilayah_id: this.selectedKelasId,
                    materi_ke: this.activeMateri.materi_ke,
                    jenis_soal: this.activeTestType,
                    ...this.formSoal
                };

                fetch(`/guru/content/soal`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    this.isSaving = false;
                    if(data.message) {
                        this.resetForm();
                        this.fetchSoal();
                        
                        // Update local count temporarily for visual feedback
                        if(this.activeTestType === 'pre_test') this.activeMateri.pre_test_count++;
                        else this.activeMateri.post_test_count++;
                    }
                })
                .catch(err => {
                    console.error(err);
                    this.isSaving = false;
                    Swal.fire('Error', 'Gagal menyimpan soal', 'error');
                });
            },

            deleteSoal(id) {
                Swal.fire({
                    title: 'Hapus Soal?',
                    text: "Soal yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/guru/content/soal/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(() => {
                            this.fetchSoal();
                            // Update local count temporarily
                            if(this.activeTestType === 'pre_test') this.activeMateri.pre_test_count--;
                            else this.activeMateri.post_test_count--;
                        })
                        .catch(err => {
                            console.error(err);
                            Swal.fire('Error', 'Gagal menghapus soal', 'error');
                        });
                    }
                });
            },

            toggleAktifasi(materi) {
                if(!materi.can_activate) return;

                const newStatus = !materi.is_aktif;
                
                fetch(`/guru/content/toggle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        sub_wilayah_id: this.selectedKelasId,
                        materi_ke: materi.materi_ke,
                        is_aktif: newStatus
                    })
                })
                .then(async res => {
                    if (!res.ok) {
                        const err = await res.json();
                        throw new Error(err.message || 'Gagal memperbarui status');
                    }
                    return res.json();
                })
                .then(data => {
                    materi.is_aktif = newStatus;
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Peringatan', err.message, 'warning');
                    // Revert UI toggle if failed (Alpine binding will update on next tick, but just to be sure we fetch again)
                    this.fetchMateri();
                });
            },

            openCopyModal() {
                this.isCopyModalOpen = true;
                this.isLoadingCopyOptions = true;
                this.selectedCopySource = '';
                
                fetch(`/guru/content/copy-options/${this.activeMateri.materi_ke}/${this.activeTestType}`)
                    .then(res => res.json())
                    .then(data => {
                        this.copyOptions = data.data;
                        this.isLoadingCopyOptions = false;
                    })
                    .catch(err => {
                        console.error(err);
                        this.isLoadingCopyOptions = false;
                    });
            },

            executeCopy() {
                if(!this.selectedCopySource) return;
                
                this.isExecutingCopy = true;
                
                fetch(`/guru/content/copy-soal`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        source_sub_wilayah_id: this.selectedCopySource,
                        target_sub_wilayah_id: this.selectedKelasId,
                        materi_ke: this.activeMateri.materi_ke,
                        jenis_soal: this.activeTestType
                    })
                })
                .then(res => res.json())
                .then(data => {
                    this.isExecutingCopy = false;
                    this.isCopyModalOpen = false;
                    this.fetchSoal();
                    Swal.fire('Berhasil', 'Soal berhasil disalin', 'success');
                })
                .catch(err => {
                    console.error(err);
                    this.isExecutingCopy = false;
                    Swal.fire('Error', 'Gagal menyalin soal', 'error');
                });
            }
        }));
    });
</script>

<style>
    /* Custom Scrollbar for Modal */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #1f2937;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #4b5563;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }
</style>
@endsection

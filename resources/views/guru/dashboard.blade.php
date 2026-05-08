<!-- Asumsi Anda menggunakan layout ini, sesuaikan jika berbeda -->
@extends('layouts.guru')
@section('content')

<style>
.header-navigation {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 24px;
    }
    .back-link {
        display: flex; 
        align-items: center; 
        justify-content: center;
        transition: opacity 0.2s ease-in-out;
    }
    .back-link:hover { 
        opacity: 0.8; 
    }
    .back-link svg { 
        width: 20px; 
        height: 20px; 
        fill: #f8fafc; 
    }    
    .breadcrumb {
        display: flex; 
        align-items: center; 
        gap: 16px;
        font-size: 1.25rem; 
        font-weight: 500;
    }
    .breadcrumb a {
        color: #9ca3af; 
        text-decoration: none;
        transition: color 0.2s ease-in-out;
        font-size: 16px;
    }
    .breadcrumb svg { 
        width: 20px; 
        height: 20px; 
        color: #f8fafc;
    }
    .breadcrumb span {
        font-size: 16px;
        color: #f8fafc;
    }
</style>

<div class="p-6 text-white min-h-screen">
    <!-- Breadcrumb -->
    <div class="header-navigation">
        <a href="{{ route('/') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                <path d="M232,128a8,8,0,0,1-8,8H91.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L91.31,120H224A8,8,0,0,1,232,128ZM40,32a8,8,0,0,0-8,8V216a8,8,0,0,0,16,0V40A8,8,0,0,0,40,32Z"></path>
            </svg>
        </a>

        <div class="breadcrumb">
            <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span>Overview</span>
        </div>
    </div>

    <!-- HEADER DASHBOARD -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white">Dashboard Ruang Guru</h1>
            <p class="text-gray-400 text-sm mt-1">Kelola kelas dan pantau perkembangan siswa Anda.</p>
        </div>
        @if(count($daftarWilayah) > 0)
        <!-- Tombol Tambah Wilayah (Hanya muncul jika sudah punya minimal 1 wilayah) -->
        <button onclick="document.getElementById('modal-join').classList.remove('hidden')" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium border border-gray-700 flex items-center gap-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Gabung Wilayah Lain
        </button>
        @endif
    </div>
            <!-- KARTU STATISTIK (QUICK STATS) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <!-- Stat 1: Total Kelas -->
    <div class="bg-[#111827] border border-slate-700 rounded-xl p-5 flex items-center gap-4 hover:border-[#4c489d] transition-colors group">
        <div class="w-12 h-12 rounded-lg bg-[#4c489d]/10 flex items-center justify-center text-[#4c489d] group-hover:bg-[#4c489d] group-hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <div>
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Total Kelas</p>
            @php
                $totalKelas = Auth::user()->kelasYangDiampu->count();
            @endphp
            <h3 class="text-2xl font-bold text-white">{{ $totalKelas }}</h3>
        </div>
    </div>

    <!-- Stat 2: Total Siswa -->
    <div class="bg-[#111827] border border-slate-700 rounded-xl p-5 flex items-center gap-4 hover:border-indigo-500 transition-colors group">
        <div class="w-12 h-12 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Siswa Terdaftar</p>
            @php
                // Menghitung total siswa dari semua kelas yang diampu guru ini
                $totalSiswa = Auth::user()->kelasYangDiampu->sum(function($kelas) {
                    return $kelas->siswa->count();
                });
            @endphp
            <h3 class="text-2xl font-bold text-white">{{ $totalSiswa }}</h3>
        </div>
    </div>

    <!-- Stat 3: Wilayah Terhubung -->
    <div class="bg-[#111827] border border-slate-700 rounded-xl p-5 flex items-center gap-4 hover:border-emerald-500 transition-colors group">
        <div class="w-12 h-12 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Wilayah Diikuti</p>
            <h3 class="text-2xl font-bold text-white">{{ count($daftarWilayah) }}</h3>
        </div>
    </div>

</div>
    <!-- PESAN SUKSES/ERROR -->
    @if(session('success'))
    <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6 text-sm">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
        {{ session('error') }}
    </div>
    @endif

    <!-- KONTEN UTAMA -->
    @if(count($daftarWilayah) == 0)
        <!-- KONDISI 1: BELUM PUNYA WILAYAH SAMA SEKALI (EMPTY STATE) -->
        <div class="flex flex-col items-center justify-center mt-12">
            <div class="text-center max-w-md w-full bg-gray-900/50 p-8 rounded-2xl border border-gray-800">
                <div class="bg-gray-800 p-4 rounded-full inline-block mb-4">
                    <svg class="w-10 h-10 text-[#583bb7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4v-3.252l1.4-1.4a1.5 1.5 0 012.122 0l1.414 1.414a1.5 1.5 0 002.122 0l1.414-1.414a1.5 1.5 0 000-2.122l-1.414-1.414a1.5 1.5 0 010-2.122l1.4-1.4m6.603-3.603a6 6 0 00-8.486 8.486L4 17h2v2h2v2h3l4.318-4.318a6 6 0 008.486-8.486l-2.193-2.193z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Gabung ke Wilayah</h2>
                <p class="text-gray-400 mb-6 text-sm">Anda belum mengelola wilayah manapun. Masukkan Kode Wilayah untuk memulai.</p>

                <form action="/guru/wilayah/join" method="POST" class="flex flex-col gap-3">
                    @csrf
                    <input type="text" name="kode_wilayah" placeholder="Contoh: WL-RPL-2024" class="w-full bg-gray-800 border border-gray-700 text-white text-center px-4 py-3 rounded-lg focus:outline-none focus:border-[#583bb7] uppercase" required>
                    <button type="submit" class="w-full bg-[#583bb7] hover:bg-purple-600 text-white font-medium py-3 rounded-lg transition">Verifikasi Kode</button>
                </form>
            </div>
        </div>

    @else
        <!-- KONDISI 2: HYBRID DASHBOARD (MENAMPILKAN KARTU WILAYAH) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($daftarWilayah as $wilayah)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 flex flex-col h-full">

                <!-- Info Jurusan/Wilayah -->
                <div class="mb-5">
                    <span class="text-[10px] font-bold text-[#583bb7] uppercase tracking-wider bg-[#583bb7]/10 px-2 py-1 rounded">Wilayah Terdaftar</span>
                    <h2 class="text-lg font-bold text-white mt-2 truncate" title="{{ $wilayah->nama_wilayah }}">{{ $wilayah->nama_wilayah }}</h2>
                </div>

                <!-- List Kelas (Sub Wilayah) -->
                <div class="flex-grow mb-5">
                    @php
                        // Filter pintar: Hanya ambil kelas yang berada di wilayah ini DAN diajar oleh guru ini
                        $kelasDiWilayahIni = Auth::user()->kelasYangDiampu->where('wilayah_id', $wilayah->id);
                    @endphp

                    @if($kelasDiWilayahIni->count() > 0)
                        <div class="space-y-2">
                            @foreach($kelasDiWilayahIni as $kelas)
                            <a href="{{ route('guru.subwilayah.show', $kelas->id) }}" class="flex items-center justify-between p-3 rounded-lg bg-gray-800 hover:bg-[#583bb7] group border border-gray-700 transition">
                            <div class="flex items-center justify-between w-full group">
                                    <!-- Sisi Kiri: Icon dan Nama Kelas -->
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        <span class="font-medium text-sm text-gray-300 group-hover:text-white transition-colors">
                                            {{ $kelas->nama_sub_wilayah }}
                                        </span>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                            @endforeach
                        </div>
                    @else
                        <div class="h-full flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-800 rounded-xl">
                            <p class="text-xs text-gray-500 text-center">Belum ada kelas yang Anda kelola di wilayah ini.</p>
                        </div>
                    @endif
                </div>

                <!-- Tombol Buat Kelas -->
                <div class="pt-4 border-t border-gray-800">
                    <!-- Tombol Buat Kelas di dalam Loop Wilayah -->
                    <button onclick="openModalCreateKelas('{{ $wilayah->id }}', '{{ $wilayah->nama_wilayah }}')"
                            class="w-full flex items-center justify-center gap-2 bg-[#4c489d] hover:bg-[#4c489d]/10 text-white hover:text-[#4c489d] px-4 py-2.5 rounded-lg text-sm font-bold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Kelas Baru
                    </button>
                </div>

            </div>
            @endforeach

        </div>
    @endif
</div>

<!-- ========================================== -->
<!-- MODAL GABUNG WILAYAH (Hidden by default) -->
<!-- ========================================== -->
<div id="modal-join" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-gray-900 border border-gray-700 p-6 rounded-2xl w-full max-w-sm relative">
        <!-- Tombol Close Modal -->
        <button onclick="document.getElementById('modal-join').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <h3 class="text-lg font-bold text-white mb-1">Gabung Wilayah Lain</h3>
        <p class="text-sm text-gray-400 mb-4">Masukkan kode wilayah baru Anda.</p>

        <form action="/guru/wilayah/join" method="POST" class="flex flex-col gap-3">
            @csrf
            <input type="text" name="kode_wilayah" placeholder="Kode Wilayah" class="bg-gray-800 border border-gray-700 text-white px-4 py-2 rounded-lg focus:outline-none focus:border-[#583bb7] uppercase" required>
            <button type="submit" class="bg-[#583bb7] hover:bg-purple-600 text-white font-medium py-2 rounded-lg transition">Gabung</button>
        </form>
    </div>
</div>
<!-- MODAL BUAT KELAS -->
<div id="modal-create-kelas" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-[#111827] border border-slate-700 rounded-2xl w-full max-w-md overflow-hidden shadow-2xl">
        <!-- Header -->
        <div class="bg-[#2d2a54] px-6 py-4 border-b border-[#4c489d] flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-white">Buat Kelas Baru</h3>
                <p id="display-nama-wilayah" class="text-xs text-gray-300"></p>
            </div>
            <button onclick="closeModalCreateKelas()" class="text-gray-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Form -->
        <form action="{{ route('guru.subwilayah.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="wilayah_id" id="input-wilayah-id">

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Nama Sub Wilayah</label>
                <input type="text" name="nama_sub_wilayah"
                       placeholder="Contoh: 10-TKJ-AA"
                       class="w-full bg-[#1f2937] border border-slate-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-[#4c489d] uppercase"
                       required>
                <p class="mt-2 text-[10px] text-gray-500 italic">Sistem akan mencatat Anda sebagai pengampu kelas ini.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Kode Sub Wilayah</label>
                <input type="text" name="kode_sub_wilayah"
                       placeholder="Contoh: TYF-78"
                       class="w-full bg-[#1f2937] border border-slate-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-[#4c489d] uppercase"
                       required>
                <p class="mt-2 text-[10px] text-gray-500 italic">Kode harus berbeda. Inputan otomatis kapital.</p>
            </div>

            <button type="submit" class="w-full bg-[#4c489d] hover:bg-[#5b56b6] text-white font-bold py-2.5 rounded-lg shadow-[0_0_15px_rgba(76,72,157,0.3)] transition">
                Simpan Kelas
            </button>
        </form>
    </div>
</div>

<script>
    function openModalCreateKelas(id, nama) {
        document.getElementById('input-wilayah-id').value = id;
        document.getElementById('display-nama-wilayah').innerText = "Wilayah: " + nama;
        document.getElementById('modal-create-kelas').classList.remove('hidden');
    }

    function closeModalCreateKelas() {
        document.getElementById('modal-create-kelas').classList.add('hidden');
    }
</script>

@endsection

@extends('layouts.superadmin')
@section('content')
    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="flex-1 flex flex-col max-h-screen">

        <!-- Wrap in scrollable area -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto space-y-8">

                <!-- Header -->
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">Manajemen Akun Guru</h2>
                    <p class="text-gray-400">Manajemen dan monitoring Guru</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Card 1 -->
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-5 relative overflow-hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-indigo-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-300">Total Guru</h3>
                        </div>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-bold text-white">{{ $totalGuru }}</span>
                            {{-- <span class="text-xs font-medium text-green-400 bg-green-400/10 px-2 py-0.5 rounded flex items-center mb-1">↑ 5%</span> --}}
                        </div>
                        {{-- <p class="text-xs text-gray-500 mt-2">orang</p> --}}
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-purple-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-300">Guru Aktif</h3>
                        </div>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-bold text-white">{{ $guruAktif }}</span>
                            {{-- <span class="text-xs font-medium text-red-400 bg-red-400/10 px-2 py-0.5 rounded flex items-center mb-1">↓ 5%</span> --}}
                        </div>
                        {{-- <p class="text-xs text-gray-500 mt-2">vs last semester</p> --}}
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-indigo-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-300">Guru Tidak Aktif</h3>
                        </div>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-bold text-white">{{ $guruTidakAktif }}</span>
                            {{-- <span class="text-xs font-medium text-green-400 bg-green-400/10 px-2 py-0.5 rounded flex items-center mb-1">↑ 4%</span> --}}
                        </div>
                        {{-- <p class="text-xs text-gray-500 mt-2">This semester</p> --}}
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-indigo-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-300">Akun Baru</h3>
                        </div>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-bold text-white">{{ $guruBaru }}</span>
                        </div>
                        {{-- <p class="text-xs text-gray-500 mt-2">This semester</p> --}}
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <!-- Filters & Search -->
                    <form method="GET" action="{{ route('superadmin.guru') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">

                        <!-- Input Search -->
                        <div class="relative flex-1 max-w-xs">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>

                            <!-- Tambahkan name="search" dan value bawaan dari request -->
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau NIG..."
                                class="w-full bg-[#1e243b] border border-slate-600 text-sm text-white rounded-lg pl-10 pr-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-500">
                        </div>
                        <select name="jenis_kelamin" onchange="this.form.submit()"
                                class="bg-[#1e243b] border border-slate-600 text-sm text-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none appearance-none pr-8 cursor-pointer">
                            <option value="">Semua Gender</option>
                            <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Pria</option>
                            <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Wanita</option>
                        </select>
                        <select name="status" onchange="this.form.submit()"
                                class="bg-[#1e243b] border border-slate-600 text-sm text-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none appearance-none pr-8 cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>

                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                            Cari
                        </button>

                        @if(request('search') || request('jenis_kelamin') || request('status'))
                            <a href="{{ route('superadmin.guru') }}" class="text-sm text-red-400 hover:text-red-300 px-2 py-2 flex items-center gap-1 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Reset
                            </a>
                        @endif
                    </form>
                    <div class="shrink-0 w-full md:w-auto mt-4 md:mt-0">
                            <a href="{{ route('superadmin.guru.create') }}"
                            class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors shadow-lg shadow-green-500/20 w-full md:w-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Guru Baru
                            </a>
                        </div>
                    </div>

                <!-- Data Table -->
                <div class="bg-[#1e243b] border border-slate-600 rounded-xl overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-400 bg-[#1e243b] border-b border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-4 w-10">
                                    <input type="checkbox" class="rounded border-slate-600 bg-slate-800 text-indigo-500 focus:ring-indigo-500">
                                </th>
                                <th scope="col" class="px-6 py-4 font-medium">NIG</th>
                                <th scope="col" class="px-6 py-4 font-medium">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-4 font-medium">Jumlah Sub Wilayah</th>
                                <th scope="col" class="px-6 py-4 font-medium">Jenis Kelamin</th>
                                <th scope="col" class="px-6 py-4 font-medium">Status</th>
                                <th scope="col" class="px-6 py-4 font-medium"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                        @forelse ($guru as $data)
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="rounded border-slate-600 bg-slate-800 text-indigo-500">
                                </td>
                                <td class="px-6 py-4 text-white">{{ $data->nomor_induk }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $data->avatar_url }}" alt="Avatar {{ $data->nama }}" class="w-8 h-8 rounded-full object-cover">
                                        <span class="text-white font-medium">{{ $data->nama }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $data->sub_wilayahs_count }}</td>
                                <td class="px-6 py-4">
                                    @if ($data->jenis_kelamin == 'L')
                                        <div class="flex items-center gap-2 text-blue-400">
                                            <!-- Ikon Mars (Laki-laki) -->
                                            <div class="w-7 h-7 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="10" cy="14" r="5"></circle>
                                                    <line x1="13.5" y1="10.5" x2="21" y2="3"></line>
                                                    <polyline points="16 3 21 3 21 8"></polyline>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-medium">Laki-laki</span>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 text-pink-400">
                                            <!-- Ikon Venus (Perempuan) -->
                                            <div class="w-7 h-7 rounded-full bg-pink-500/10 border border-pink-500/20 flex items-center justify-center">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="10" r="5"></circle>
                                                    <line x1="12" y1="15" x2="12" y2="22"></line>
                                                    <line x1="9" y1="19" x2="15" y2="19"></line>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-medium">Perempuan</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if ($data->status == 'aktif')
                                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                            <span class="text-xs font-medium">Aktif</span>
                                        @else
                                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                            <span class="text-xs font-medium">Tidak Aktif</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('superadmin.guru.edit', $data->id) }}" class="text-gray-400 hover:text-indigo-400 transition" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <!-- Tombol Hapus (Harus menggunakan Form karena method DELETE) -->
                                        <form action="{{ route('superadmin.guru.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete('{{ $data->id }}', '{{ $data->name }}')" class="text-gray-400 hover:text-red-400 transition" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                             <!-- Pastikan colspan sesuai dengan jumlah kolom (<th>) tabel Anda (Di contoh sebelumnya ada 8 kolom) -->
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">

                                        <!-- Ikon Empty State (Ilustrasi Kotak Kosong/Dokumen) -->
                                        <div class="w-24 h-24 bg-slate-800/50 rounded-full flex items-center justify-center mb-4 border border-slate-700">
                                            <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                        </div>

                                        <!-- Teks Informasi -->
                                        <h3 class="text-lg font-medium text-white mb-1 font-heading">Belum Ada Data Guru</h3>
                                        <p class="text-sm text-gray-400 max-w-sm mx-auto mb-6">
                                            Saat ini belum ada data guru yang terdaftar di dalam sistem. Anda bisa menambahkannya secara manual atau mengimpor data.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <!-- --- AKHIR TAMPILAN DATA KOSONG --- -->
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- ==================== FOOTER / LOGS & PAGINATION ==================== -->
        <div class="border-t border-slate-700 bg-[#151b2b]">
            <!-- Terminal Log Ticker -->
            <div class="px-6 py-2 border-b border-slate-700 font-soal text-[11px] text-gray-400 tracking-wider flex gap-4 overflow-hidden whitespace-nowrap">
                <span>> [10:08:00] SUCCESS: SuperAdmin_Raka created new class "X-TKJ-2"</span>
                <span>> [10:08:05] UPDATE: User ID 20260001 status changed to Inactive</span>
            </div>

            <!-- Pagination -->
            <div class="mt-8 mb-8 w-full flex justify-center">
                {{ $guru->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </main>

<script>
    // 1. Fungsi Konfirmasi Hapus
    function confirmDelete(id, guruName) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: "Data guru <span class='font-bold text-indigo-400'>" + guruName + "</span> akan dihapus secara permanen dan tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Warna merah (Tailwind red-500)
            cancelButtonColor: '#4b5563',  // Warna abu-abu (Tailwind gray-600)
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#1e243b', // Menyesuaikan warna card dark mode Anda
            color: '#ffffff' // Warna teks putih
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user menekan tombol 'Ya', eksekusi form submit
                document.getElementById('deleteForm-' + id).submit();
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                background: '#1e243b',
                color: '#ffffff',
                showConfirmButton: false,
                timer: 2500 // Hilang otomatis setelah 2.5 detik
            });
        @endif
    });
</script>
@endsection

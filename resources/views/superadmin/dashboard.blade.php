@extends('layouts.superadmin')
@section('content')
    <div class="p-8">
        <div class="max-w-7xl mx-auto">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-white">Dashboard Command Center</h1>
        <p class="text-gray-400 mt-1">Selamat datang kembali, kelola ringkasan sistem Anda di sini.</p>
    </div>

    <!-- ========================================== -->
    <!-- PERINGATAN KRITIS (ACTIONABLE ALERTS) -->
    <!-- ========================================== -->
    @if($siswaTanpaKelas > 0 || $kelasTanpaWali > 0)
    <div class="mb-6 space-y-3">

        <!-- Alert Siswa Tanpa Kelas -->
        @if($siswaTanpaKelas > 0)
        <div class="flex items-center justify-between p-4 bg-amber-500/10 border border-amber-500/30 rounded-xl">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-amber-500/20 rounded-lg text-amber-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Siswa Membutuhkan Kelas</h4>
                    <p class="text-sm text-amber-400/80">Ada <strong>{{ $siswaTanpaKelas }} siswa</strong> aktif yang belum ditempatkan di kelas manapun.</p>
                </div>
            </div>
            <a href="{{ route('superadmin.siswa') }}" class="text-sm font-medium text-amber-400 bg-amber-500/10 hover:bg-amber-500/20 px-4 py-2 rounded-lg transition-colors border border-amber-500/20 whitespace-nowrap">Tindak Lanjuti</a>
        </div>
        @endif

        <!-- Alert Kelas Tanpa Wali (Opsional, jika Anda ingin menambahkannya) -->
        @if($kelasTanpaWali > 0)
        <div class="flex items-center justify-between p-4 bg-red-500/10 border border-red-500/30 rounded-xl">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-red-500/20 rounded-lg text-red-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Kelas Tanpa Wali Guru</h4>
                    <p class="text-sm text-red-400/80">Ada <strong>{{ $kelasTanpaWali }} kelas</strong> yang belum memiliki wali kelas.</p>
                </div>
            </div>
            <a href="{{ route('superadmin.wilayah') }}" class="text-sm font-medium text-red-400 bg-red-500/10 hover:bg-red-500/20 px-4 py-2 rounded-lg transition-colors border border-red-500/20 whitespace-nowrap">Tindak Lanjuti</a>
        </div>
        @endif

    </div>
    @endif

    <!-- ========================================== -->
    <!-- KARTU RINGKASAN (TOP CARDS) -->
    <!-- ========================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <!-- Card 1: Total Siswa -->
        <div class="bg-[#1e243b] border border-slate-600/50 rounded-2xl p-5 hover:border-indigo-500/50 transition-colors shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400 mb-1">Total Siswa Aktif</p>
                    <h3 class="text-3xl font-bold text-white">{{ $totalSiswa }}</h3>
                </div>
                <div class="w-12 h-12 bg-indigo-500/10 rounded-full flex items-center justify-center border border-indigo-500/20 text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Guru -->
        <div class="bg-[#1e243b] border border-slate-600/50 rounded-2xl p-5 hover:border-emerald-500/50 transition-colors shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400 mb-1">Total Guru</p>
                    <h3 class="text-3xl font-bold text-white">{{ $totalGuru }}</h3>
                </div>
                <div class="w-12 h-12 bg-emerald-500/10 rounded-full flex items-center justify-center border border-emerald-500/20 text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Wilayah -->
        <div class="bg-[#1e243b] border border-slate-600/50 rounded-2xl p-5 hover:border-blue-500/50 transition-colors shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400 mb-1">Total Wilayah</p>
                    <h3 class="text-3xl font-bold text-white">{{ $totalWilayah }}</h3>
                </div>
                <div class="w-12 h-12 bg-blue-500/10 rounded-full flex items-center justify-center border border-blue-500/20 text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 4: Total Kelas -->
        <div class="bg-[#1e243b] border border-slate-600/50 rounded-2xl p-5 hover:border-purple-500/50 transition-colors shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-400 mb-1">Total Kelas</p>
                    <h3 class="text-3xl font-bold text-white">{{ $totalKelas }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center border border-purple-500/20 text-purple-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
        </div>

    </div>

    <!-- AREA UNTUK GRAFIK (CHART) NANTINYA -->
    <div id="chart-area" class="w-full">
        <!-- ========================================== -->
        <!-- AREA GRAFIK (CHART.JS) -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            <!-- Grafik Rasio Gender (Mengambil 1 kolom) -->
            <div class="bg-[#1e243b] border border-slate-600/50 rounded-2xl p-5 shadow-sm col-span-1">
                <h3 class="text-lg font-bold text-white mb-4">Rasio Gender Siswa</h3>

                <!-- Tempat Chart Berada -->
                <div class="relative h-64 w-full flex justify-center">
                    <canvas id="genderChart"></canvas>
                </div>

                <!-- Keterangan Legend Kustom -->
                <div class="flex justify-center gap-6 mt-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                        <span class="text-sm text-gray-400">Laki-laki ({{ $siswaLaki }})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-pink-500"></span>
                        <span class="text-sm text-gray-400">Perempuan ({{ $siswaPerempuan }})</span>
                    </div>
                </div>
            </div>

            <!-- Ruang Kosong untuk Grafik Lain Nanti (Mengambil 2 kolom) -->
            <div class="bg-[#1e243b] border border-slate-600/50 rounded-2xl p-5 shadow-sm col-span-1 lg:col-span-2 flex items-center justify-center">
                <div class="bg-[#1e243b] border border-slate-600/50 rounded-2xl p-5 shadow-sm col-span-1 lg:col-span-2">
                    <h3 class="text-lg font-bold text-white mb-4">Distribusi Siswa per Kelas</h3>

                    <div class="relative h-64 w-full">
                        <!-- Elemen Canvas Baru -->
                        <canvas id="kelasChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<!-- Panggil CDN Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen canvas
        const ctx = document.getElementById('genderChart').getContext('2d');

        // Buat Chart
        new Chart(ctx, {
            type: 'doughnut', // Tipe grafik donat
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    // Masukkan variabel dari PHP/Controller ke JavaScript
                    data: [{{ $siswaLaki }}, {{ $siswaPerempuan }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)', // Biru Tailwind (blue-500)
                        'rgba(236, 72, 153, 0.8)'  // Pink Tailwind (pink-500)
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(236, 72, 153, 1)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%', // Ketebalan donat
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend bawaan karena kita sudah buat yang kustom di HTML
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)', // Warna dark mode
                        titleColor: '#fff',
                        bodyColor: '#cbd5e1',
                        borderColor: 'rgba(71, 85, 105, 0.5)',
                        borderWidth: 1,
                        padding: 10
                    }
                }
            }
        });
    });
    // ==========================================
    // 2. GRAFIK BATANG (DISTRIBUSI KELAS)
    // ==========================================
    const ctxKelas = document.getElementById('kelasChart').getContext('2d');

    new Chart(ctxKelas, {
        type: 'bar',
        data: {
            // Gunakan sintaks !! json_encode() !! agar array PHP berubah jadi array JavaScript
            labels: {!! json_encode($labelKelas) !!},
            datasets: [{
                label: 'Jumlah Siswa',
                data: {!! json_encode($dataSiswaKelas) !!},
                backgroundColor: 'rgba(99, 102, 241, 0.8)', // Warna Indigo Tailwind
                borderColor: 'rgba(99, 102, 241, 1)',
                borderWidth: 1,
                borderRadius: 6, // Membuat ujung batang grafik melengkung halus
                barPercentage: 0.6 // Mengatur ketebalan batang
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Sembunyikan tulisan 'Jumlah Siswa' di atas karena sudah jelas
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#cbd5e1',
                    padding: 10
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#94a3b8', // Warna teks angka sumbu Y
                        stepSize: 5 // Jarak kelipatan angka
                    },
                    grid: {
                        color: 'rgba(71, 85, 105, 0.2)' // Warna garis horizontal
                    }
                },
                x: {
                    ticks: {
                        color: '#94a3b8' // Warna teks nama kelas sumbu X
                    },
                    grid: {
                        display: false // Hilangkan garis vertikal agar lebih bersih
                    }
                }
            }
        }
    });
</script>
@endsection

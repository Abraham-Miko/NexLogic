@extends('layouts.guru')
@section('content')
<div class="p-8">
    <!-- Header Page -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-white">{{ $kelas->nama_sub_wilayah }}</h2>
            <p class="text-sm text-gray-400">Jurusan: {{ $kelas->wilayah->nama_wilayah }}</p>
            <div class="flex items-center gap-2 mt-2">
            <!-- Area Kode dengan desain menonjol -->
            <div class="flex items-center bg-[#111827] border border-slate-600/60 rounded-md overflow-hidden">
                <span class="px-3 py-1.5 text-sm font-mono font-medium text-indigo-300 tracking-wider">
                    Kode : {{ $kelas->kode_sub_wilayah }}
                </span>
                <button onclick="copyKode('{{ $kelas->kode_sub_wilayah }}', this)"
                        class="p-1.5 bg-slate-700/50 hover:bg-indigo-600 transition-colors border-l border-slate-600/60"
                        title="Salin Kode">
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
        </div>

        <button onclick="openModalTambahSiswa()" class="bg-[#4c489d] hover:bg-[#5b56b6] text-white px-5 py-2 rounded-lg font-bold shadow-[0_0_15px_rgba(76,72,157,0.3)] transition">
            + Tambah Siswa
        </button>
    </div>
    <!-- Container Filter & Search -->
    <div class="flex flex-wrap items-center gap-4 mb-6">

        <!-- Kolom Search (Nama/NISN) -->
        <div class="relative flex-1 min-w-[250px]">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" id="searchSiswa" placeholder="Cari Nama atau NISN..."
                class="block w-full pl-10 pr-3 py-2.5 bg-[#1f2937] border border-slate-700 rounded-lg text-sm text-white focus:outline-none focus:border-[#4c489d] focus:ring-1 focus:ring-[#4c489d] transition-all">
        </div>

        <!-- Filter Jenis Kelamin -->
        <div class="w-44">
            <select id="filterJK" class="w-full bg-[#1f2937] border border-slate-700 text-gray-300 text-sm rounded-lg focus:ring-[#4c489d] focus:border-[#4c489d] p-2.5 outline-none transition-all">
                <option value="all">Semua Gender</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <!-- Filter Nilai Pre-Test -->
        <div class="w-44">
            <select id="filterPreTest" class="w-full bg-[#1f2937] border border-slate-700 text-gray-300 text-sm rounded-lg focus:ring-[#4c489d] focus:border-[#4c489d] p-2.5 outline-none transition-all">
                <option value="all">Nilai Pre-Test</option>
                <option value=">=75">>= 75 (Tuntas)</option>
                <option value="<75">< 75 (Remedial)</option>
                <option value="<50">< 50 (Perlu Bimbingan)</option>
            </select>
        </div>

        <!-- Filter Nilai Post-Test -->
        <div class="w-44">
            <select id="filterPostTest" class="w-full bg-[#1f2937] border border-slate-700 text-gray-300 text-sm rounded-lg focus:ring-[#4c489d] focus:border-[#4c489d] p-2.5 outline-none transition-all">
                <option value="all">Nilai Post-Test</option>
                <option value=">=75">>= 75 (Tuntas)</option>
                <option value="<75">< 75 (Remedial)</option>
                <option value="<50">< 50 (Perlu Bimbingan)</option>
            </select>
        </div>
    </div>
    <!-- Tabel Siswa -->
    <div class="bg-[#111827] border border-slate-700 rounded-2xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-[#1f2937] text-gray-400 uppercase text-[10px] tracking-wider">
                <tr>
                    <th class="px-6 py-4">NIS</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Jenis Kelamin</th>
                    <th class="px-6 py-4">Nilai Pre-Test</th>
                    <th class="px-6 py-4">Nilai Post-Test</th>
                    <th class="px-6 py-4">Progress</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700 text-gray-300">
                @forelse($kelas->siswa as $siswa)
                    <tr class="hover:bg-gray-800/50 transition">
                        <td class="px-6 py-4 font-mono">{{ $siswa->nomor_induk }}</td>
                        <td class="px-6 py-4 font-medium text-white">
                            <div class="flex items-center gap-3">
                                <img src="{{ $siswa->avatar_url }}" alt="Avatar {{ $siswa->nama }}" class="w-8 h-8 rounded-full object-cover">
                                <span class="text-white font-medium">{{ $siswa->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4" data-gender="{{ $siswa->jenis_kelamin }}">
                            @if ($siswa->jenis_kelamin == 'L')
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
                        <td class="px-6 py-4 font-medium text-white">40</td>
                        <td class="px-6 py-4 font-medium text-white">90</td>
                        <td class="px-6 py-4 font-medium text-white">100%</td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-gray-400 hover:text-[#4c489d] transition">...</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <p class="text-gray-500 mb-4">Belum ada siswa di kelas ini.</p>
                                <button onclick="openModalTambahSiswa()" class="text-[#4c489d] font-bold hover:underline">Undang Siswa Sekarang</button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchSiswa');
    const filterJK = document.getElementById('filterJK');
    const filterPre = document.getElementById('filterPreTest');
    const filterPost = document.getElementById('filterPostTest');

    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const genderValue = filterJK.value;
        const preValue = filterPre.value;
        const postValue = filterPost.value;

        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            // Asumsi letak kolom (sesuaikan dengan urutan TD Anda):
            // cell[0]: NISN, cell[1]: Nama, cell[2]: JK, cell[3]: Pre-test, cell[4]: Post-test
            const nisn = row.cells[0].textContent.toLowerCase();
            const nama = row.cells[1].textContent.toLowerCase();
            const gender = row.cells[2].getAttribute('data-gender'); // Gunakan atribut data untuk kode L/P
            const preScore = parseFloat(row.cells[3].textContent) || 0;
            const postScore = parseFloat(row.cells[4].textContent) || 0;

            const matchesSearch = nisn.includes(searchTerm) || nama.includes(searchTerm);
            const matchesGender = genderValue === 'all' || gender === genderValue;

            const checkScore = (val, score) => {
                if (val === 'all') return true;
                if (val === '>=75') return score >= 75;
                if (val === '<75') return score < 75;
                if (val === '<50') return score < 50;
                return true;
            };

            if (matchesSearch && matchesGender && checkScore(preValue, preScore) && checkScore(postValue, postScore)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Jalankan filter setiap ada perubahan input
    [searchInput, filterJK, filterPre, filterPost].forEach(el => {
        el.addEventListener('input', applyFilters);
    });

    function copyKode(text, buttonElement) {
            // Fungsi kecil untuk mengubah ikon menjadi centang hijau
            const showSuccessIcon = () => {
                const originalIcon = buttonElement.innerHTML;
                buttonElement.innerHTML = `
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                `;
                setTimeout(() => {
                    buttonElement.innerHTML = originalIcon;
                }, 2000);
            };

            // CARA 1: Gunakan Clipboard API modern jika tersedia (HTTPS / localhost)
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(showSuccessIcon).catch(err => {
                    console.error('Gagal menyalin API: ', err);
                });
            }
            else {
                let textArea = document.createElement("textarea");
                textArea.value = text;

                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);

                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    showSuccessIcon();
                } catch (err) {
                    console.error('Gagal menyalin Fallback: ', err);
                    alert('Browser Anda menolak fitur salin otomatis.');
                }
                textArea.remove();
            }
        }
</script>
@endsection

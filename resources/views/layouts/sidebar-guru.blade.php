<!-- ==================== SIDEBAR GURU ==================== -->
<aside class="w-72 bg-[#111827] border-r border-slate-700 flex flex-col justify-between py-6 px-4 shrink-0 min-h-screen">
    <div>
        <!-- Logo -->
        <a href="{{ route('/') }}" class="ml-12 mb-10 block">
            <div class="w-32 h-auto mb-8">
                @include('components.application-logo')
            </div>
        </a>

        <!-- Navigation -->
        <nav class="space-y-1">

            <!-- 1. Overview / Dashboard -->
            <a href="/guru/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg transition
                {{ request()->is('guru/dashboard*')
                    ? 'bg-[#2d2a54] border border-[#4c489d] text-white shadow-[0_0_15px_rgba(76,72,157,0.3)]'
                    : 'border border-transparent text-gray-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="font-medium">Overview</span>
            </a>

            <!-- 2. Detail Kelas (Active Dropdown) -->
            <!-- x-data ditambahkan untuk animasi buka tutup jika Anda menggunakan Alpine.js -->
            <div x-data="{ open: true }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-400 hover:text-white rounded-lg transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        <span class="font-medium">Detail Kelas</span>
                    </div>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Sub-menu Dinamis -->
                <div x-show="open" class="ml-9 mt-1 border-l border-slate-600 pl-4 space-y-2 relative">

                    @php
                        $daftarKelas = Auth::user()->kelasYangDiampu()->with('wilayah')->get();
                    @endphp

                    @forelse ($daftarKelas as $kelas)
                        <!-- Wrapper Relative agar garis konektor bisa menempel pas di setiap item -->
                        <div class="relative">
                            <!-- Garis konektor melengkung dinamis -->
                            <div class="absolute w-4 h-6 border-b border-l border-slate-600 rounded-bl-lg -left-[17px] top-0"></div>

                            <a href="{{ route('guru.subwilayah.show', $kelas->id) }}" class="block px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative z-10
                                {{ request()->is('guru/kelas/' . $kelas->id . '*')
                                    ? 'bg-[#2d2a54] border border-[#4c489d] text-white shadow-[0_0_15px_rgba(76,72,157,0.3)]'
                                    : 'border border-transparent text-gray-400 hover:text-white' }}"
                                title="{{ $kelas->wilayah->nama_wilayah ?? '' }} - {{ $kelas->nama_sub_wilayah }}">

                                <span class="truncate block w-full max-w-[130px]">
                                    {{ $kelas->wilayah->nama_wilayah ?? 'Tanpa Wilayah' }} - {{ $kelas->nama_sub_wilayah }}
                                </span>
                            </a>
                        </div>
                    @empty
                        <div class="relative">
                            <div class="absolute w-4 h-6 border-b border-l border-slate-600 rounded-bl-lg -left-[17px] top-0"></div>
                            <span class="block px-4 py-2 text-xs text-gray-500 relative z-10">Belum ada kelas</span>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- 3. Content Manager -->
            <a href="/guru/content" class="flex items-center gap-3 px-4 py-3 rounded-lg transition
                {{ request()->is('guru/content*')
                    ? 'bg-[#2d2a54] border border-[#4c489d] text-white shadow-[0_0_15px_rgba(76,72,157,0.3)]'
                    : 'border border-transparent text-gray-400 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                <span class="font-medium">Content Manager</span>
            </a>
        </nav>
    </div>

    <!-- User Profile Footer -->
    <div class="w-full">
        <hr class="border-slate-700 mb-4 mx-4">

        <div class="flex items-center gap-3 px-4 mb-4">
            <div class="w-8 h-8 rounded-full bg-[#4c489d] flex items-center justify-center text-white font-bold text-sm shrink-0 shadow-[0_0_10px_rgba(76,72,157,0.5)]">
                {{ substr(Auth::user()->nama, 0, 1) }}
            </div>
            <div class="truncate">
                <p class="font-medium text-white truncate text-sm">{{ Auth::user()->nama }}</p>
                <p class="text-xs text-gray-400">Guru</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="px-2">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition border border-transparent text-gray-400 hover:text-red-400 hover:bg-red-500/10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>

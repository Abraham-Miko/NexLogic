<!-- ==================== SIDEBAR ==================== -->
    <aside class="w-72 bg-[#111827] border-r border-slate-700 flex flex-col justify-between py-6 px-4 shrink-0">
        <div>
            <!-- Logo -->
            <div class="flex items-center gap-3 px-4 mb-10">
                <div class="w-10 h-10 bg-gray-200 rounded-full shrink-0"></div>
                <div>
                    <p class="text-xs text-gray-400 leading-tight">Superadmin</p>
                    <h1 class="text-2xl font-bold text-white tracking-wide font-heading">NexLogic</h1>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-1">
                <a href="{{ route('superadmin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- User Management (Active Dropdown) -->
                <div>
                    <button class="w-full flex items-center justify-between px-4 py-3 text-white rounded-lg transition">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="font-medium">User Management</span>
                        </div>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <!-- Sub-menu -->
                    <div class="ml-9 mt-1 border-l border-slate-600 pl-4 space-y-2 relative">
                        <!-- Garis konektor melengkung -->
                        <div class="absolute w-4 h-4 border-b border-l border-slate-600 rounded-bl-lg -left-[1px] top-1"></div>
                        <a href="{{ route('superadmin.siswa') }}" class="block px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative z-10
                        {{ request()->routeIs('superadmin.siswa*')
                            ? 'bg-[#2d2a54] border border-[#4c489d] text-white shadow-[0_0_15px_rgba(76,72,157,0.3)]'
                            : 'border border-transparent text-gray-400 hover:text-white' }}">Murid</a>
                        <div class="absolute w-4 h-4 border-b border-l border-slate-600 rounded-bl-lg -left-[1px] top-10"></div>
                        <a href="{{ route('superadmin.guru') }}" class="block px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative z-10
                        {{ request()->routeIs('superadmin.guru*')
                            ? 'bg-[#2d2a54] border border-[#4c489d] text-white shadow-[0_0_15px_rgba(76,72,157,0.3)]'
                            : 'border border-transparent text-gray-400 hover:text-white' }}">Guru</a>
                    </div>
                </div>

                <a href="#" class="flex items-center justify-between px-4 py-3 text-gray-400 hover:text-white rounded-lg transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                        <span class="font-medium">Manajemen Wilayah</span>
                    </div>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    <span class="font-medium">Region Control</span>
                </a>
            </nav>
        </div>

        <!-- User Profile Footer -->
        <div class="flex items-center gap-3 px-4">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span class="font-medium text-white">Super Admin</span>
        </div>
    </aside>

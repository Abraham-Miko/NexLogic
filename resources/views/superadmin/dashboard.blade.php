@extends('layouts.superadmin')
@section('content')
    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="flex-1 flex flex-col max-h-screen">

        <!-- Wrap in scrollable area -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto space-y-8">

                <!-- Header -->
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">Dashboard Superadmin</h2>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Card 1 -->
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-5 relative overflow-hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-indigo-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-300">Total Siswa</h3>
                        </div>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-bold text-white">521</span>
                            <span class="text-xs font-medium text-green-400 bg-green-400/10 px-2 py-0.5 rounded flex items-center mb-1">↑ 5%</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">vs last year</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-purple-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-300">Siswa Aktif</h3>
                        </div>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-bold text-white">486</span>
                            <span class="text-xs font-medium text-red-400 bg-red-400/10 px-2 py-0.5 rounded flex items-center mb-1">↓ 5%</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">vs last semester</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-indigo-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-300">Sedang Cuti</h3>
                        </div>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-bold text-white">12</span>
                            <span class="text-xs font-medium text-green-400 bg-green-400/10 px-2 py-0.5 rounded flex items-center mb-1">↑ 4%</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">This semester</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-[#1e243b] border border-slate-600 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-indigo-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-300">Rata-rata Nilai</h3>
                        </div>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-bold text-white">92%</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">This semester</p>
                    </div>
                </div>
            </div>
    </main>
@endsection

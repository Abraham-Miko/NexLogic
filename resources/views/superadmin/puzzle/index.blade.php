<x-guest-layout>
    <style>
        .font-orbitron { font-family: 'Orbitron', sans-serif; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
        .admin-bg {
            background-color: #080e1a;
            background-image:
                linear-gradient(rgba(168,85,247,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(168,85,247,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            min-height: 100vh;
        }
    </style>

    <div class="admin-bg py-8 px-4">
        <div class="max-w-6xl mx-auto">

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-900/30 border border-green-500/30 text-green-300 px-5 py-3 rounded-xl font-mono-code text-sm"
                 x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-purple-400 font-mono-code text-xs tracking-widest uppercase mb-1">Super Admin Panel</p>
                    <h1 class="font-orbitron text-2xl font-black text-white">Manajemen Puzzle</h1>
                    <p class="text-slate-500 font-mono-code text-xs mt-1">{{ $puzzle->total() }} puzzle terdaftar</p>
                </div>

                <a href="{{ route('superadmin.puzzle.create') }}"
                   class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-500 text-white font-mono-code text-sm px-5 py-2.5 rounded-xl transition-all"
                   style="box-shadow: 0 0 20px rgba(168,85,247,0.3);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Puzzle
                </a>
            </div>

            {{-- Table --}}
            <div class="bg-[#0b1120] border border-slate-800 rounded-2xl overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-800 bg-[#0f172a]">
                            <th class="px-6 py-4 text-left font-mono-code text-xs text-slate-500 uppercase tracking-wider">Level</th>
                            <th class="px-6 py-4 text-left font-mono-code text-xs text-slate-500 uppercase tracking-wider">Pertanyaan</th>
                            <th class="px-6 py-4 text-left font-mono-code text-xs text-slate-500 uppercase tracking-wider">Snippet</th>
                            <th class="px-6 py-4 text-left font-mono-code text-xs text-slate-500 uppercase tracking-wider">Jawaban</th>
                            <th class="px-6 py-4 text-center font-mono-code text-xs text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse($puzzle as $puzzle)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 font-orbitron font-bold text-sm">
                                    {{ $puzzle->level }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-slate-200 font-mono-code text-sm truncate max-w-xs">{{ $puzzle->pertanyaan }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($puzzle->kode_snippet)
                                <span class="inline-flex items-center gap-1 bg-green-500/10 border border-green-500/20 text-green-400 px-2.5 py-1 rounded-full font-mono-code text-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                    Ada
                                </span>
                                @else
                                <span class="text-slate-600 font-mono-code text-xs">–</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 text-blue-400 font-orbitron font-bold text-sm">
                                    {{ $puzzle->jawaban_benar }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('superadmin.puzzle.edit', $puzzle) }}"
                                       class="inline-flex items-center gap-1.5 bg-blue-600/15 hover:bg-blue-600/30 border border-blue-600/20 text-blue-400 font-mono-code text-xs px-3 py-1.5 rounded-lg transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('superadmin.puzzle.destroy', $puzzle) }}" method="POST"
                                          onsubmit="return confirm('Hapus Puzzle Level {{ $puzzle->level }}? Tindakan ini tidak bisa dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1.5 bg-red-600/10 hover:bg-red-600/25 border border-red-600/20 text-red-400 font-mono-code text-xs px-3 py-1.5 rounded-lg transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="text-slate-700 mb-3">
                                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                                    </svg>
                                </div>
                                <p class="font-orbitron text-slate-600">Belum ada puzzle</p>
                                <a href="{{ route('superadmin.puzzle.create') }}" class="font-mono-code text-purple-400 hover:text-purple-300 text-sm mt-2 inline-block transition-colors">
                                    Buat puzzle pertama →
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($puzzle->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $puzzle->links() }}
            </div>
            @endif

        </div>
    </div>
</x-guest-layout>

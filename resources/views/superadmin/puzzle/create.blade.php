<x-guest-layout>
    <style>
        .font-orbitron  { font-family: 'Orbitron', sans-serif; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
        .admin-bg {
            background-color: #080e1a;
            background-image:
                linear-gradient(rgba(168,85,247,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(168,85,247,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            min-height: 100vh;
        }
        .form-card {
            background: #0b1120;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 28px;
        }
        .field-group label {
            display: block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
        }
        .field-input {
            width: 100%;
            background: #020817;
            border: 1px solid #1e293b;
            border-radius: 10px;
            padding: 12px 14px;
            color: #e2e8f0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            transition: all 0.2s ease;
            outline: none;
        }
        .field-input:focus {
            border-color: rgba(168,85,247,0.5);
            box-shadow: 0 0 0 3px rgba(168,85,247,0.1);
        }
        .field-input.is-invalid {
            border-color: rgba(239,68,68,0.5);
            box-shadow: 0 0 0 3px rgba(239,68,68,0.08);
        }
        .field-input::placeholder { color: #334155; }
        select.field-input option { background: #0f172a; }
        textarea.field-input { resize: vertical; min-height: 100px; }

        .error-msg {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #f87171;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .jawaban-radio {
            display: flex;
            gap: 10px;
        }
        .jawaban-option {
            flex: 1;
            position: relative;
        }
        .jawaban-option input[type="radio"] { display: none; }
        .jawaban-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 12px;
            background: #020817;
            border: 1px solid #1e293b;
            border-radius: 10px;
            cursor: pointer;
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px;
            font-weight: 700;
            color: #475569;
            transition: all 0.2s;
        }
        .jawaban-option input:checked + label {
            background: rgba(168,85,247,0.12);
            border-color: rgba(168,85,247,0.5);
            color: #c084fc;
            box-shadow: 0 0 15px rgba(168,85,247,0.15);
        }
        .jawaban-option label:hover {
            background: rgba(168,85,247,0.07);
            border-color: rgba(168,85,247,0.3);
            color: #94a3b8;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #7e22ce, #a855f7);
            color: white;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 10px;
            transition: all 0.25s ease;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            box-shadow: 0 0 25px rgba(168,85,247,0.4);
            transform: translateY(-1px);
        }
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #64748b;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid #1e293b;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background: #0f172a;
            color: #94a3b8;
            border-color: #334155;
        }
    </style>

    <div class="admin-bg py-8 px-4">
        <div class="max-w-3xl mx-auto">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 font-mono-code text-xs text-slate-600 mb-6">
                <a href="{{ route('superadmin.puzzles.index') }}" class="hover:text-purple-400 transition-colors">Puzzle</a>
                <span>›</span>
                <span class="text-purple-400">Tambah Puzzle Baru</span>
            </div>

            {{-- Header --}}
            <div class="mb-8">
                <p class="text-purple-400 font-mono-code text-xs tracking-widest uppercase mb-1">Super Admin</p>
                <h1 class="font-orbitron text-2xl font-black text-white">Tambah Puzzle Baru</h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('superadmin.puzzles.store') }}" method="POST">
                @csrf

                <div class="space-y-6">

                    {{-- Level --}}
                    <div class="form-card">
                        <h2 class="font-orbitron text-sm text-purple-400 mb-5 tracking-wide">Informasi Dasar</h2>

                        <div class="field-group">
                            <label for="level">Nomor Level <span class="text-red-400">*</span></label>
                            <input type="number" id="level" name="level"
                                   value="{{ old('level', $nextLevel) }}" min="1"
                                   class="field-input @error('level') is-invalid @enderror"
                                   placeholder="1">
                            @error('level')
                            <p class="error-msg">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Konten Soal --}}
                    <div class="form-card">
                        <h2 class="font-orbitron text-sm text-blue-400 mb-5 tracking-wide">Konten Soal</h2>

                        <div class="field-group mb-5">
                            <label for="pertanyaan">Pertanyaan <span class="text-red-400">*</span></label>
                            <textarea id="pertanyaan" name="pertanyaan"
                                      class="field-input @error('pertanyaan') is-invalid @enderror"
                                      placeholder="Tulis pertanyaan puzzle di sini...">{{ old('pertanyaan') }}</textarea>
                            @error('pertanyaan')
                            <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="kode_snippet">Code Snippet <span class="text-slate-600">(opsional)</span></label>
                            <textarea id="kode_snippet" name="kode_snippet"
                                      style="min-height: 120px; background: #020817; font-size: 12px;"
                                      class="field-input @error('kode_snippet') is-invalid @enderror"
                                      placeholder="print('Hello, World!')&#10;# Tulis kode snippet di sini">{{ old('kode_snippet') }}</textarea>
                            @error('kode_snippet')
                            <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Pilihan Jawaban --}}
                    <div class="form-card">
                        <h2 class="font-orbitron text-sm text-green-400 mb-5 tracking-wide">Opsi Jawaban</h2>

                        <div class="grid grid-cols-1 gap-4">
                            @foreach(['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $key => $label)
                            <div class="field-group mb-0">
                                <label for="opsi_{{ $key }}">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-slate-700 text-slate-300 text-xs mr-1">{{ $label }}</span>
                                    Opsi {{ $label }} <span class="text-red-400">*</span>
                                </label>
                                <input type="text" id="opsi_{{ $key }}" name="opsi_{{ $key }}"
                                       value="{{ old('opsi_' . $key) }}"
                                       class="field-input @error('opsi_' . $key) is-invalid @enderror"
                                       placeholder="Teks opsi jawaban {{ $label }}...">
                                @error('opsi_' . $key)
                                <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                                @enderror
                            </div>
                            @endforeach
                        </div>

                        {{-- Jawaban Benar --}}
                        <div class="field-group mt-5">
                            <label>Jawaban Benar <span class="text-red-400">*</span></label>
                            <div class="jawaban-radio">
                                @foreach(['A', 'B', 'C', 'D'] as $opt)
                                <div class="jawaban-option">
                                    <input type="radio" id="jawaban_{{ $opt }}" name="jawaban_benar"
                                           value="{{ $opt }}" {{ old('jawaban_benar') === $opt ? 'checked' : '' }}>
                                    <label for="jawaban_{{ $opt }}">{{ $opt }}</label>
                                </div>
                                @endforeach
                            </div>
                            @error('jawaban_benar')
                            <p class="error-msg mt-2"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Petunjuk --}}
                    <div class="form-card">
                        <h2 class="font-orbitron text-sm text-yellow-400 mb-5 tracking-wide">Petunjuk Siswa</h2>

                        <div class="field-group">
                            <label for="petunjuk">Teks Petunjuk <span class="text-red-400">*</span></label>
                            <textarea id="petunjuk" name="petunjuk"
                                      class="field-input @error('petunjuk') is-invalid @enderror"
                                      placeholder="Tulis petunjuk yang membantu siswa menemukan jawaban tanpa memberitahu langsung...">{{ old('petunjuk') }}</textarea>
                            @error('petunjuk')
                            <p class="error-msg"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-4 pt-2 pb-8">
                        <button type="submit" class="btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Simpan Puzzle
                        </button>
                        <a href="{{ route('superadmin.puzzles.index') }}" class="btn-secondary">
                            Batal
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-guest-layout>

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wilayah;
use App\Models\SubWilayah;
use App\Models\BankSoal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index() {
        $user = Auth::user();

        // Ambil semua wilayah yang sudah diikuti oleh guru ini
        $daftarWilayah = $user->wilayahYangDitempati()->get();

        return view('guru.dashboard', compact('daftarWilayah'));
    }
    public function joinWilayah(Request $request) {
        // 1. Validasi input
        $request->validate([
            'kode_wilayah' => 'required|string'
        ]);

        // 2. Cari wilayah berdasarkan kode yang diinput
        $wilayah = Wilayah::where('kode_wilayah', $request->kode_wilayah)->first();

        // 3. Jika kode tidak ditemukan
        if (!$wilayah) {
            return back()->with('error', 'Kode Wilayah tidak valid atau tidak ditemukan!');
        }

        // 4. Jika ditemukan, masukkan ke tabel pivot (guru_wilayah)
        $user = Auth::user();

        // syncWithoutDetaching mencegah error atau data ganda jika guru secara tidak sengaja
        // memasukkan kode wilayah yang sama dua kali.
        $user->wilayahYangDitempati()->syncWithoutDetaching([$wilayah->id]);

        // 5. Kembalikan ke halaman dashboard dengan pesan sukses
        return redirect()->back()->with('success', 'Berhasil bergabung dengan wilayah ' . $wilayah->nama_wilayah);
    }

    public function createSubwilayah(Request $request)
    {
        // Mengambil id wilayah dari parameter URL (?wilayah_id=...)
        $wilayahId = $request->query('wilayah_id');

        // Mencari data wilayah tersebut untuk ditampilkan namanya di form
        $wilayah = \App\Models\Wilayah::findOrFail($wilayahId);

        return view('guru.subwilayah.create', compact('wilayah'));
    }

    public function storeSubwilayah(Request $request)
    {
        $request->validate([
            'nama_sub_wilayah' => 'required|string|max:30',
            'kode_sub_wilayah' => 'required|string|max:20|unique:sub_wilayah,kode_sub_wilayah',
            'wilayah_id' => 'required|exists:wilayah,id'
        ]);

        // Membuat Sub Wilayah (Kelas) baru
        \App\Models\SubWilayah::create([
            'nama_sub_wilayah' => $request->nama_sub_wilayah,
            'kode_sub_wilayah' => strtoupper($request->kode_sub_wilayah),
            'wilayah_id' => $request->wilayah_id,
            'guru_id' => Auth::user()->id, // Otomatis menjadi milik guru yang login
        ]);

        return redirect()->route('guru.dashboard')->with('success', 'Kelas berhasil dibuat!');
    }

    public function showSubWilayah($id) {
        // Mengambil data kelas dan user yang berperan sebagai siswa di kelas tersebut
        $kelas = \App\Models\SubWilayah::with('siswa')->findOrFail($id);

        // Keamanan: Pastikan guru yang login adalah pemilik kelas ini
        if ($kelas->guru_id !== auth()->id()) {
            abort(403);
        }

        return view('guru.subwilayah.index', compact('kelas'));
    }

    // --- CONTENT MANAGER ---
    public function contentManager()
    {
        $user = Auth::user();
        $daftarKelas = $user->kelasYangDiampu()->with('wilayah')->get();
        return view('guru.content-manager', compact('daftarKelas'));
    }

    public function contentKelas($sub_wilayah_id)
    {
        $kelas = SubWilayah::where('id', $sub_wilayah_id)->where('guru_id', Auth::id())->firstOrFail();
        
        $judulMateri = [
            1 => 'Variabel & Tipe Data',
            2 => 'Operator & Ekspresi',
            3 => 'Input & Output',
            4 => 'Percabangan (if/else)',
            5 => 'Perulangan (for & while)',
            6 => 'Fungsi & Parameter',
        ];

        $materiData = [];
        for ($i = 1; $i <= 6; $i++) {
            $preTestCount = BankSoal::where('sub_wilayah_id', $sub_wilayah_id)
                                    ->where('materi_ke', $i)
                                    ->where('jenis_soal', 'pre_test')
                                    ->count();
            
            $postTestCount = BankSoal::where('sub_wilayah_id', $sub_wilayah_id)
                                     ->where('materi_ke', $i)
                                     ->where('jenis_soal', 'post_test')
                                     ->count();
                                     
            $materiField = 'materi_' . $i . '_aktif';
            
            $materiData[] = [
                'materi_ke' => $i,
                'judul' => $judulMateri[$i],
                'is_aktif' => (bool) $kelas->$materiField,
                'pre_test_count' => $preTestCount,
                'post_test_count' => $postTestCount,
                'can_activate' => ($preTestCount > 0 && $postTestCount > 0)
            ];
        }

        return response()->json([
            'kelas' => $kelas,
            'materi' => $materiData
        ]);
    }

    public function storeSoal(Request $request)
    {
        $request->validate([
            'sub_wilayah_id' => 'required|exists:sub_wilayah,id',
            'materi_ke' => 'required|integer|min:1|max:6',
            'jenis_soal' => 'required|in:pre_test,post_test',
            'soal' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $kelas = SubWilayah::findOrFail($request->sub_wilayah_id);
        if ($kelas->guru_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $soal = BankSoal::create($request->all());

        return response()->json([
            'message' => 'Soal berhasil disimpan',
            'data' => $soal
        ]);
    }

    public function getSoal($sub_wilayah_id, $materi_ke, $jenis_soal)
    {
        $kelas = SubWilayah::findOrFail($sub_wilayah_id);
        if ($kelas->guru_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $soal = BankSoal::where('sub_wilayah_id', $sub_wilayah_id)
                        ->where('materi_ke', $materi_ke)
                        ->where('jenis_soal', $jenis_soal)
                        ->get();

        return response()->json(['data' => $soal]);
    }

    public function deleteSoal($id)
    {
        $soal = BankSoal::findOrFail($id);
        
        $kelas = SubWilayah::findOrFail($soal->sub_wilayah_id);
        if ($kelas->guru_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $soal->delete();

        return response()->json(['message' => 'Soal berhasil dihapus']);
    }

    public function toggleMateri(Request $request)
    {
        $request->validate([
            'sub_wilayah_id' => 'required|exists:sub_wilayah,id',
            'materi_ke' => 'required|integer|min:1|max:6',
            'is_aktif' => 'required|boolean'
        ]);

        $kelas = SubWilayah::findOrFail($request->sub_wilayah_id);
        if ($kelas->guru_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Cek syarat jika mau diaktifkan
        if ($request->is_aktif) {
            $preTestCount = BankSoal::where('sub_wilayah_id', $kelas->id)
                                    ->where('materi_ke', $request->materi_ke)
                                    ->where('jenis_soal', 'pre_test')
                                    ->count();
            
            $postTestCount = BankSoal::where('sub_wilayah_id', $kelas->id)
                                     ->where('materi_ke', $request->materi_ke)
                                     ->where('jenis_soal', 'post_test')
                                     ->count();

            if ($preTestCount == 0 || $postTestCount == 0) {
                return response()->json(['message' => 'Lengkapi soal pre-test dan post-test terlebih dahulu!'], 400);
            }
        }

        $field = 'materi_' . $request->materi_ke . '_aktif';
        $kelas->$field = $request->is_aktif;
        $kelas->save();

        return response()->json(['message' => 'Status materi berhasil diperbarui']);
    }

    public function getCopyOptions($materi_ke, $jenis_soal)
    {
        $user = Auth::user();
        
        // Cari kelas lain milik guru ini yang punya soal untuk materi dan jenis soal tersebut
        $kelasLain = SubWilayah::where('guru_id', $user->id)
            ->whereHas('bankSoal', function ($query) use ($materi_ke, $jenis_soal) {
                $query->where('materi_ke', $materi_ke)
                      ->where('jenis_soal', $jenis_soal);
            })
            ->with('wilayah')
            ->get();

        return response()->json(['data' => $kelasLain]);
    }

    public function copySoal(Request $request)
    {
        $request->validate([
            'source_sub_wilayah_id' => 'required|exists:sub_wilayah,id',
            'target_sub_wilayah_id' => 'required|exists:sub_wilayah,id',
            'materi_ke' => 'required|integer|min:1|max:6',
            'jenis_soal' => 'required|in:pre_test,post_test'
        ]);

        $sourceKelas = SubWilayah::findOrFail($request->source_sub_wilayah_id);
        $targetKelas = SubWilayah::findOrFail($request->target_sub_wilayah_id);

        if ($sourceKelas->guru_id !== Auth::id() || $targetKelas->guru_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $soalSumber = BankSoal::where('sub_wilayah_id', $sourceKelas->id)
            ->where('materi_ke', $request->materi_ke)
            ->where('jenis_soal', $request->jenis_soal)
            ->get();

        if ($soalSumber->isEmpty()) {
            return response()->json(['message' => 'Tidak ada soal untuk dicopy'], 404);
        }

        foreach ($soalSumber as $soal) {
            BankSoal::create([
                'sub_wilayah_id' => $targetKelas->id,
                'materi_ke' => $request->materi_ke,
                'jenis_soal' => $request->jenis_soal,
                'soal' => $soal->soal,
                'opsi_a' => $soal->opsi_a,
                'opsi_b' => $soal->opsi_b,
                'opsi_c' => $soal->opsi_c,
                'opsi_d' => $soal->opsi_d,
                'jawaban_benar' => $soal->jawaban_benar,
            ]);
        }

        return response()->json(['message' => 'Soal berhasil dicopy']);
    }
}

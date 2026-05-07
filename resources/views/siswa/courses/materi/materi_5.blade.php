@foreach($materiTopics as $index => $topic)
<div x-show="currentStep === ({{$index}} + 1)">

    <h3 style="color: #fff; margin-bottom: 16px;">Section ini membahas tentang {{ $topic }}.</h3>

    @if($index == 0)
        <p class="mt-5" style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px; margin-top: 24px;">
            Dalam bahasa C++ tersedia suatu fasilitas yang digunakan untuk melakukan proses yang berulang-ulang sebanyak keinginan kita. Misalnya saja, bila kita ingin menginput dan mencetak bilangan dari 1 sampai 100 bahkan 1000, tentunya kita akan merasa kesulitan. Namun dengan struktur perulangan proses, kita tidak perlu menuliskan perintah sampai 100 atau 1000 kali, cukup dengan beberapa perintah saja.
        </p>

    @elseif($index == 1)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Struktur perulangan <code style="background-color: #1e293b; color: #f472b6; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">for</code> biasa digunakan untuk mengulang suatu proses yang <strong>telah diketahui jumlah perulangannya</strong>. Dari segi penulisannya, struktur perulangan for tampaknya lebih efisien karena susunannya lebih simpel dan sederhana. Contoh penggunaan:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">perulangan_for.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">for</span> (<span style="color: #f472b6;">int</span> a = <span style="color: #fb923c;">1</span>; a &lt;= <span style="color: #fb923c;">5</span>; a++) {
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Hello World! \n"</span>;
        }
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 8px; border-left: 4px solid #f472b6; margin-bottom: 40px;">
            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; line-height: 1.6;">
                <strong>Penjelasan:</strong> Perintah di atas akan menampilkan kalimat <code style="color: #f8fafc; font-family: monospace;">"Hello World!"</code> sebanyak 5 baris.
            </p>
        </div>

    @elseif($index == 2)
       <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Perulangan <code style="background-color: #1e293b; color: #f472b6; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">while</code> banyak digunakan pada program yang terstruktur. Perulangan ini banyak digunakan bila <strong>jumlah perulangannya belum diketahui</strong> secara pasti. Proses perulangan akan terus berlanjut selama kondisinya bernilai benar (≠0) dan akan berhenti bila kondisinya bernilai salah (=0).
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">perulangan_while.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">int</span> a = <span style="color: #fb923c;">1</span>;

        <span style="color: #f472b6;">while</span> (a &lt;= <span style="color: #fb923c;">5</span>) {
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Hello World! \n"</span>;
            a++;
        }
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 8px; border-left: 4px solid #f472b6; margin-bottom: 40px;">
            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; line-height: 1.6;">
                <strong>Penjelasan:</strong> Sama seperti struktur for, perintah di atas juga menampilkan kalimat <code style="color: #f8fafc; font-family: monospace;">"Hello World!"</code> sebanyak 5 baris. Bedanya, inisialisasi variabel (<code style="color: #f8fafc; font-family: monospace;">a = 1</code>) dan proses penambahan (<code style="color: #f8fafc; font-family: monospace;">a++</code>) dipisah dari kondisi utamanya.
            </p>
        </div>

    @elseif($index == 3)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            <code style="background-color: #1e293b; color: #f87171; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">break</code> digunakan untuk <strong style="color: #e2e8f0;">menghentikan paksa seluruh perulangan</strong>, bahkan jika kondisi loop sebenarnya masih terpenuhi. Begitu <em>break</em> dipicu, program akan langsung keluar dari loop tersebut. Contoh:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 16px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">contoh_break.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">for</span> (<span style="color: #f472b6;">int</span> i = <span style="color: #fb923c;">1</span>; i &lt;= <span style="color: #fb923c;">10</span>; i++) {
            <span style="color: #f472b6;">if</span> (i == <span style="color: #fb923c;">3</span>) {
                <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Angka 3 ditemukan! Berhenti..."</span> &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
                <span style="color: #f472b6;">break</span>;
            }
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Memeriksa angka: "</span> &lt;&lt; i &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
        }
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 12px; border: 1px solid #334155; border-left: 4px solid #f87171; margin-bottom: 40px;">
            <div style="font-size: 12px; color: #64748b; font-weight: bold; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Output Terminal</div>
            <div style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
                Memeriksa angka: 1<br>
                Memeriksa angka: 2<br>
                <span style="color: #f87171;">Angka 3 ditemukan! Berhenti...</span>
            </div>
        </div>

        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            <code style="background-color: #1e293b; color: #38bdf8; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">continue</code> digunakan untuk <strong style="color: #e2e8f0;">melewati (skip) sisa kode</strong> di dalam iterasi saat ini dan langsung loncat ke langkah berikutnya dalam perulangan. Loop tidak berhenti, hanya "lompat" saja. Contoh:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 16px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">contoh_continue.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">for</span> (<span style="color: #f472b6;">int</span> i = <span style="color: #fb923c;">1</span>; i &lt;= <span style="color: #fb923c;">6</span>; i++) {
            <span style="color: #f472b6;">if</span> (i % <span style="color: #fb923c;">2</span> != <span style="color: #fb923c;">0</span>) {
                <span style="color: #f472b6;">continue</span>; <span style="color: #64748b;">// Skip angka ganjil, langsung lanjut ke i berikutnya</span>
            }
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Angka Genap: "</span> &lt;&lt; i &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
        }
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 12px; border: 1px solid #334155; border-left: 4px solid #38bdf8; margin-bottom: 40px;">
            <div style="font-size: 12px; color: #64748b; font-weight: bold; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Hasil Output</div>
            <div style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
                Angka Genap: 2<br>
                Angka Genap: 4<br>
                Angka Genap: 6
            </div>
        </div>
    @endif

</div>
@endforeach

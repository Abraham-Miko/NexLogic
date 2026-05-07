@foreach($materiTopics as $index => $topic)
<div x-show="currentStep === ({{$index}} + 1)">

    <h3 style="color: #fff; margin-bottom: 16px;">Section ini membahas tentang {{ $topic }}.</h3>

    @if($index == 0)
        <p class="mt-5" style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px; margin-top: 24px;">
            Pengkondisian atau yang sering disebut sebagai percabangan adalah logika yang memberikan program kemampuan untuk membuat keputusan dan memilih alur eksekusi berdasarkan kondisi tertentu. Tanpa percabangan program hanya akan mengeksekusi instruksi dari baris atas ke baris bawah secara statis tanpa peduli dengan perubahan data. Dengan pengkondisian program bisa merespons masukan yang berbeda dengan cara yang berbeda pula menciptakan aplikasi yang dinamis dan interaktif.
        </p>

    @elseif($index == 1)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Pernyataan <code style="background-color: #1e293b; color: #f472b6; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">if</code> mempunyai pengertian: jika kondisi bernilai benar, maka pernyataan di dalamnya akan dikerjakan. Sebaliknya, jika tidak memenuhi syarat (bernilai salah), maka program akan mengabaikan pernyataan tersebut. Contoh penggunaan:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">percabangan_if.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">int</span> x;

        <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Enter a number: "</span>;
        <span style="color: #a78bfa;">cin</span> &gt;&gt; x;

        <span style="color: #f472b6;">if</span> (x == <span style="color: #fb923c;">90</span>)
        {
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"x is 90"</span> &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
        }
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 8px; border-left: 4px solid #f472b6; margin-bottom: 40px;">
            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; line-height: 1.6;">
                <strong>Penjelasan:</strong> Jika pengguna menginputkan angka <code style="color: #f8fafc; font-family: monospace;">90</code>, maka teks "x is 90" akan muncul. Namun jika pengguna memasukkan angka lain (misal 10), program tidak akan menampilkan apa-apa dan langsung selesai.
            </p>
        </div>

    @elseif($index == 2)
       <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Pernyataan <code style="background-color: #1e293b; color: #f472b6; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">if - else</code> mempunyai pengertian: jika kondisi bernilai benar, maka <strong>pernyataan-1</strong> yang akan dieksekusi. Namun jika kondisi tidak memenuhi syarat (salah), maka program tidak akan berhenti, melainkan akan mengeksekusi <strong>pernyataan-2</strong>. Contoh penggunaan:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">percabangan_ifelse.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">int</span> x;

        <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Enter a number: "</span>;
        <span style="color: #a78bfa;">cin</span> &gt;&gt; x;

        <span style="color: #f472b6;">if</span> (x == <span style="color: #fb923c;">10</span>)
        {
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"x is 10"</span> &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
        }
        <span style="color: #f472b6;">else</span>
        {
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"x is not 10"</span> &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
        }
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 8px; border-left: 4px solid #f472b6; margin-bottom: 40px;">
            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; line-height: 1.6;">
                <strong>Penjelasan:</strong> Berbeda dengan <code style="color: #f8fafc; font-family: monospace;">if</code> biasa, di sini program memiliki jalur alternatif (<code style="color: #f8fafc; font-family: monospace;">else</code>). Jika pengguna menginputkan angka 10, program menampilkan "x is 10". Tapi jika pengguna memasukkan angka berapapun selain 10 (misal 5, 99, atau 0), program akan otomatis melompat ke blok <em>else</em> dan menampilkan "x is not 10".
            </p>
        </div>

    @elseif($index == 3)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            <strong style="color: #e2e8f0;">Nested if</strong> merupakan bentuk pernyataan <code style="background-color: #1e293b; color: #f472b6; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">if</code> yang ada di dalam pernyataan <code style="background-color: #1e293b; color: #f472b6; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">if</code> yang lain. Disebut juga <em>if bersarang</em>. Eksekusinya sangat memperhatikan pernyataan if utama yang mewadahinya. Contoh penggunaan:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">nested_if.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">int</span> x;

        <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Enter a number : "</span>;
        <span style="color: #a78bfa;">cin</span> &gt;&gt; x;

        <span style="color: #f472b6;">if</span> (x &gt;= <span style="color: #fb923c;">75</span>) {
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"x is greater than or equal to 75"</span> &lt;&lt; <span style="color: #7dd3fc;">endl</span>;

            <span style="color: #f472b6;">if</span> (x &gt;= <span style="color: #fb923c;">90</span>) {
                <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"x is greater than or equal to 90"</span> &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
            } <span style="color: #f472b6;">else</span> {
                <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"x is between 75 and 89"</span> &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
            }
        }
        <span style="color: #f472b6;">else</span> {
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"x is less than 75"</span> &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
        }
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 8px; border-left: 4px solid #f472b6; margin-bottom: 40px;">
            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; line-height: 1.6;">
                <strong>Penjelasan:</strong> Program akan mengecek apakah kondisi utama (<code style="color: #f8fafc; font-family: monospace;">x &gt;= 75</code>) bernilai benar terlebih dahulu. Jika ya, program masuk ke dalam blok tersebut dan melakukan pengecekan kedua (<code style="color: #f8fafc; font-family: monospace;">x &gt;= 90</code>). Namun, jika pengecekan utama saja sudah salah (misal inputnya 50), program akan langsung melompat ke blok <code style="color: #f8fafc; font-family: monospace;">else</code> paling bawah dan mengabaikan semua kode yang ada di dalam sarangnya.
            </p>
        </div>
    @endif

</div>
@endforeach

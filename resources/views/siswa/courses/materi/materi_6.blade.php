@foreach($materiTopics as $index => $topic)
<div x-show="currentStep === ({{$index}} + 1)">

    <h3 style="color: #fff; margin-bottom: 16px;">Section ini membahas tentang {{ $topic }}.</h3>

    @if($index == 0)
       <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 16px;">
            Dalam pembuatan program sebelumnya mungkin terdapat suatu rumus perhitungan. Agar program lebih efisien, dipisahkan antara rumus dengan program utama, sehingga dalam program utama hanya ada perintah memanggil rumus untuk memproses suatu variabel. Hal ini dalam pemrograman disebut sebagai <strong>fungsi</strong>.
        </p>
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 16px;">
            Fungsi merupakan blok dari kode yang dirancang untuk melakukan tugas khusus. Tujuan pembuatan fungsi adalah:
        </p>

        <ul style="list-style: none; padding: 0; margin: 0 0 24px 0; display: flex; flex-direction: column; gap: 12px;">
            <li style="display: flex; align-items: flex-start; gap: 12px; color: #cbd5e1; font-size: 0.95rem; line-height: 1.6;">
                <span style="color: #a78bfa; font-size: 1.2rem; line-height: 1;">•</span>
                Program menjadi lebih terstruktur.
            </li>
            <li style="display: flex; align-items: flex-start; gap: 12px; color: #cbd5e1; font-size: 0.95rem; line-height: 1.6;">
                <span style="color: #a78bfa; font-size: 1.2rem; line-height: 1;">•</span>
                Dapat mengurangi duplikasi kode.
            </li>
            <li style="display: flex; align-items: flex-start; gap: 12px; color: #cbd5e1; font-size: 0.95rem; line-height: 1.6;">
                <span style="color: #a78bfa; font-size: 1.2rem; line-height: 1;">•</span>
                Fungsi dapat dipanggil dari program atau fungsi yang lain.
            </li>
        </ul>

        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 40px;">
            Pada umumnya fungsi memerlukan masukan yang disebut <strong style="color: #e2e8f0;">parameter</strong> atau argument. Hasil akhir fungsi akan berupa nilai (<strong style="color: #e2e8f0;">nilai balik / return value</strong>).
        </p>

    @elseif($index == 1)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Dalam C++, parameter adalah variabel yang bertindak sebagai "penampung" nilai yang dikirimkan ke dalam fungsi saat dipanggil. Ini memungkinkan fungsi Anda bekerja secara dinamis dengan data yang berbeda-beda. Bentuk umum parameter fungsi:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 40px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">fungsi_parameter.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">void</span> <span style="color: #38bdf8;">hitungLuas</span>(<span style="color: #f472b6;">int</span> panjang, <span style="color: #f472b6;">int</span> lebar) {
            <span style="color: #f472b6;">int</span> luas = panjang * lebar;
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Luas persegi panjang ("</span> &lt;&lt; panjang &lt;&lt; <span style="color: #4ade80;">"x"</span> &lt;&lt; lebar &lt;&lt; <span style="color: #4ade80;">") adalah: "</span> &lt;&lt; luas &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
        }

        <span style="color: #f472b6;">int</span> <span style="color: #38bdf8;">main</span>() {
            <span style="color: #64748b;">// Memanggil fungsi dengan memberikan nilai (argumen)</span>
            hitungLuas(<span style="color: #fb923c;">10</span>, <span style="color: #fb923c;">5</span>);

            <span style="color: #64748b;">// Memanggil lagi dengan nilai yang berbeda</span>
            hitungLuas(<span style="color: #fb923c;">7</span>, <span style="color: #fb923c;">3</span>);

            <span style="color: #f472b6;">return</span> <span style="color: #fb923c;">0</span>;
        }
            </code></pre>
        </div>

    @elseif($index == 2)
       <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            <code style="background-color: #1e293b; color: #f472b6; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">Return</code> value (nilai balik) adalah mekanisme di mana sebuah fungsi mengirimkan hasil pengolahannya kembali ke bagian program utama yang memanggilnya.
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">return_value.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">int</span> <span style="color: #38bdf8;">tambah</span>(<span style="color: #f472b6;">int</span> a, <span style="color: #f472b6;">int</span> b) {
            <span style="color: #f472b6;">return</span> a + b;
        }

        <span style="color: #f472b6;">int</span> <span style="color: #38bdf8;">main</span>() {
            <span style="color: #f472b6;">int</span> hasil = tambah(<span style="color: #fb923c;">15</span>, <span style="color: #fb923c;">25</span>); <span style="color: #64748b;">// Hasil disimpan di variabel 'hasil'</span>
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Hasil penjumlahan: "</span> &lt;&lt; hasil &lt;&lt; <span style="color: #7dd3fc;">endl</span>;

            <span style="color: #f472b6;">return</span> <span style="color: #fb923c;">0</span>;
        }
            </code></pre>
        </div>
    @endif

</div>
@endforeach

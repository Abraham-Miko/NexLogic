@foreach($materiTopics as $index => $topic)
<div x-show="currentStep === ({{$index}} + 1)">

    <h3 style="color: #fff; margin-bottom: 16px;">Section ini membahas tentang {{ $topic }}.</h3>

    @if($index == 0)
        <p class="mt-5" style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px; margin-top: 24px;">
            Variabel adalah suatu tempat dalam memori yang digunakan untuk menampung data yang nilainya selalu berubah. Sebagai contoh, misalnya Anda akan membuat sebuah program untuk toko alat tulis yang menjual buku. Anda mungkin tidak dapat memprediksi harga atau jumlah buku yang terjual sampai penjualan benar-benar terjadi. Anda dapat menggunakan dua variabel untuk dua hal yang belum pasti tersebut dengan nama Harga dan Jumlah.
        </p>
        <div class="code-block" style="background: #1e293b; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
            <code>
                <span style="color: #94a3b8;">// Contoh variabel:</span><br>
                <span style="color: #a78bfa;">int</span> x = <span style="color: #f59e0b;">10</span>;<br>
                <span style="color: #a78bfa;">float</span> y = <span style="color: #f59e0b;">9.5</span>;
            </code>
        </div>
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Secara umum, data mewakili angka, karakter, dan simbol-simbol lain yang berfungsi sebagai masukan untuk proses komputer. Setiap data pasti memiliki tipe data, misalnya angka, karakter, dan sebagainya. Tipe data merupakan pengelompokan data berdasarkan isi dan sifatnya. Dalam bidang informatika, tipe data adalah jenis data yang dapat diolah oleh komputer untuk memenuhi kebutuhan dalam pemrograman komputer.
        </p>

    @elseif($index == 1)
        <div class="code-block" style="background: #1e293b; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
            <code>
                <span style="color: #94a3b8;">// Contoh Tipe Data:</span><br>
                <span style="color: #a78bfa;">int</span> -> <span style="color: #f59e0b;">berfungsi untuk menyimpan data berupa angka bulat, seperti 1 atau -1</span><br>
                <span style="color: #a78bfa;">float</span> -> <span style="color: #f59e0b;">berfungsi untuk menyimpan data berupa angka pecahan, seperti 5.5 atau 3.5</span><br>
                <span style="color: #a78bfa;">double</span> -> <span style="color: #f59e0b;">sama seperti dengan int, namun data yang disimpan lebih besar daripada int</span><br>
                <span style="color: #a78bfa;">string</span> -> <span style="color: #f59e0b;">berfungsi untuk menyimpan data berupa huruf</span><br>
                <span style="color: #a78bfa;">bool</span> -> <span style="color: #f59e0b;">berfungsi untuk menyimpan dua nilai kebenaran, yaitu true (benar) atau false (salah)</span>
            </code>
        </div>
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Tipe data angka terbagi menjadi dua kelompok besar, yaitu bilangan bulat (Integer) dan bilangan pecahan/desimal (Float/Double).
        </p>
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Gunakan <strong>Integer</strong> untuk menghitung jumlah barang, dan gunakan <strong>Float</strong> untuk menghitung nilai yang butuh ketelitian seperti nilai rata-rata ujian atau harga dengan diskon.
        </p>

    @elseif($index == 2)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Seperti yang telah dijelaskan pada pengertian variabel & tipe data, variabel harus dideklarasikan sebelum bisa digunakan. Tanpa deklarasi, data tidak akan dapat dipanggil. Berikut ini contoh pendeklarasian variabel.
        </p>
        <div class="code-block" style="background: #1e293b; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
            <code>
                <span style="color: #a78bfa;">int </span><span style="color: #f59e0b;">jumlah_siswa</span>;<br>
                <span style="color: #a78bfa;">string </span><span style="color: #f59e0b;">nama</span>;<br>
                <span style="color: #a78bfa;">float  </span><span style="color: #f59e0b;">hargaBuah</span>;
            </code>
        </div>

    @elseif($index == 3)
        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 16px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">

            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">main.cpp</span>
            </div>

            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">#include</span> <span style="color: #4ade80;">&lt;iostream&gt;</span>
        <span style="color: #f472b6;">using namespace</span> <span style="color: #7dd3fc;">std</span>;

        <span style="color: #f472b6;">int</span> <span style="color: #38bdf8;">main</span>() {
            <span style="color: #f472b6;">int</span> x;

            x = <span style="color: #fb923c;">5</span>;
            <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"The value of x is: "</span> &lt;&lt; x &lt;&lt; <span style="color: #7dd3fc;">endl</span>;

            <span style="color: #f472b6;">return</span> <span style="color: #fb923c;">0</span>;
        }
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 12px; border: 1px solid #334155; border-left: 4px solid #22c55e; margin-bottom: 32px;">
            <div style="font-size: 12px; color: #64748b; font-weight: bold; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Output Terminal</div>
            <div style="font-family: monospace; font-size: 14px; color: #cbd5e1;">
                The value of x is: 5
            </div>
        </div>
    @endif

</div>
@endforeach

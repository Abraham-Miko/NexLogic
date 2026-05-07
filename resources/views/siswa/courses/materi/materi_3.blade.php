@foreach($materiTopics as $index => $topic)
<div x-show="currentStep === ({{$index}} + 1)">

    <h3 style="color: #fff; margin-bottom: 16px;">Section ini membahas tentang {{ $topic }}.</h3>

    @if($index == 0)
        <p class="mt-5" style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px; margin-top: 24px;">
            Input dan Output (I/O) merupakan mekanisme paling mendasar agar sebuah program C++ dapat berinteraksi dengan dunia luar, khususnya dengan pengguna. Tanpa adanya I/O, sebuah program hanya akan berjalan dalam isolasi, melakukan perhitungan di memori tanpa pernah menerima perintah dinamis atau menampilkan hasil kerjanya. Untuk menampilkan data atau keluaran ke layar, C++ menggunakan objek cout. Di sisi lain untuk menerima masukan data dari keyboard, C++ menggunakan objek cin.
        </p>

    @elseif($index == 1)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Menampilkan teks ke layar dinamakan dengan output. Untuk dapat menampilkan teks ke layar dibutuhkan objek <code style="background-color: #1e293b; color: #38bdf8; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">cout</code>. Contoh penggunaan:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">output.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        x = <span style="color: #fb923c;">10</span>;
        <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"The value of x is : "</span> &lt;&lt; x &lt;&lt; <span style="color: #7dd3fc;">endl</span>;
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 8px; border-left: 4px solid #38bdf8; margin-bottom: 40px;">
            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; line-height: 1.6;">
                Dengan kode di atas akan menghasilkan output berupa: <br>
                <code style="color: #f8fafc; font-family: monospace;">The value of x is : 10</code>
            </p>
        </div>

    @elseif($index == 2)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Selain daripada menampilkan teks ke layar, program juga dapat meminta angka sesuai dengan kemauan pengguna. Untuk dapat menerima input dibutuhkan objek <code style="background-color: #1e293b; color: #a78bfa; padding: 2px 8px; border-radius: 4px; font-family: monospace; border: 1px solid #334155;">cin</code>. Contoh penggunaan:
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">input.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">int</span> x;

        <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Enter a number : "</span>;
        <span style="color: #a78bfa;">cin</span> &gt;&gt; x;
            </code></pre>
        </div>

        <div style="background-color: #0f172a; padding: 16px; border-radius: 8px; border-left: 4px solid #a78bfa; margin-bottom: 40px;">
            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; line-height: 1.6;">
                Dengan kode di atas, program akan berhenti sejenak dan menunggu pengguna mengetikkan angka dari *keyboard* mereka sendiri.
            </p>
        </div>

    @elseif($index == 3)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Di C++ juga bisa menampilkan beberapa teks menjadi satu, baik teks yang diinput pengguna maupun bukan. Contoh penggunaan :
        </p>

        <div style="background-color: #1e293b; padding: 20px; border-radius: 12px; border: 1px solid #334155; margin-bottom: 24px; overflow-x: auto; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px; border-bottom: 1px solid #334155; padding-bottom: 8px;">
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ef4444;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #eab308;"></div>
                <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #22c55e;"></div>
                <span style="margin-left: 8px; font-size: 12px; color: #94a3b8; font-family: monospace;">input.cpp</span>
            </div>
            <pre style="margin: 0;"><code style="font-family: monospace; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
        <span style="color: #f472b6;">int</span> x;

        <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"Enter a number : "</span>;
        <span style="color: #a78bfa;">cin</span> &gt;&gt; x;
        <span style="color: #7dd3fc;">cout</span> &lt;&lt; <span style="color: #4ade80;">"You Entered: "</span> &lt;&lt; x &lt;&lt; endl;
        </code></pre>
        </div>
    @endif

</div>
@endforeach

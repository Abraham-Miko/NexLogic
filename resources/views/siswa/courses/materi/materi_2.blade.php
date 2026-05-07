@foreach($materiTopics as $index => $topic)
<div x-show="currentStep === ({{$index}} + 1)">

    <h3 style="color: #fff; margin-bottom: 16px;">Section ini membahas tentang {{ $topic }}.</h3>

    @if($index == 0)
        <p class="mt-5" style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px; margin-top: 24px;">
            Operator merupakan simbol atau karakter yang biasa dilibatkan dalam program untuk melakukan sesuatu operasi atau manipulasi. Contohnya Penjumlahan, pengurangan, pembagian dan lain-lain.
        </p>
    <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 16px;">
        Operator mempunyai sifat:
    </p>

    <ul style="list-style: none; padding: 0; margin: 0 0 32px 0; display: flex; flex-direction: column; gap: 16px;">

        <li style="background-color: #1e293b; border-left: 4px solid #a78bfa; padding: 16px 20px; border-radius: 0 8px 8px 0; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <strong style="color: #a78bfa; font-size: 1.1rem; display: block; margin-bottom: 8px;">Unary</strong>
            <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; margin: 0 0 12px 0;">
                Sifat unary pada operator hanya melibatkan <strong style="color: #e2e8f0;">sebuah operand</strong> pada suatu operasi aritmatik.
            </p>
            <div style="font-size: 0.9rem; color: #cbd5e1;">
                <span style="color: #64748b; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Contoh:</span>
                <code style="background-color: #0f172a; color: #fb923c; padding: 4px 10px; border-radius: 6px; font-family: monospace; border: 1px solid #334155; margin-left: 4px;">-5</code>
            </div>
        </li>

        <li style="background-color: #1e293b; border-left: 4px solid #38bdf8; padding: 16px 20px; border-radius: 0 8px 8px 0; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <strong style="color: #38bdf8; font-size: 1.1rem; display: block; margin-bottom: 8px;">Binary</strong>
            <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; margin: 0 0 12px 0;">
                Sifat binary pada operator melibatkan <strong style="color: #e2e8f0;">dua buah operand</strong> pada suatu operasi aritmatik.
            </p>
            <div style="font-size: 0.9rem; color: #cbd5e1;">
                <span style="color: #64748b; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Contoh:</span>
                <code style="background-color: #0f172a; color: #fb923c; padding: 4px 10px; border-radius: 6px; font-family: monospace; border: 1px solid #334155; margin-left: 4px;">4 + 8</code>
            </div>
        </li>

        <li style="background-color: #1e293b; border-left: 4px solid #4ade80; padding: 16px 20px; border-radius: 0 8px 8px 0; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <strong style="color: #4ade80; font-size: 1.1rem; display: block; margin-bottom: 8px;">Ternary</strong>
            <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; margin: 0 0 12px 0;">
                Sifat tenary pada operator melibatkan <strong style="color: #e2e8f0;">tiga buah operand</strong> pada suatu operasi aritmatik.
            </p>
            <div style="font-size: 0.9rem; color: #cbd5e1;">
                <span style="color: #64748b; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Contoh:</span>
                <code style="background-color: #0f172a; color: #fb923c; padding: 4px 10px; border-radius: 6px; font-family: monospace; border: 1px solid #334155; margin-left: 4px;">(10 % 3) + 4 + 2</code>
            </div>
        </li>

    </ul>

    @elseif($index == 1)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Operator dalam matematika sama halnya di dunia nyata, penggunaannya mulai dari penjumlahan hingga perkalian. Operator matematika dibagi menjadi beberapa jenis:
        </p>

        <div style="background-color: #0f172a; border-radius: 12px; border: 1px solid #334155; overflow: hidden; margin-bottom: 40px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #1e293b; border-bottom: 2px solid #334155;">
                        <th style="padding: 16px; color: #a78bfa; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px;">OPERATOR</th>
                        <th style="padding: 16px; color: #a78bfa; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px;">KETERANGAN</th>
                        <th style="padding: 16px; color: #a78bfa; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px;">CONTOH</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.95rem;">
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #fb923c; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">*</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Perkalian</td>
                        <td style="padding: 14px 16px;"><code style="color: #cbd5e1; font-family: monospace;">3 * 2</code></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #38bdf8; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">/</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Pembagian</td>
                        <td style="padding: 14px 16px;"><code style="color: #cbd5e1; font-family: monospace;">2 / 2</code></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #4ade80; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">%</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Modulus (Sisa Bagi)</td>
                        <td style="padding: 14px 16px;"><code style="color: #cbd5e1; font-family: monospace;">10 % 3</code></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #f87171; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">+</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Penjumlahan</td>
                        <td style="padding: 14px 16px;"><code style="color: #cbd5e1; font-family: monospace;">6 + 7</code></td>
                    </tr>
                    <tr>
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #facc15; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">-</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Pengurangan</td>
                        <td style="padding: 14px 16px;"><code style="color: #cbd5e1; font-family: monospace;">9 - 8</code></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Dalam operator matematika terdapat <strong>hierarki operator</strong>, yang artinya ada urutan prioritas operasi mana yang harus dikerjakan terlebih dahulu oleh komputer:
        </p>

        <div style="background-color: #0f172a; border-radius: 12px; border: 1px solid #334155; overflow: hidden; margin-bottom: 32px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #1e293b; border-bottom: 2px solid #334155;">
                        <th style="padding: 16px; color: #38bdf8; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px; width: 25%;">OPERATOR</th>
                        <th style="padding: 16px; color: #38bdf8; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px;">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.95rem; line-height: 1.6;">
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 16px;"><code style="background-color: #1e293b; color: #f8fafc; padding: 4px 10px; border-radius: 6px; font-family: monospace; border: 1px solid #334155;">*</code> atau <code style="background-color: #1e293b; color: #f8fafc; padding: 4px 10px; border-radius: 6px; font-family: monospace; border: 1px solid #334155;">/</code></td>
                        <td style="padding: 16px; color: #cbd5e1;">Memiliki tingkatan yang sama yaitu <strong style="color: #e2e8f0;">paling atas</strong> dan dikerjakan terlebih dahulu.</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 16px;"><code style="background-color: #1e293b; color: #4ade80; padding: 4px 10px; border-radius: 6px; font-family: monospace; border: 1px solid #334155;">%</code></td>
                        <td style="padding: 16px; color: #cbd5e1;">Memiliki tingkatan di bawah perkalian dan pembagian, namun <strong style="color: #e2e8f0;">lebih tinggi</strong> dari penjumlahan dan pengurangan.</td>
                    </tr>
                    <tr>
                        <td style="padding: 16px;"><code style="background-color: #1e293b; color: #f8fafc; padding: 4px 10px; border-radius: 6px; font-family: monospace; border: 1px solid #334155;">+</code> atau <code style="background-color: #1e293b; color: #f8fafc; padding: 4px 10px; border-radius: 6px; font-family: monospace; border: 1px solid #334155;">-</code></td>
                        <td style="padding: 16px; color: #cbd5e1;">Memiliki tingkatan <strong style="color: #e2e8f0;">paling bawah</strong> dan biasanya dikerjakan paling terakhir.</td>
                    </tr>
                </tbody>
            </table>
        </div>

    @elseif($index == 2)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Operator logika berfungsi sebagai penghubung dua atau lebih ungkapan menjadi sebuah ungkapan berkondisi. Operator logika dibagi menjadi beberapa:
        </p>

        <div style="background-color: #0f172a; border-radius: 12px; border: 1px solid #334155; overflow: hidden; margin-bottom: 40px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #1e293b; border-bottom: 2px solid #334155;">
                        <th style="padding: 16px; color: #a78bfa; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px; width: 25%;">OPERATOR</th>
                        <th style="padding: 16px; color: #a78bfa; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px; width: 45%;">KETERANGAN</th>
                        <th style="padding: 16px; color: #a78bfa; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px; width: 30%;">CONTOH</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.95rem;">
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #4ade80; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">&&</code></td>
                        <td style="padding: 14px 16px; color: #cbd5e1;">Operator logika <strong style="color: #4ade80;">AND</strong></td>
                        <td style="padding: 14px 16px;"><code style="color: #94a3b8; font-family: monospace;">a && b</code></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #38bdf8; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">||</code></td>
                        <td style="padding: 14px 16px; color: #cbd5e1;">Operator logika <strong style="color: #38bdf8;">OR</strong></td>
                        <td style="padding: 14px 16px;"><code style="color: #94a3b8; font-family: monospace;">m || n</code></td>
                    </tr>
                    <tr>
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #f87171; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">!</code></td>
                        <td style="padding: 14px 16px; color: #cbd5e1;">Operator logika <strong style="color: #f87171;">NOT</strong></td>
                        <td style="padding: 14px 16px;"><code style="color: #94a3b8; font-family: monospace;">!n</code></td>
                    </tr>
                </tbody>
            </table>
        </div>

    @elseif($index == 3)
        <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
            Operator relasi ini digunakan untuk membandingkan dua buah nilai. Hasil dari perbandingan operator ini menghasilkan nilai numerik <strong style="color: #4ade80;">1 (True)</strong> atau <strong style="color: #f87171;">0 (False)</strong>. Operator perbandingan dibagi menjadi beberapa:
        </p>

        <div style="background-color: #0f172a; border-radius: 12px; border: 1px solid #334155; overflow: hidden; margin-bottom: 40px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #1e293b; border-bottom: 2px solid #334155;">
                        <th style="padding: 16px; color: #a78bfa; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px; width: 30%;">OPERATOR</th>
                        <th style="padding: 16px; color: #a78bfa; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px; width: 70%;">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.95rem;">
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #2dd4bf; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">==</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Sama Dengan</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #2dd4bf; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">!=</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Tidak Sama Dengan</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #2dd4bf; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">&gt;</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Lebih Dari</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #2dd4bf; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">&lt;</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Kurang Dari</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1e293b;">
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #2dd4bf; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">&gt;=</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Lebih Dari Sama Dengan</td>
                    </tr>
                    <tr>
                        <td style="padding: 14px 16px;"><code style="background-color: #1e293b; color: #2dd4bf; padding: 4px 12px; border-radius: 6px; font-family: monospace; font-size: 1rem; border: 1px solid #334155;">&lt;=</code></td>
                        <td style="padding: 14px 16px; color: #e2e8f0;">Kurang Dari Sama Dengan</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

</div>
@endforeach

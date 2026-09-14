<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// Kita gunakan 3 implementasi: WithHeadings (untuk judul kolom), ShouldAutoSize (agar lebar kolom otomatis pas), dan WithStyles (agar judulnya tebal)
class SiswaTemplateExport implements WithHeadings, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        // Ini adalah judul kolom yang akan muncul di baris pertama Excel
        return [
            'NAMA LENGKAP',
            'NOMOR INDUK',
            'JENIS KELAMIN (L/P)',
            'PASSWORD (Boleh Kosong)',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Membuat baris pertama (judul kolom) menjadi Cetak Tebal (Bold)
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}

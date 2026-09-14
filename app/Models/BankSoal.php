<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    protected $table = 'bank_soal';
    protected $guarded = [];

    public function subWilayah()
    {
        return $this->belongsTo(SubWilayah::class, 'sub_wilayah_id');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_wilayah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah');
            $table->string('nama_sub_wilayah');
            $table->string('kode_wilayah')->unique();
            $table->boolean('materi_1_aktif')->default(false);
            $table->boolean('materi_2_aktif')->default(false);
            $table->boolean('materi_3_aktif')->default(false);
            $table->boolean('materi_4_aktif')->default(false);
            $table->boolean('materi_5_aktif')->default(false);
            $table->boolean('materi_6_aktif')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_wilayah');
    }
};

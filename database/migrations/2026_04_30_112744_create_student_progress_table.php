<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')   // Siswa
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('materi_id')
                  ->constrained('materis')
                  ->cascadeOnDelete();

            // Skor pre-test (nullable: belum dikerjakan)
            $table->unsignedTinyInteger('pre_test_score')->nullable();

            // Skor post-test (nullable: belum dikerjakan)
            $table->unsignedTinyInteger('post_test_score')->nullable();

            // Persentase progres keseluruhan (0-100)
            $table->unsignedTinyInteger('progress_percentage')->default(0);

            // Bintang yang diperoleh berdasarkan post_test_score (0–3)
            $table->unsignedTinyInteger('stars')->default(0);

            // Apakah materi sudah selesai seluruhnya (pre-test + baca + post-test)
            $table->boolean('is_completed')->default(false);

            $table->timestamps();

            // Satu siswa hanya punya satu record per materi
            $table->unique(['user_id', 'materi_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_progress');
    }
};

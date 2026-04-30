<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi_visibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')
                  ->constrained('materis')
                  ->cascadeOnDelete();
            $table->foreignId('guru_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // true  = materi terkunci (siswa TIDAK bisa akses)
            // false = materi terbuka  (siswa BISA akses)
            $table->boolean('is_locked')->default(true);

            $table->timestamps();

            // Satu guru hanya punya satu record per materi
            $table->unique(['materi_id', 'guru_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi_visibilities');
    }
};

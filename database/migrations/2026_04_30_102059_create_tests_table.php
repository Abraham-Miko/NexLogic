<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')
                  ->constrained('materis')
                  ->cascadeOnDelete();
            $table->foreignId('guru_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->enum('type', ['pre_test', 'post_test']);
            $table->text('question');

            // JSON format: {"A": "Pilihan A", "B": "Pilihan B", "C": "Pilihan C", "D": "Pilihan D"}
            $table->json('options');

            // Jawaban benar: "A", "B", "C", atau "D"
            $table->string('correct_answer', 1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('level', ['beginner', 'amateur', 'pro'])->default('beginner');
            $table->longText('content'); // Konten materi utama (bisa HTML/Markdown)
            $table->unsignedInteger('order_number')->default(0); // Urutan tampil di list
            $table->string('icon')->nullable(); // Nama ikon atau path gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};

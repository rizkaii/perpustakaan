<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('pengarang', 150);
            $table->string('penerbit', 150);
            $table->year('tahun_terbit');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->string('isbn', 20)->unique();
            $table->unsignedInteger('stok')->default(0);
            $table->string('cover')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

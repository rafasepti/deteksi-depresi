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
        Schema::create('diagnosa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade');
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan_diagnosa')->onDelete('cascade');
            $table->enum('jawaban', ['Tidak Tahu', 'Tidak Yakin', 'Mungkin', 'Kemungkinan Besar', 'Hampir Pasti', 'Pasti']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosa');
    }
};

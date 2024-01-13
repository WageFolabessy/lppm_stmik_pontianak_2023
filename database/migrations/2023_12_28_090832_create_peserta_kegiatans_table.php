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
        Schema::create('peserta_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->nullable();
            $table->string('nama_peserta')->nullable();
            $table->enum('program_studi', ['Teknik Informatika', 'Sistem Informasi'])->nullable();
            $table->string('peminatan')->nullable();
            $table->unsignedBigInteger('proposal_pkm_id')->nullable();
            $table->foreign('proposal_pkm_id')->references('id')->on('proposal_pkm')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_kegiatans');
    }
};

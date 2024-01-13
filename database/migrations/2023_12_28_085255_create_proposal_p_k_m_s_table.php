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
        Schema::create('proposal_pkm', function (Blueprint $table) {
            $table->id();
            $table->text('judul');
            $table->text('lokasi');
            $table->string('tanggal');
            $table->string('jam');
            $table->text('media');
            $table->enum('jenis_kegiatan', ['Workshop', 'Pelatihan']);
            $table->enum('status', ['Belum Diproses', 'Disetujui', 'Ditolak'])->default('Belum Diproses');
            $table->text('komentar')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_p_k_m_s');
    }
};

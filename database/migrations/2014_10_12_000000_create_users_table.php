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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nidn', 12)->unique();
            $table->string('nama');
            $table->enum('golongan',
                [
                    'Asisten Ahli (III/A)',
                    'Asisten Ahli (III/B)',
                    'Lektor',
                    'Lektor Kepala (IV/C)',
                    'dll',
                    'Tidak Ada Golongan',
                ]);
            $table->enum('program_studi', ['Teknik Informatika', 'Sistem Informasi']);
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

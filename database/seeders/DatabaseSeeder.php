<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Admin\User::factory(798)->create();
        // \App\Models\Dosen\ProposalPKM::factory(50)->create();

        \App\Models\Admin\User::factory()->create([
            'nidn' => 'admin',
            'nama' => 'admin',
            'golongan' => 'Tidak Ada Golongan',
            'program_studi' => 'Teknik Informatika',
            'is_admin' => true,
            'password' => Hash::make('password')
        ]);
    }
}

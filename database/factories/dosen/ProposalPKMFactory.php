<?php

namespace Database\Factories\dosen;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin\User;
use App\Models\Dosen\ProposalPKM;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\dosen\ProposalPKM>
 */
class ProposalPKMFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence,
            'lokasi' => $this->faker->address,
            'tanggal' => $this->faker->date('Y-m-d', 'now'),
            'jam' => $this->faker->time('H:i:s', 'now'),
            'media' => $this->faker->sentence,
            'jenis_kegiatan' => $this->faker->randomElement(['Workshop', 'Pelatihan']),
            'status' => 'Belum Diproses',
            'komentar' => $this->faker->sentence,
            'user_id' => User::all()->random()->id,
            
        ];
        
    }

    public function configure()
    {
        return $this->afterCreating(function (ProposalPkm $proposal) {
            $admins = User::where('is_admin', true)->get();
            $admins->each(function ($admin) use ($proposal) {
                $admin->notify(new \App\Notifications\NewPkmProposal($proposal));
            });
        });
    }
}

<?php

namespace Database\Factories\admin;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\admin\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nidn' => $this->faker->unique()->numerify('############'),
            'nama' => $this->faker->name,
            'golongan' => $this->faker->randomElement([
                'Asisten Ahli (III/A)',
                'Asisten Ahli (III/B)',
                'Lektor',
                'Lektor Kepala (IV/C)',
                'dll',
                'Tidak Ada Golongan',
            ]),
            'program_studi' => $this->faker->randomElement(['Teknik Informatika', 'Sistem Informasi']),
            'password' => Hash::make('password'),
            'is_admin' => false,
        ];
    }
}

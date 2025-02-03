<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        $phoneNumber = '08' . $this->faker->numerify('##########');
        $email = $this->faker->userName() . '@gmail.com';

        // Daftar kecamatan dan jalan di Bandar Lampung
        $districts = [
            'Tanjung Karang', 'Kedaton', 'Rajabasa', 'Sukarame', 'Tanjung Senang',
            'Kemiling', 'Sukabumi', 'Way Halim', 'Labuhan Ratu', 'Langkapura'
        ];

        $streets = [
            'Jl. Soekarno Hatta', 'Jl. Teuku Umar', 'Jl. Wolter Monginsidi', 'Jl. Gatot Subroto',
            'Jl. Pramuka', 'Jl. Kartini', 'Jl. Raden Intan', 'Jl. Jend. Sudirman', 'Jl. Pagar Alam'
        ];

        $address = sprintf(
            "%s No. %s, %s, Bandar Lampung",
            $this->faker->randomElement($streets),
            $this->faker->buildingNumber,
            $this->faker->randomElement($districts)
        );

        //user
        return [
            'name' => fake()->name(),
            'email' => $email,
            'password' => bcrypt('12345678'), // password
            'telephone' => $phoneNumber,
            'address' => $address,
            'status' => 'offline',
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ];


    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

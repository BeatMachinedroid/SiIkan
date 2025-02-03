<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ikan>
 */
class IkanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fishNames = ['Lele', 'Nila', 'Gurame', 'Mas', 'Patin', 'Kakap', 'Tuna', 'Sardine'];
        
        return [
            'id_cate' => Category::inRandomOrder()->first()->id, // Ambil ID kategori acak
            'nama' => fake()->sentence(), // Contoh: "Ikan Segar Premium"
            'deskripsi' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(10, 100),
            'min_pembelian' => $this->faker->numberBetween(1, 5),
            'harga' => $this->faker->randomFloat(10000, 30000), // Harga antara 10.000 - 1.000.000
            'gambar' => 'images/categories/1738406431.jpg',
        ];
    }
}

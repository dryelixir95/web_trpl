<?php

namespace Database\Factories;

use App\Models\kategoriPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class kategoriPostFactory extends Factory
{
    protected $model = kategoriPost::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->word,
            'slug' => $this->faker->slug,
            'index_menu' => $this->faker->numberBetween(1, 3),
            'deskripsi' => $this->faker->sentence,
            'type_halaman' => $this->faker->randomElement(['single-artikel', 'multi-artikel']),
        ];
    }
}

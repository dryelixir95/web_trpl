<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\kategoriPost; // Ensure this import is present if you are using category ids
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'judul' => $this->faker->sentence,
            'tanggal' => $this->faker->date,
            'kategori' => $this->faker->numberBetween(47, 55),  // Assuming you want to create a related kategoriPost
            'deskripsi' => $this->faker->paragraph,
            'tag' => '["TRPL","Poliwangi"]',
        ];
    }
}

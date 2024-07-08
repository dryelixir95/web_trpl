<?php

namespace Database\Factories;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeritaFactory extends Factory
{
    protected $model = Berita::class;

    public function definition()
    {
        return [
            'judul_berita' => $this->faker->sentence,
            'isi_berita' => $this->faker->paragraphs(3, true),
            'tgl_berita' => $this->faker->date,
            'gambar' => $this->faker->optional()->image('public/images/berita', 640, 480, null, false),
        ];
    }
}

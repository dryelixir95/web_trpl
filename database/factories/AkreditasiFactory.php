<?php

namespace Database\Factories;

use App\Models\Akreditasi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AkreditasiFactory extends Factory
{
    protected $model = Akreditasi::class;

    public function definition()
    {
        return [
            'judul' => $this->faker->sentence,
            'tgl_akreditasi' => $this->faker->date,
            'file_akreditasi' => $this->faker->image('public/file/akreditasi', 640, 480, null, false), // generates a placeholder image
        ];
    }
}

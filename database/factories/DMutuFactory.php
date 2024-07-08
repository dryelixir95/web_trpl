<?php

namespace Database\Factories;

use App\Models\DMutu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DMutu>
 */
class DMutuFactory extends Factory
{
    protected $model = DMutu::class;

    public function definition()
    {
        return [
            'nama_Dmutu' => $this->faker->sentence,
            'file_Dmutu' => null,
            'keterangan' => $this->faker->sentence,
        ];
    }
}

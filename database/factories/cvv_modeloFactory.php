<?php

namespace Database\Factories;
use App\Models\cvv_modelo;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\cvv_modelo>
 */
class cvv_modeloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = cvv_modelo::class;
    public function definition(): array
    {
        return [
            'nombre_modelo' => $this->faker->unique()->word,
            // entre el 1 y 10 porque es la cantidad de registros en cvv_marcas
            'id_marca' => $this->faker->numberBetween(1, 10),
        ];
    }
}

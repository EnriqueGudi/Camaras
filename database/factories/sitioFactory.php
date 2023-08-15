<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\sitio;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\sitio>
 */
class sitioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = sitio::class;
    public function definition(): array
    {
        return [
            'nombre_sitio' => $this->faker->unique()->word,
            // entre el 1 y 10 porque es la cantidad de registros en cvv_marcas
            'id_area' => $this->faker->numberBetween(1, 10),
        ];
    }
}

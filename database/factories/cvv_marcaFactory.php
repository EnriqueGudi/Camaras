<?php

namespace Database\Factories;
use App\Models\cvv_marca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\cvv_marca>
 */
class cvv_marcaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = cvv_marca::class;
    public function definition(): array
    {
        return [
            'nombre_marca'=>$this->faker->unique()->company,
        ];
    }
}

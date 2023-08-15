<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\area;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\area>
 */
class areaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = area::class;
    public function definition(): array
    {
        return [
            'nombre_area'=>$this->faker->unique()->company,
        ];
    }
}

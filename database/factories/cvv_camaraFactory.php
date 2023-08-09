<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\cvv_camara;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\cvv_camara>
 */
class cvv_camaraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = cvv_camara::class;
    public function definition(): array
    {
        $fechaBaja = $this->faker->optional(0.2)->dateTime();
        $motivoBaja = $fechaBaja ? $this->faker->text(50) : null;
        $estatus = $fechaBaja ? 'baja' : 'disponible';
        return [
            'no_serie' => $this->faker->unique()->numberBetween(1, 100),
            'estatus' => $estatus,
            'motivo_baja' => $motivoBaja,
            'fecha_baja' => $fechaBaja,
            'foto_cam' => null,
            'fecha_disp' => $this->faker->dateTime(),
            'dir_mac' => $this->faker->unique()->macAddress(),
            'nombre_cam' => $this->faker->text(25),
            // entre el 1 y 10 porque es la cantidad de registros en cvv_modelos
            'id_modelo' => $this->faker->numberBetween(1, 10),
        ];
    }
}

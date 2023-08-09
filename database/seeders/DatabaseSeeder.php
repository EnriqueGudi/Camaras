<?php

namespace Database\Seeders;

use App\Models\cvv_camara;
use App\Models\cvv_marca;
use App\Models\cvv_modelo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        cvv_marca::factory(10)->create();
        cvv_modelo::factory(10)->create();
        cvv_camara::factory(10)->create();
    }
}

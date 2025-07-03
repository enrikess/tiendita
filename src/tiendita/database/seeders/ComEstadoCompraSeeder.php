<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComEstadoCompra;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class ComEstadoCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Si tienes un Factory configurado, usa esta línea:
        ComEstadoCompra::factory()->count(20)->create();


    }
}

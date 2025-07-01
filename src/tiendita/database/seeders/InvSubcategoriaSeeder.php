<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvSubcategoria;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class InvSubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Si tienes un Factory configurado, usa esta línea:
        InvSubcategoria::factory()->count(50)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\SisUsuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Carga los tipos de documentos
        $this->call(TipoDocumentoSeeder::class);
        $this->call(ProveedorSeeder::class);
        // Crea un usuario de prueba
        SisUsuario::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Descomentar para crear usuarios aleatorios
        // SisUsuario::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\SisUsuario;
use App\Models\SisPersona;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Crear persona
    $persona = SisPersona::create([
        'nombre' => 'Enrique',
        'ape_paterno' => 'Huaman',
        'ape_materno' => 'Broncano',
        'email' => 'enriqueahb@gmail.com',
        'tipo_documento_id' => 1, // Ajusta según tus datos
        'numero_documento' => '12345678',
        'telefono' => '999999999',
        'direccion' => 'Calle Falsa 123',
        'fecha_nacimiento' => '1990-01-01',
        'genero_id' => 1, // Ajusta según tus datos
        'estado' => true,
    ]);

    // Crear usuario y asociar persona
    SisUsuario::create([
        'name' => 'Enrique',
        'email' => 'enriqueahb@gmail.com',
        'password' => Hash::make('123qweasd'),
        'persona_id' => $persona->id,
    ]);
        // Carga los tipos de documentos
        $this->call(TipoDocumentoSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(InvCategoriaSeeder::class);
        // Crea un usuario de prueba


        // Descomentar para crear usuarios aleatorios
        // SisUsuario::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvCategoria;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class InvCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Si tienes un Factory configurado, usa esta línea:
        InvCategoria::factory()->count(50)->create();

        // Código alternativo si no quieres usar factory:
        /*
        $faker = Faker::create('es_PE');

        $userId = Auth::id() ?? 1; // Usamos el usuario autenticado o el ID 1 por defecto
        $now = now();

        // Crear 50 proveedores con datos aleatorios
        for ($i = 0; $i < 50; $i++) {
            $fechaCreo = $faker->dateTimeBetween('-1 year', '-1 month');
            $fechaModifico = $faker->optional(0.7)->dateTimeBetween($fechaCreo, 'now');

            ComProveedor::create([
                'ruc' => $faker->numberBetween(10000000000, 99999999999), // RUC peruano (11 dígitos)
                'razon_social' => $faker->company,
                'nombre_comercial' => $faker->optional(0.7)->company,
                'direccion' => $faker->address,
                'telefono' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'persona_contacto' => $faker->name,
                'estado' => $faker->boolean(90), // 90% true (activo), 10% false (inactivo)
                'usuario_creo' => $userId,
                'fecha_creo' => $fechaCreo,
                'usuario_modifico' => $fechaModifico ? $userId : null,
                'fecha_modifico' => $fechaModifico,
                'eliminado' => false, // Por defecto no está eliminado
                'usuario_elimino' => null,
                'motivo_elimino' => null,
                'fecha_elimino' => null
            ]);
        }
        */
    }
}

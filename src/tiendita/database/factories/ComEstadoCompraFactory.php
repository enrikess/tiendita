<?php

namespace Database\Factories;

use App\Models\ComEstadoCompra;
use App\Models\SisUsuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComEstadoCompraFactory extends Factory
{
    protected $model = ComEstadoCompra::class;

    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->bothify('EST-###'),
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(4),
            'estado' => true,
            'usuario_creo' => SisUsuario::factory(),
            'fecha_creo' => now(),
            'usuario_modifico' => null,
            'fecha_modifico' => null,
            'eliminado' => false,
            'usuario_elimino' => null,
            'motivo_elimino' => null,
            'fecha_elimino' => null,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\InvCategoria;
use App\Models\SisUsuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvCategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvCategoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fechaCreo = $this->faker->dateTimeBetween('-1 year', '-1 month');
        $fechaModifico = $this->faker->dateTimeBetween($fechaCreo, 'now');

        // Intentamos obtener un usuario aleatorio o usamos ID 1 como respaldo
        $usuario = SisUsuario::inRandomOrder()->first()?->id ?? 1;

        return [
            'nombre' => $this->faker->unique()->word(),
            'descripcion' => $this->faker->sentence(4),
            'estado' => $this->faker->boolean(90),
            'usuario_creo' => $usuario,
            'fecha_creo' => $fechaCreo,
            'usuario_modifico' => $fechaModifico ? $usuario : null,
            'fecha_modifico' => $fechaModifico,
            'eliminado' => false,
            'usuario_elimino' => null,
            'motivo_elimino' => null,
            'fecha_elimino' => null
        ];
    }

    /**
     * Indica que el proveedor está activo
     */
    public function activo()
    {
        return $this->state(function (array $attributes) {
            return [
                'estado' => true,
            ];
        });
    }

    /**
     * Indica que el proveedor está inactivo
     */
    public function inactivo()
    {
        return $this->state(function (array $attributes) {
            return [
                'estado' => false,
            ];
        });
    }
}

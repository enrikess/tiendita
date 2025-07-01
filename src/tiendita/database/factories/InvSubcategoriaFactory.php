<?php

namespace Database\Factories;

use App\Models\InvSubcategoria;
use App\Models\InvCategoria;
use App\Models\SisUsuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvSubcategoriaFactory extends Factory
{
    protected $model = InvSubcategoria::class;

    public function definition()
    {
        return [
            'categoria_id'      => InvCategoria::factory(),
            'nombre'            => $this->faker->word(),
            'descripcion'       => $this->faker->sentence(),
            'estado'            => $this->faker->boolean(90),
            'usuario_creo'      => SisUsuario::factory(),
            'fecha_creo'        => now(),
            'usuario_modifico'  => null,
            'fecha_modifico'    => null,
            'eliminado'         => false,
            'usuario_elimino'   => null,
            'motivo_elimino'    => null,
            'fecha_elimino'     => null,
        ];
    }
}
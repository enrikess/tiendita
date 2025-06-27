<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proveedor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->company,
            'rfc' => strtoupper($this->faker->randomLetter . $this->faker->randomLetter . $this->faker->randomLetter . $this->faker->randomLetter) . 
                    $this->faker->numberBetween(100000, 999999) . 
                    $this->faker->randomLetter . $this->faker->randomLetter . $this->faker->randomDigit,
            'email' => $this->faker->companyEmail,
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'activo' => $this->faker->boolean(90),
            'notas' => $this->faker->optional(0.7)->paragraph,
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-1 month'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}

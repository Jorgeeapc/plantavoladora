<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Estado;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha_compra' =>$this->faker->dateTime(),
           'valor_compra' =>$this->faker->randomNumber(5),
           'compra_fecha_estado' =>$this->faker->dateTime(),
           'id_estado' =>$this->faker->randomElement(Estado::pluck('id_estado')),
           'id_cliente' =>$this->faker->randomElement(User::pluck('id')),
        ];
    }
}

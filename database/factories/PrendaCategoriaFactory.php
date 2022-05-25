<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Prenda;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrendaCategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_categoria' =>$this->faker->randomElement(Categoria::pluck('id_categoria')),
            'id_prenda' =>$this->faker->randomElement(Prenda::pluck('id_prenda')),
        ];
    }
}

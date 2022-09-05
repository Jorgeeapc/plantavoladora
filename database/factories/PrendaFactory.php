<?php

namespace Database\Factories;

use App\Models\Talla;
use App\Models\Compra;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'material_prenda' =>$this->faker->randomElement(['Plush','Polar','Algodon','Transparencia']),
           'color_prenda' =>$this->faker->randomElement(['Negro','Azul','Blanco']),
           'stock_prenda' =>$this->faker->randomNumber(1),
           'precio_prenda' =>$this->faker->randomNumber(5),
           'descripcion' =>$this->faker->sentence(),
           'img' =>$this->faker->randomElement(['1.jpg','2.jpg','3.jpg']),
           'id_talla' =>$this->faker->randomElement(Talla::pluck('id_talla')),
           'categoria' =>$this->faker->randomElement(['Poleron','Polera','Calza'])

        ];
    }
}

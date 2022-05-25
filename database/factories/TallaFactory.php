<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TallaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cintura_talla' =>$this->faker->randomNumber(2),
            'largo_talla' =>$this->faker->randomNumber(2),
            'busto_talla' =>$this->faker->randomNumber(2),
            'cadera_talla' =>$this->faker->randomNumber(2),
        ];
    }
}

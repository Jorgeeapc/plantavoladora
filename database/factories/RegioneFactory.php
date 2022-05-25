<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Region'=> $this->faker->word(),
        ];
    }
}

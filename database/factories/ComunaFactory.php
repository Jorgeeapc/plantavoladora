<?php

namespace Database\Factories;

use App\Models\Regione;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComunaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comuna' => $this->faker->word(),  
            'id_region' => $this->faker->randomElement(Regione::pluck('id_region')),
        ];
    }
}

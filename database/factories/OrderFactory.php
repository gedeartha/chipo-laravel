<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice' => $this->faker->numberBetween(1000, 9999),
            'user_id' => $this->faker->numberBetween(1, 10),
            'table' => $this->faker->numberBetween(1, 30),
            'status' => $this->faker->randomElement($array = array ('Pending', 'Proses', 'Selesai')),
            'total' => $this->faker->numberBetween(23000, 10000),
        ];
    }
}

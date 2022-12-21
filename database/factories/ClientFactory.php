<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'cif' => $this->faker->name(),
            'password' => $this->faker->password(),
            'state_id' => rand(0,1)

        ];
    }
}

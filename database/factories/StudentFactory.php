<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->name(),
            'lastname'  => $this->faker->lastName(),
            'email'     => $this->faker->safeEmail(),
            'birthday'  => $this->faker->dateTimeBetween('-100 years', '-18 years'),
        ];
    }
}

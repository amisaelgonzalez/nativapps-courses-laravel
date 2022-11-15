<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('-2 years', 'now');

        return [
            'name'          => $this->faker->word(),
            'start_date'    => $start_date,
            'end_date'      => (new DateTime($start_date->format('Y-m-d')))->modify('+3 month'),
        ];
    }
}

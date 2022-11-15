<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time'    => $this->faker->time(),
            'end_time'      => $this->faker->time(),
            'monday'        => $this->faker->boolean(),
            'tuesday'       => $this->faker->boolean(),
            'wednesday'     => $this->faker->boolean(),
            'thursday'      => $this->faker->boolean(),
            'friday'        => $this->faker->boolean(),
            'saturday'      => $this->faker->boolean(),
            'sunday'        => $this->faker->boolean(),
            'course_id'     => null,
        ];
    }
}

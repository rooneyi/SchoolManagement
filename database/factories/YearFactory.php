<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Year>
 */
class YearFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->date();
        $end = $this->faker->dateTimeBetween($start)->format('Y-m-d');

        return [
            'school_id' => 1,
            'name' => $this->faker->year().'-'.$this->faker->year(),
            'is_active' => $this->faker->boolean(20),
            'start_date' => $start,
            'end_date' => $end,
        ];
    }
}

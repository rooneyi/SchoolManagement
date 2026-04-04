<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Classroom>
 */
class ClassroomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->bothify('??###'),
            'capacity' => $this->faker->numberBetween(20, 40),
            'school_id' => 1,
            'section_id' => 1,
        ];
    }
}

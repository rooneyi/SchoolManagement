<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Registration>
 */
class RegistrationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'guardian_id' => Guardian::factory(),
            'school_id' => School::factory(),
            'year_id' => Year::factory(),
            'classroom_id' => Classroom::factory(),
            'section_id' => Section::factory(),
            'registration_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'active', 'cancelled']),
        ];
    }
}

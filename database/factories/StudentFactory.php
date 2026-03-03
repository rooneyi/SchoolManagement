<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Student>
 */
class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'matricule' => $this->faker->unique()->bothify('??###'),
            'name' => $this->faker->firstName(),
            'post_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'birth_date' => $this->faker->date(),
            'address' => $this->faker->address(),
            'photo' => null,
            'bulletin_file' => null,
            'school_id' => 1,
            'guardian_id' => 1,
        ];
    }
}

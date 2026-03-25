<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolBibliography>
 */
class SchoolBibliographyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_id' => 1, // à adapter dans le seeder
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'year' => $this->faker->year(),
            'type' => $this->faker->randomElement(['livre', 'article', 'rapport', 'thèse']),
            'description' => $this->faker->optional()->paragraph(),
            'url' => $this->faker->optional()->url(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Bug', 'Feature', 'Urgent', 'Design', 'Backend', 'Frontend', 'Documentation', 'Testing', 'Deployment', 'Maintenance', 'Other']),
            'color' => $this->faker->hexColor(),
        ];
    }
}

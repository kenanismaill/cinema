<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'type' => $this->faker->word,
            'start_date' => $this->faker->dateTimeBetween('now','+1week'),
            'end_date' => $this->faker->dateTimeBetween('+1week','+2week'),
        ];
    }
}

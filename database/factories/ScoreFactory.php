<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reservations_id' => \App\Models\Reservation::inRandomOrder()->first()->id,
            'score' => $this->faker->numberBetween(0, 300),
            'player_name' => $this->faker->name(),
            'round' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'comment' => $this->faker->text(255),
            'validated' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Lane;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Lane ' . $this->faker->numberBetween(1, 8), // Generates lane names like 'Lane 1', 'Lane 2', etc.
            'type' => $this->faker->randomElement(['Type A', 'Type B', 'Type C']), // Randomly assigns type
            'location' => $this->faker->city, // Generate a random location (city name)
            'capacity' => $this->faker->numberBetween(1, 10), // Random capacity between 1 and 10
            'status' => $this->faker->randomElement(['Beschikbaar', 'Bezet', 'Onderhoud']), // Random status
            'prijs_per_uur' => $this->faker->randomFloat(2, 10, 100), // Random price per hour between 10 and 100
            'note' => $this->faker->sentence, // Random note
            'actief' => $this->faker->boolean, // Random active status
        ];
    }
}

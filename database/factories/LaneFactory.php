<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lane>
 */
class LaneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->word(),
            'location' => $this->faker->address(),
            'capacity' => $this->faker->numberBetween(1, 10),
            'status' => 'Beschikbaar',
            'prijs_per_uur' => $this->faker->randomFloat(2, 5, 50),
            'note' => $this->faker->optional()->text(),
            'actief' => $this->faker->boolean(80),
        ];
    }
}

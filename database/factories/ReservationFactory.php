<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'lane_id' => \App\Models\Lane::inRandomOrder()->first()->id,
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'number_of_people' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled']),
            'cost' => $this->faker->randomFloat(2, 10, 200),
            'paid' => $this->faker->boolean(),
            'note' => $this->faker->sentence(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Reservation $reservation) {
            // Add the owner as a participant
            \App\Models\ReservationParticipant::create([
                'reservation_id' => $reservation->id,
                'name' => $reservation->user->name,
            ]);
        });
    }
}

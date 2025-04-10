<?php

namespace Database\Seeders;

use App\Models\Lane;
use App\Models\Reservation;
use App\Models\ReservationParticipant;
use App\Models\Score;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Lane::factory(10)->create();

        Reservation::factory(20)->create()->each(function ($reservation) {
            // Add the owner as a participant
            $owner = ReservationParticipant::create([
                'reservation_id' => $reservation->id,
                'name' => $reservation->user->name, // Use the reservation owner's name
            ]);

            $reservation->update(['owner_id' => $owner->id]); // Set the owner_id

            // Ensure at least one additional participant
            for ($i = 0; $i < max(1, rand(1, 4)); $i++) {
                ReservationParticipant::create([
                    'reservation_id' => $reservation->id,
                    'name' => fake()->name(),
                ]);
            }
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        Score::factory(50)->create();
    }
}

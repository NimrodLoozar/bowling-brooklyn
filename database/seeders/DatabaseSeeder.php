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
        User::factory(100)->create();
        Lane::factory(10)->create();

        Reservation::factory()
        ->count(5)
        ->create()
        ->each(function ($reservation) {
            // Voeg altijd de creator toe als participant
            $creator = ReservationParticipant::create([
                'reservation_id' => $reservation->id,
                'user_id' => $reservation->user_id
            ]);
    
            Score::create([
                'participant_id' => $creator->id,
                'score' => rand(100, 300),
                'date' => now()->toDateString()
            ]);
    
            // Voeg 1-3 extra spelers toe
            User::inRandomOrder()->take(rand(1, 3))->get()->each(function ($user) use ($reservation) {
                $participant = ReservationParticipant::create([
                    'reservation_id' => $reservation->id,
                    'user_id' => $user->id
                ]);
    
                Score::create([
                    'participant_id' => $participant->id,
                    'score' => rand(100, 300),
                    'date' => now()->toDateString()
                ]);
            });
        });
    


        // Reservation::factory(20)->create()->each(function ($reservation) {
        //     // Add the owner as a participant
        //     $owner = ReservationParticipant::create([
        //         'reservation_id' => $reservation->id,
        //         'name' => $reservation->user->name, // Use the reservation owner's name
        //     ]);

        //     $reservation->update(['owner_id' => $owner->id]); // Set the owner_id

        //     // Ensure at least one additional participant
        //     for ($i = 0; $i < max(1, rand(1, 4)); $i++) {
        //         ReservationParticipant::create([
        //             'reservation_id' => $reservation->id,
        //             'name' => fake()->name(),
        //         ]);
        //     }
        // });

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

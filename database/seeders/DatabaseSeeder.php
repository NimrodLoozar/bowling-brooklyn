<?php

namespace Database\Seeders;

use App\Models\Lane;
use App\Models\Reservation;
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
        Reservation::factory(20)->create();

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
        $this->call(OrderSeeder::class); // Ensure the correct class name is used
    }
    
}

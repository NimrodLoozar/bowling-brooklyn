<?php

namespace Database\Seeders;

use App\Models\Lane;
use Illuminate\Database\Seeder;

class LaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Maak 8 lanes aan met fake data via de factory
        Lane::factory(8)->create();

        // Je kunt ook handmatig toevoegen als je geen factory wilt gebruiken
        // DB::table('lanes')->insert([
        //     ['name' => 'Lane 1', 'type' => 'Type A'],
        //     ['name' => 'Lane 2', 'type' => 'Type A'],
        //     ['name' => 'Lane 3', 'type' => 'Type B'],
        //     ['name' => 'Lane 4', 'type' => 'Type B'],
        //     ['name' => 'Lane 5', 'type' => 'Type A'],
        //     ['name' => 'Lane 6', 'type' => 'Type C'],
        //     ['name' => 'Lane 7', 'type' => 'Type C'],
        //     ['name' => 'Lane 8', 'type' => 'Type A'],
        // ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1, // Ensure this ID exists in the users table
                'product' => json_encode(['Pizza', 'Hamburger']), // Store as JSON array
                'sub_product' => json_encode(['Cola', 'Fanta']), // Store as JSON array
                'besteldatum' => Carbon::now(),
                'status' => 'Nieuw',
                'totaalbedrag' => 50.00,
                'betaalmethode' => 'Creditcard',
                'betaalstatus' => 'Betaald',
                'aantal' => 2,
                'opmerking' => 'Eerste bestelling',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2, // Ensure this ID exists in the users table
                'product' => json_encode(['Friet']), // Store as JSON array
                'sub_product' => json_encode(['Water']), // Store as JSON array
                'besteldatum' => Carbon::now()->subDays(1),
                'status' => 'Verzonden',
                'totaalbedrag' => 75.50,
                'betaalmethode' => 'PayPal',
                'betaalstatus' => 'Betaald',
                'aantal' => 3,
                'opmerking' => 'Snelle levering gevraagd',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

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
                'product' => 'Pizza', // Store as plain string
                'sub_product' => 'Cola', // Store as plain string
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
                'product' => 'Hamburger', // Store as plain string
                'sub_product' => 'Fanta', // Store as plain string
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
            [
                'user_id' => 3, // Ensure this ID exists in the users table
                'product' => 'Friet', // Store as plain string
                'sub_product' => 'Water', // Store as plain string
                'besteldatum' => Carbon::now()->subDays(2),
                'status' => 'Geannuleerd',
                'totaalbedrag' => 0.00,
                'betaalmethode' => 'iDEAL',
                'betaalstatus' => 'Niet betaald',
                'aantal' => 1,
                'opmerking' => 'Bestelling geannuleerd door klant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

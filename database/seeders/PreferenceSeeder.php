<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample data for preferences
        $preferences = [
            [
                'guest_id' => 6,
                'preference' => 'blockchain',
            ],
            [
                'guest_id' => 7,
                'preference' => 'AI',
            ],
            [
                'guest_id' => 8,
                'preference' => 'ML',
            ],
            [
                'guest_id' => 9,
                'preference' => 'Web',
            ],
            [
                'guest_id' => 10,
                'preference' => 'Web',
            ],
            // Add more preferences as needed
        ];

        // Insert data into the preferences table
        DB::table('preferences')->insert($preferences);
    }
}

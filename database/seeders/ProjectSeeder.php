<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample data for projects
        $projects = [
            [
                'name' => 'CitySearch',
                'assigned_words' => 'ML',
                'group_id' => 1,
                'allocated_to' => 8,
            ],
            [
                'name' => 'Doctech',
                'assigned_words' => 'ML',
                'group_id' => 2,
                'allocated_to' => 8,
            ],
            [
                'name' => 'Attendece Recorder',
                'assigned_words' => 'AI',
                'group_id' => 3,
                'allocated_to' => 7,
            ],
            [
                'name' => 'Food app',
                'assigned_words' => 'AI',
                'group_id' => 4,
                'allocated_to' => 7,
            ],
            [
                'name' => 'Penny Tracker',
                'assigned_words' => 'blockchain',
                'group_id' => 5,
                'allocated_to' => 6,
            ],
            
            // Add more projects as needed
        ];

        // Insert data into the projects table
        DB::table('projects')->insert($projects);
    }
}

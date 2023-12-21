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
                'name' => 'Project 1',
                'assigned_words' => 'ML',
                'group_id' => 16,
                'allocated_to' => 1,
            ],
            [
                'name' => 'Project 2',
                'assigned_words' => 'ML',
                'group_id' => 12,
                'allocated_to' => 1,
            ],
            [
                'name' => 'Project 1',
                'assigned_words' => 'Web',
                'group_id' => 13,
                'allocated_to' => 1,
            ],
            [
                'name' => 'Project 2',
                'assigned_words' => 'Web',
                'group_id' => 14,
                'allocated_to' => 1,
            ],
            [
                'name' => 'Project 1',
                'assigned_words' => 'blockchain',
                'group_id' => 15,
                'allocated_to' => 1,
            ],
            [
                'name' => 'Project 2',
                'assigned_words' => 'blockchain',
                'group_id' => 2,
                'allocated_to' => 1,
            ],
            [
                'name' => 'Project 1',
                'assigned_words' => 'AI',
                'group_id' => 3,
                'allocated_to' => 1,
            ],
            [
                'name' => 'Project 2',
                'assigned_words' => 'AI',
                'group_id' => 4,
                'allocated_to' => 1,
            ],
            // Add more projects as needed
        ];

        // Insert data into the projects table
        DB::table('projects')->insert($projects);
    }
}

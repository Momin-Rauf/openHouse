<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $evaluations = [
            [
                'project_id' => 1,
                'evaluator_id' => 8,
                'rating' => 9,
                
            ],
            [
                'project_id' => 2,
                'evaluator_id' => 9,
                'rating' => 8.5,
                
            ],
            [
                'project_id' => 3,
                'evaluator_id' => 10,
                'rating' => 5,
                
            ],
            // Add more evaluations as needed
        ];

        // Insert data into the project_evaluations table
        DB::table('project_evaluations')->insert($evaluations);
    }
}

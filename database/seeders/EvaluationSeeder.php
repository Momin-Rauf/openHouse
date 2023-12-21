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
        // Sample data for project evaluations
        $evaluations = [
           
            // Add more evaluations as needed
        ];

        // Insert data into the project_evaluations table
        DB::table('project_evaluations')->insert($evaluations);
    }
}

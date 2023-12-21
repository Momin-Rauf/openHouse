<?php
/// database/migrations/YYYY_MM_DD_create_project_evaluations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('project_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('evaluator_id')->constrained('users')->onDelete('cascade'); // Use 'users' as the correct table name
            $table->integer('rating');
            // Add other necessary fields
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_evaluations');
    }
}

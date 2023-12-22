<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $guard = [];
    protected $fillable = [
        'project_id',
        'evaluator_id',
        'rating',
            ];
   

}

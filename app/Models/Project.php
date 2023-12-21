<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $guard = [];
    public function evaluations()
    {
        return $this->hasMany(Project::class);
    }

    
}


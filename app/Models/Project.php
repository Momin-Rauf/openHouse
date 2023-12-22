<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $guard = [];
    protected $attributes = [
        'assigned_words' => 'ML',
    ];
    protected $fillable = [
        'name',
        'allocated_to',
        'group_id',
        'assign_words',
    ];
    
    
}


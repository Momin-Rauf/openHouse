<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $guard = [];
    public function evaluator()
    {
        return $this->belongsTo(Guest::class);
    }

}

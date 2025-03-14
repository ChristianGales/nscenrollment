<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    protected $table = 'grade_lvl';
    
    protected $fillable = [
        'name', // Add other fillable attributes as needed (e.g., 'status')
    ];

    
}
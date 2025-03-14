<?php

namespace App\Models;

use App\Models\GradeLevel;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';

    protected $fillable = [
        'name',
        'grade_lvl_id',
    ];

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'grade_lvl_id', 'id');
    }
    
}



<?php

namespace App\Models;

use App\Models\GradeLevel;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';

    protected $fillable = [
        'subject_name',
        'grade_lvl_id', // Corrected fillable
    ];

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'grade_lvl_id', 'id'); // Corrected relationship
    }
}
<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Acadyear;
use App\Models\GradeLevel;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    protected $fillable = [
        'time_from',
        'time_to',
        'day',
        'room',
        'subject_id',
        'section_id',
        'teacher_id',
        'sy_id',
        'grade_lvl_id',
    ];

    // Define relationships

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function sy()
    {
        return $this->belongsTo(Acadyear::class, 'sy_id');
    }
    
    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'grade_lvl_id');
    }
}
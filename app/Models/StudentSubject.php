<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Acadyear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentSubject extends Model
{
    use HasFactory;

    protected $table = 'student_subject';
    protected $primaryKey = 'students_subject_id';

    protected $fillable = [
        'student_id',
        'subject_id',
        'sy_id',
    ];

    /**
     * Get the student
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the subject
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the school year
     */
    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(Acadyear::class, 'sy_id');
    }
}
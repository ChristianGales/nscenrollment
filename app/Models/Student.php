<?php

namespace App\Models;

use App\Models\Section;
use App\Models\GradeLevel;
use App\Models\StudentSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'lrn', 'grade_lvl_id', 'section_id',
        'lastname', 'firstname', 'middlename', 'suffix', 'gender', 'bday', 'bplace', 'PSA_num',
        'fb_name', 'email', 'contact_no',
        'house_no', 'street', 'bgry', 'municipality', 'province', 'country', 'zipcode',
        'fathername', 'f_contact', 'mothername', 'm_contact', 'guardian', 'g_contact', 'status',
    ];

    /**
     * Get the student's section
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function gradeLevel(): BelongsTo
    {
        return $this->belongsTo(GradeLevel::class, 'grade_lvl_id', 'id');
    }

    /**
     * Get the student's subjects
     */
    public function studentSubjects(): HasMany
    {
        return $this->hasMany(StudentSubject::class);
    }

    /**
     * Get student's full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->lastname . ', ' . $this->firstname . ' ' . $this->middlename . ' ' . $this->suffix;
    }
}
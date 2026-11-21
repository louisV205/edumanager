<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'section_id',
        'attendance_score',
        'midterm_score',
        'final_exam_score',
        'final_score',
        'gpa_score',
        'letter_grade',
        'status',
        'is_locked',
        'entered_by_lecturer_id',
    ];

    protected $casts = [
        'attendance_score' => 'float',
        'midterm_score' => 'float',
        'final_exam_score' => 'float',
        'final_score' => 'float',
        'gpa_score' => 'float',
        'is_locked' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'section_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'entered_by_lecturer_id');
    }
}

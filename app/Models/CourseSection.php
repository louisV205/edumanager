<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $fillable = [
        'course_id',
        'semester_id',
        'lecturer_id',
        'section_code',
        'capacity',
        'current_enrollment',
        'status',
        'grade_status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function schedules()
    {
        return $this->hasMany(SectionSchedule::class, 'section_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'section_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'section_id', 'student_id')
                    ->withPivot('status', 'registered_at', 'canceled_at')
                    ->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'section_id');
    }

    public function isFull(): bool
    {
        return $this->current_enrollment >= $this->capacity;
    }
}

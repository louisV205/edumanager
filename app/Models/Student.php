<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_code',
        'fullname',
        'dob',
        'gender',
        'pob',
        'classname',
        'major',
        'education_level',
        'training_type',
        'academic_year',
        'accumulated_credits',
        'total_program_credits',
        'cpa',
        'gpa',
        'status',
    ];

    protected $casts = [
        'dob' => 'date',
        'cpa' => 'float',
        'gpa' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function sections()
    {
        return $this->belongsToMany(CourseSection::class, 'enrollments', 'student_id', 'section_id')
                    ->withPivot('status', 'registered_at', 'canceled_at')
                    ->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}

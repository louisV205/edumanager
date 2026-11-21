<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    protected $fillable = [
        'student_id',
        'section_id',
        'recorded_by_lecturer_id',
        'session_date',
        'session_number',
        'status',
        'note',
    ];

    protected $casts = [
        'session_date' => 'date',
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
        return $this->belongsTo(Lecturer::class, 'recorded_by_lecturer_id');
    }
}

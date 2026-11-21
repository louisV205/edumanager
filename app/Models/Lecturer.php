<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = [
        'user_id',
        'lecturer_code',
        'fullname',
        'dob',
        'gender',
        'pob',
        'academic_title',
        'position',
        'department',
        'specialization',
        'office',
        'start_working_date',
        'status',
    ];

    protected $casts = [
        'dob' => 'date',
        'start_working_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sections()
    {
        return $this->hasMany(CourseSection::class);
    }
}

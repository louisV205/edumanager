<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'semester_code',
        'semester_name',
        'academic_year',
        'start_date',
        'end_date',
        'status',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function sections()
    {
        return $this->hasMany(CourseSection::class);
    }

    public function registrationPeriods()
    {
        return $this->hasMany(RegistrationPeriod::class);
    }
}

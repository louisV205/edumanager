<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionSchedule extends Model
{
    protected $fillable = [
        'section_id',
        'day_of_week',
        'day_of_week_text',
        'start_period',
        'end_period',
        'start_time',
        'end_time',
        'room',
    ];

    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'section_id');
    }
}

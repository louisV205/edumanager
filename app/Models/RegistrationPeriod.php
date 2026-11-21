<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationPeriod extends Model
{
    protected $fillable = [
        'semester_id',
        'period_name',
        'start_date',
        'end_date',
        'min_credits',
        'max_credits',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function isOpen(): bool
    {
        return $this->status === 'ĐANG MỞ' || $this->status === 'Đang mở';
    }
}

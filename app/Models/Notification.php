<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'created_by_user_id',
        'title',
        'content',
        'scope',
        'section_id',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'notification_recipients')
                    ->withPivot('is_read', 'read_at')
                    ->withTimestamps();
    }
}

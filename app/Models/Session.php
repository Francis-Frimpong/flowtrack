<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'task_id',
        'start_time',
        'end_time',
        'duration_seconds'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}

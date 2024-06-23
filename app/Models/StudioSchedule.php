<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudioSchedule extends Model
{
    protected $fillable = [
        'studio_id', 
        'user_id', 
        'booked_at', 
        'status'
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
}
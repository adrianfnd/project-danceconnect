<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorSchedule extends Model
{
    protected $fillable = [
        'tutor_id', 
        'user_id', 
        'booked_at'
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
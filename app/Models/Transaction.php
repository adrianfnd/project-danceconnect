<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Transaction extends Model
{
    use HasUuids;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 
        'studio_id', 
        'studio_schedule_id', 
        'tutor_id',
        'tutor_scheduled_id', 
        'class_id', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id', 'id');
    }

    public function studioSchedule()
    {
        return $this->belongsTo(StudioSchedule::class, 'studio_schedule_id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function tutorSchedule()
    {
        return $this->belongsTo(TutorSchedule::class, 'tutor_scheduled_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function xenditLog()
    {
        return $this->hasOne(XenditLog::class, 'transaction_id', 'id');
    }
}
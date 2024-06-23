<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Tutor extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'name',
        'bio'
    ];

    public function classes()
    {
        return $this->hasMany(Classes::class, 'tutor_id', 'uuid');
    }

    public function schedules()
    {
        return $this->hasMany(TutorSchedule::class, 'tutor_id', 'uuid');
    }
}
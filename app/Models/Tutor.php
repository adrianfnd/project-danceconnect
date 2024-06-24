<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Tutor extends Model
{
    use HasUuids;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'bio',
        'image_url'
    ];

    public function classes()
    {
        return $this->hasMany(Classes::class, 'tutor_id', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(TutorSchedule::class, 'tutor_id', 'id');
    }
}
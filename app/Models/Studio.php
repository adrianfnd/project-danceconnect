<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Studio extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'name', 
        'location', 
        'image_url', 
        'price', 
        'owner',
        'description'
    ];

    public function schedules()
    {
        return $this->hasMany(StudioSchedule::class, 'studio_id', 'uuid');
    }
}
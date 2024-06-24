<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Studio extends Model
{
    use HasUuids;

    protected $primaryKey = 'id';

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
        return $this->belongsTo(StudioSchedule::class, 'studio_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
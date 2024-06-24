<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Classes extends Model
{
    use HasUuids;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 
        'start_at', 
        'quota', 
        'tutor_id', 
        'description', 
        'duration', 
        'price'
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'class_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lane extends Model
{
    protected $table = 'lanes';

    protected $fillable = [
        'name',
        'location',
        'capacity',
        'status',
        'comment',
        'validated',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'lane_id');
    }
    public function scores()
    {
        return $this->hasManyThrough(Score::class, Reservation::class, 'lane_id', 'reservations_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'lane_id',
        'start_time',
        'end_time',
        'status',
        'comment',
        'validated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lane()
    {
        return $this->belongsTo(Lane::class, 'lane_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'reservations_id');
    }
}

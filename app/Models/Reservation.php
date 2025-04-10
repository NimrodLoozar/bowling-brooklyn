<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'lane_id',
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
    ];

    public function lane()
    {
        return $this->belongsTo(Lane::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

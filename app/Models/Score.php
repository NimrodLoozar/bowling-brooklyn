<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';

    protected $fillable = [
        'reservations_id',
        'score',
        'player_name',
        'round',
        'date',
        'time',
        'comment',
        'validated',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservations_id');
    }
}

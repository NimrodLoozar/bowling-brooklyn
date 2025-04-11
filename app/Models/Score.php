<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'lane_id',
        'score',
        'created_at',
        'updated_at',
    ];

    public function participant()
{
    return $this->belongsTo(ReservationParticipant::class, 'participant_id');
}

}

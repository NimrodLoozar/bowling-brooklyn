<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationParticipant extends Model
{
    use HasFactory;
    protected $fillable = ['reservation_id', 'user_id', 'name'];

    public function reservation()
{
    return $this->belongsTo(Reservation::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function scores()
{
    return $this->hasMany(Score::class, 'participant_id');
}

}

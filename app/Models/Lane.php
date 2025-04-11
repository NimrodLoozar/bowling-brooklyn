<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lane extends Model
{
    use HasFactory;
    protected $fillable = [
        'lane_number',
        'lane_type',
        'status',
        'created_at',
        'updated_at',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}

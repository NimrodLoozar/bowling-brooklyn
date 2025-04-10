<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'user_id',
        'lane_id',
        'score',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'besteldatum',
        'status',
        'totaalbedrag',
        'betaalmethode',
        'betaalstatus',
        'aantal',
        'opmerking',
    ];

    protected $casts = [
        'besteldatum' => 'datetime', // Cast besteldatum to a Carbon instance
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

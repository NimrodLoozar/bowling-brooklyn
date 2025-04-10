<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product', // Store as JSON
        'sub_product', // Store as JSON
        'besteldatum',
        'status',
        'totaalbedrag',
        'betaalmethode',
        'betaalstatus',
        'aantal',
        'opmerking',
    ];

    protected $casts = [
        'product' => 'array', // Cast product as array
        'sub_product' => 'array', // Cast sub_product as array
        'besteldatum' => 'datetime',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

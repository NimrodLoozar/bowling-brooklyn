<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Contact extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'contacts';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'mobile',
        'address',
        'postal_code',
        'city',
        'country',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     */
    protected $attributes = [
        'notes' => null,
    ];

    /**
     * Get the user associated with the contact.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Interact with the contact's full address.
     */
    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(', ', array_filter([
                $this->address,
                $this->city,
                $this->postal_code,
                $this->country,
            ])),
        );
    }

    /**
     * Scope a query to only include contacts from a specific country.
     */
    public function scopeCountry($query, string $country)
    {
        return $query->where('country', $country);
    }

    /**
     * Scope a query to only include contacts with mobile numbers.
     */
    public function scopeWithMobile($query)
    {
        return $query->whereNotNull('mobile');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'host_id', 'agency_id', 'commune_id', 'title', 'description', 'type', 'bedrooms', 'beds', 'max_guests',
    'address_text', 'latitude', 'longitude', 'price_per_night', 'price_per_week',
    'price_per_month', 'cleaning_fee', 'security_deposit', 'min_stay_nights', 'instant_booking', 'status',
])]
class Listing extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'price_per_night' => 'decimal:0',
            'price_per_week' => 'decimal:0',
            'price_per_month' => 'decimal:0',
            'cleaning_fee' => 'decimal:0',
            'security_deposit' => 'decimal:0',
            'instant_booking' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'listing_amenities');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ListingPhoto::class)->orderBy('position');
    }

    public function calendar(): HasMany
    {
        return $this->hasMany(ListingCalendar::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        // favorites has created_at only (no updated_at) — pass it explicitly on attach().
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function boosts(): HasMany
    {
        return $this->hasMany(ListingBoost::class);
    }
}

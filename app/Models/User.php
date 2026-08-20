<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['full_name', 'phone', 'email', 'password', 'avatar_path', 'locale'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'phone_verified_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'is_admin' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function hostProfile(): HasOne
    {
        return $this->hasOne(HostProfile::class);
    }

    public function agencies(): HasMany
    {
        return $this->hasMany(Agency::class, 'owner_user_id');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'host_id');
    }

    public function reservationsAsGuest(): HasMany
    {
        return $this->hasMany(Reservation::class, 'guest_id');
    }

    public function reservationsAsHost(): HasMany
    {
        return $this->hasMany(Reservation::class, 'host_id');
    }

    public function conversationsAsGuest(): HasMany
    {
        return $this->hasMany(Conversation::class, 'guest_id');
    }

    public function conversationsAsHost(): HasMany
    {
        return $this->hasMany(Conversation::class, 'host_id');
    }

    public function favoriteListings(): BelongsToMany
    {
        // favorites has created_at only (no updated_at) — pass it explicitly on attach().
        return $this->belongsToMany(Listing::class, 'favorites');
    }

    /**
     * Kaza's own notification log (push/SMS/email), distinct from Laravel's
     * built-in database notification channel — see Kaza_Schema_BDD.md §8.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}

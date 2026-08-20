<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['owner_user_id', 'name', 'registration_number', 'registration_doc_path', 'subscription_plan'])]
class Agency extends Model
{
    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
            'subscription_ends_at' => 'datetime',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
